<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    use SoftDeletes;
    protected $dates = ['deleted_at'];

        
}