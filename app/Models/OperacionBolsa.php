<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class OperacionBolsa
 */
class OperacionBolsa extends Model
{
    public $timestamps = true;
    protected $table = 'operacion_bolsas';
    protected $fillable = [
        'monto',
        'idOrden'
    ];

    protected $guarded = [];

    use SoftDeletes;
    protected $dates = ['deleted_at'];


    public function OrdenN()
    {
        return $this->belongsTo(Ordene::class, 'idOden', 'id');
    }

    public function scopeOfid($query, $id)
    {
        if (trim($id) != "") {
            $query->where('id', $id);
        }
    }
}