<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoOrden
 */
class TipoOrden extends Model
{
    protected $table = 'tipo_orden';

    public $timestamps = true;

    protected $fillable = [
        'nombre'
    ];

    protected $guarded = [];

        
}