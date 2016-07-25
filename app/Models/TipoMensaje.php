<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoMensaje
 */
class TipoMensaje extends Model
{
    public $timestamps = true;
    protected $table = 'tipo_mensajes';
    protected $fillable = [
        'nombre'
    ];

    protected $guarded = [];

    public function MensajesN()
    {
        return $this->hasMany(Mensaje::class, 'idTipoMensaje', 'id');
    }


    public function scopeOfid($query, $id)
    {
        if (trim($id) != "") {
            $query->where('id', $id);
        }
    }
}