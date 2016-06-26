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


    public function idTipoMensaje() {
        return $this->belongsTo('App\Models\TipoMensaje', 'idTipoMensaje');
    }

    public function idOrden() {
        return $this->belongsTo('App\Models\Ordene', 'idOrden');
    }

}