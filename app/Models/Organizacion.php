<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Organizacion
 */
class Organizacion extends Model
{
    protected $table = 'organizacion';

    public $timestamps = true;

    protected $fillable = [
        'codigo',
        'nombre',
        'logo',
        'correo',
        'direccion',
        'telefono',
        'idTipoOrganizacion'
    ];

    protected $guarded = [];

        
}