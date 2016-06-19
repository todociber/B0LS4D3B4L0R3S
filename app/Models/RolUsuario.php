<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class RolUsuario
 */
class RolUsuario extends Model
{
    protected $table = 'rol_usuarios';

    public $timestamps = true;

    protected $fillable = [
        'idUsuario',
        'idRol',
        'idCliente'
    ];

    protected $guarded = [];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}