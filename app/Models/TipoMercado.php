<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoMercado
 */
class TipoMercado extends Model
{
    protected $table = 'tipo_mercados';

    public $timestamps = true;

    protected $fillable = [
        'nombre'
    ];

    protected $guarded = [];

        
}