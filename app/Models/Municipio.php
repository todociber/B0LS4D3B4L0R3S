<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Municipio
 */
class Municipio extends Model
{
    protected $table = 'municipios';

    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'id_departamento'
    ];

    protected $guarded = [];

        
}