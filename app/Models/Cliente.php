<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Cliente
 */
class Cliente extends Model
{
    protected $table = 'clientes';

    public $timestamps = true;

    protected $fillable = [
        'dui',
        'nit',
        'fecha de nacimiento'
    ];

    protected $guarded = [];
    use SoftDeletes;
    protected $dates = ['deleted_at'];



}