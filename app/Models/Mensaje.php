<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Mensaje
 */
class Mensaje extends Model
{
    public $timestamps = true;
    protected $table = 'mensajes';
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

    public function scopeOfid($query, $id)
    {
        if (trim($id) != "") {
            $query->where('id', $id);
        }
    }
}