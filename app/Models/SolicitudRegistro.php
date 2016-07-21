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
        'numero de afiliado',
        'comentario de rechazo'
    ];

    protected $guarded = [];

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public function idCliente() {
        return $this->belongsTo('App\Models\Cliente', 'idCliente');
    }

    public function idOrganizacion() {
        return $this->belongsTo('App\Models\Organizacion', 'idOrganizacion');
    }
    public function idEstadoSolicitud() {
        return $this->belongsTo('App\Models\EstadoSolicitud', 'idEstadoSolicitud');
    }


    public function scopeOfid($query, $id)
    {
        if (trim($id) != "") {
            $query->where('id', $id);
        }
    }
}