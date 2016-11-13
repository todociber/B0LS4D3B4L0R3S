<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EstadoOrden
 */
class EstadoOrden extends Model
{
    public $timestamps = true;
    protected $table = 'estado_orden';
    protected $fillable = [
        'estado'
    ];

    protected $guarded = [];

    public function EstadosOrdenes()
    {
        return $this->hasMany(Ordene::class, 'idEstadoOrden', 'id');
    }

    public function scopeOfid($query, $id)
    {
        if (trim($id) != "") {
            $query->where('id', $id);
        }
    }
}