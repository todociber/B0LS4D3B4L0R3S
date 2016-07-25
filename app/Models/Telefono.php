<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Telefono
 */
class Telefono extends Model
{
    public $timestamps = true;
    protected $table = 'telefonos';
    protected $fillable = [
        'numero',
        'idTipoTelefono',
        'idCliente'
    ];

    protected $guarded = [];

    use SoftDeletes;
    protected $dates = ['deleted_at'];


    public function TipoTelefonoN()
    {
        return $this->belongsTo(TipoTelefono::class, 'idTipoTelefono', 'id');
    }


    public function ClienteN()
    {
        return $this->belongsTo(Cliente::class, 'idCliente', 'id');
    }


    public function scopeOfid($query, $id)
    {
        if (trim($id) != "") {
            $query->where('id', $id);
        }
    }
}