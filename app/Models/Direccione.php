<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Direccione
 */
class Direccione extends Model
{
    public $timestamps = true;
    protected $table = 'direcciones';
    protected $fillable = [
        'detalle',
        'idMunicipio',
        'idCliente'
    ];

    protected $guarded = [];
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function idCliente() {
        return $this->belongsTo('App\Models\Cliente', 'idCliente');
    }

    public function idMunicipio() {
        return $this->belongsTo('App\Models\Municipio', 'idMunicipio');
    }

    public function scopeOfid($query, $id)
    {
        if (trim($id) != "") {
            $query->where('id', $id);
        }
    }
}