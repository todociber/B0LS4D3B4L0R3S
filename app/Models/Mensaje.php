<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Mensaje
 */
class Mensaje extends Model
{
    protected $table = 'mensajes';

    public $timestamps = true;

    protected $fillable = [
        'contenido',
        'idTipoMensaje',
        'idOrden',
        'emisor'
    ];

    protected $guarded = [];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}