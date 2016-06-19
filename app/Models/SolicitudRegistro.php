<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SolicitudRegistro
 */
class SolicitudRegistro extends Model
{
    protected $table = 'solicitud_registros';

    public $timestamps = true;

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

}