<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SolicitudRegistro
 */
class SolicitudRegistro extends Model
{
    public $timestamps = true;
    protected $table = 'solicitud_registros';
    protected $fillable = [
        'idCliente',
        'idOrganizacion',
        'idEstadoSolicitud',
        'idUsuario',
        'numeroDeAfiliado',
        'comentarioDeRechazo'
    ];

    protected $guarded = [];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function EstadoSolicitudN()
    {
        return $this->belongsTo(EstadoSolicitud::class, 'idEstadoSolicitud', 'id');
    }

    public function OrganizacionN()
    {
        return $this->belongsTo(Organizacion::class, 'idOrganizacion', 'id');
    }

    public function ClienteN()
    {
        return $this->belongsTo(Cliente::class, 'idCliente', 'id');
    }

    public function UsuarioAsignado()
    {
        return $this->belongsTo(Usuario::class, 'idUsuario', 'id');
    }


    public function scopeOfid($query, $id)
    {
        if (trim($id) != "") {
            $query->where('id', $id);
        }
    }
}