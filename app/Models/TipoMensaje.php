<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoMensaje
 */
class TipoMensaje extends Model
{
    protected $table = 'tipo_mensajes';

    public $timestamps = true;

    protected $fillable = [
        'nombre'
    ];

    protected $guarded = [];

        
}