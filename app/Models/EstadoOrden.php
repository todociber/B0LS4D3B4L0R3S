<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EstadoOrden
 */
class EstadoOrden extends Model
{
    protected $table = 'estado_orden';

    public $timestamps = true;

    protected $fillable = [
        'estado'
    ];

    protected $guarded = [];

        
}