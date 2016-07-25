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

    public function TipoMensajeN()
    {
        return $this->belongsTo(TipoMensaje::class, 'idTipoMensaje', 'id');
    }


    public function OrdenN()
    {
        return $this->belongsTo(Ordene::class, 'idOrden', 'id');
    }


    public function scopeOfid($query, $id)
    {
        if (trim($id) != "") {
            $query->where('id', $id);
        }
    }
}