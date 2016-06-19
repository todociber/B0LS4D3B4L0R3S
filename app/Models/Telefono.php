<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

        
}