<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoEjecucion
 */
class TipoEjecucion extends Model
{
    protected $table = 'tipo_ejecucion';

    public $timestamps = true;

    protected $fillable = [
        'forma'
    ];

    protected $guarded = [];

        
}