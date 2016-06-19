<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Departamento
 */
class Departamento extends Model
{
    protected $table = 'departamentos';

    public $timestamps = true;

    protected $fillable = [
        'nombre'
    ];

    protected $guarded = [];

        
}