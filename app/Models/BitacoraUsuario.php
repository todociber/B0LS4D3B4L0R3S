<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BitacoraUsuario
 */
class BitacoraUsuario extends Model
{
    protected $table = 'bitacora_usuarios';

    public $timestamps = true;

    protected $fillable = [
        'descripcion',
        'tipo Cambio',
        'idOrganizacion',
        'idUsuario'
    ];

    protected $guarded = [];

        
}