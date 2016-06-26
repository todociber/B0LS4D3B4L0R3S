<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EstadoSolicitud
 */
class EstadoSolicitud extends Model
{
    protected $table = 'estado_solicitud';

    public $timestamps = true;

    protected $fillable = [
        'nombre'
    ];

    protected $guarded = [];

        
}