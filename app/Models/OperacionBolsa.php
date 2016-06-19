<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OperacionBolsa
 */
class OperacionBolsa extends Model
{
    protected $table = 'operacion_bolsas';

    public $timestamps = true;

    protected $fillable = [
        'monto',
        'idOden'
    ];

    protected $guarded = [];

        
}