<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    use SoftDeletes;
    protected $dates = ['deleted_at'];

        
}