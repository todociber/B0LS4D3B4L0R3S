<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoTelefono
 */
class TipoTelefono extends Model
{
    protected $table = 'tipo_telefonos';

    public $timestamps = true;

    protected $fillable = [
        'tipo'
    ];

    protected $guarded = [];

        
}