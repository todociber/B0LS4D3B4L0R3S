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
        'FechaDeVigencia',
        'titulo',
        'valorMinimo',
        'valorMaximo',
        'comision',
        'monto',
        'tasaDeInteres',
        'emisor',
        'TipoMercado',
        'idCliente',
        'idCorredor',
        'idTipoOrden',
        'idTipoEjecucion',
        'idEstadoOrden',
        'idOrganizacion',
        'idOrden',
        'idCuentaCedeval'
    ];

    protected $guarded = [];

    use SoftDeletes;
    protected $dates = ['deleted_at'];


    public function EstadoOrdenN()
    {
        return $this->belongsTo(EstadoOrden::class, 'idEstadoOrden', 'id');
    }

    public function MensajesN_Orden()
    {
        return $this->hasMany(Mensaje::class, 'idOrden', 'id');
    }


    public function Operaiones_ordenes()
    {
        return $this->hasMany(OperacionBolsa::class, 'idOrden', 'id');
    }


    public function ClientesN()
    {
        return $this->belongsTo(Cliente::class, 'idCliente', 'id');
    }

    public function Corredor_UsuarioN()
    {
        return $this->belongsTo(Usuario::class, 'idCorredor', 'id');
    }

    public function TipoOrdenN()
    {
        return $this->belongsTo(TipoOrden::class, 'idTipoOrden', 'id');
    }

    public function TipoEjecucionN()
    {
        return $this->belongsTo(TipoEjecucion::class, 'idTipoEjecucion', 'id');
    }

    public function EstadoOrden()
    {
        return $this->belongsTo(EstadoOrden::class, 'idEstadoOrden', 'id');
    }

    public function OrganizacionOrdenN()
    {
        return $this->belongsTo(Organizacion::class, 'idOrganizacion', 'id');
    }


    public function CuentaCedeval()
    {
        return $this->belongsTo(Cedeval::class, 'idCuentaCedeval', 'id');
    }

    public function OrdenPadre()
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