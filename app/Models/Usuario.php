<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    use SoftDeletes;
    protected $dates = ['deleted_at'];

        
}