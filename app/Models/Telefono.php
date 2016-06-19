<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Telefono
 */
class Telefono extends Model
{
    protected $table = 'telefonos';

    public $timestamps = true;

    protected $fillable = [
        'numero',
        'idTipoTelefono',
        'idCliente'
    ];

    protected $guarded = [];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}