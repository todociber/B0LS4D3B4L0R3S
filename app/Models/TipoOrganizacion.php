<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoOrganizacion
 */
class TipoOrganizacion extends Model
{
    protected $table = 'tipo_organizacion';

    public $timestamps = true;

    protected $fillable = [
        'nombre'
    ];

    protected $guarded = [];

        
}