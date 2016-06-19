<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Ordene
 */
class Ordene extends Model
{
    protected $table = 'ordenes';

    public $timestamps = true;

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

}