<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}