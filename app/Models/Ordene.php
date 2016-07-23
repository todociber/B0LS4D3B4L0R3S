<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Ordene
 */
class Ordene extends Model
{
    public $timestamps = true;
    protected $table = 'ordenes';
    protected $fillable = [
        'correlativo',
        'Fecha de vigencia',
        'titulo',
        'cantidad de valores',
        'valor minimo',
        'valor maximo',
        'monto',
        'tasa de interes',
        'emisor',
        'idTipoMercado',
        'idCliente',
        'idCorredor',
        'idTipoOrden',
        'idTipoEjecucion',
        'idEstadoOrden',
        'idOrganizacion',
        'idOrden'
    ];

    protected $guarded = [];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function idTipoMercado() {
        return $this->belongsTo('App\Models\TipoMercado', 'idTipoMercado');
    }

    public function idCliente() {
        return $this->belongsTo('App\Models\Cliente', 'idCliente');
    }

    public function idCorredor() {
        return $this->belongsTo('App\Models\Usuario', 'idCorredor');
    }
    public function idTipoOrden() {
        return $this->belongsTo('App\Models\TipoOrden', 'idTipoOrden');
    }
    public function idTipoEjecucion() {
        return $this->belongsTo('App\Models\TipoEjecucion', 'idTipoEjecucion');
    }

    public function idEstadoOrden() {
        return $this->belongsTo('App\Models\EstadoOrden', 'idEstadoOrden');
    }
    public function idOrganizacion() {
        return $this->belongsTo('App\Models\Organizacion', 'idOrganizacion');
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