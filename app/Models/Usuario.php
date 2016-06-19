<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Usuario
 */
class Usuario extends Model
{
    protected $table = 'usuarios';

    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'apellido',
        'correo',
        'password',
        'idOrganizacion',
        'remember_token'
    ];

    protected $guarded = [];

        
}