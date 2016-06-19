<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Direccione
 */
class Direccione extends Model
{
    protected $table = 'direcciones';

    public $timestamps = true;

    protected $fillable = [
        'detalle',
        'idMunicipio',
        'idCliente'
    ];

    protected $guarded = [];

        
}