<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ClienteOrganizacion
 */
class ClienteOrganizacion extends Model
{
    protected $table = 'cliente_organizacions';

    public $timestamps = true;

    protected $fillable = [
        'idCliente',
        'idOrganizacion'
    ];

    protected $guarded = [];

        
}