<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BitacoraUsuario
 */
class BitacoraUsuario extends Model
{
    public $timestamps = true;
    protected $table = 'bitacora_usuarios';
    protected $fillable = [
        'descripcion',
        'tipo Cambio',
        'idOrganizacion',
        'idUsuario'
    ];

    protected $guarded = [];

    public function scopeOfid($query, $id)
    {
        if (trim($id) != "") {
            $query->where('id', $id);
        }
    }
}