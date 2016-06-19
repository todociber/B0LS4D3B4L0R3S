<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cedeval
 */
class Cedeval extends Model
{
    protected $table = 'cedevals';

    public $timestamps = true;

    protected $fillable = [
        'cuenta',
        'idCliente'
    ];

    protected $guarded = [];

        
}