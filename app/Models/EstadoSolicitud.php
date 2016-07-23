<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EstadoSolicitud
 */
class EstadoSolicitud extends Model
{
    public $timestamps = true;
    protected $table = 'estado_solicitud';
    protected $fillable = [
        'nombre'
    ];

    protected $guarded = [];

    public function scopeOfid($query, $id)
    {
        if (trim($id) != "") {
            $query->where('id', $id);
        }
    }
}