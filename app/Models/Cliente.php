<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Cliente
 */
class Cliente extends Model
{
    public $timestamps = true;
    protected $table = 'clientes';
    protected $fillable = [
        'dui',
        'nit',
        'fecha de nacimiento'
    ];

    protected $guarded = [];
    use SoftDeletes;
    protected $dates = ['deleted_at'];


    public function CuentaCedeval()
    {
        return $this->hasMany(Cedeval::class, 'idCliente', 'id');
    }

    public function ClienteOrganizacionR()
    {
        return $this->hasMany(ClienteOrganizacion::class, 'idCliente', 'id');
    }

    public function ClienteSolicitud()
    {
        return $this->hasMany(SolicitudRegistro::class, 'idCliente', 'id');
    }


    public function Ordenes_Cliente()
    {
        return $this->hasMany(Ordene::class, 'idCliente', 'id');
    }


    public function RolUsuarioNs()
    {
        return $this->hasOne(RolUsuario::class, 'idCliente', 'id');
    }

    public function DireccionesUsuario()
    {
        return $this->hasMany(Direccione::class, 'idCliente', 'id');
    }

    public function TelefonosUsuario()
    {
        return $this->hasMany(Telefono::class, 'idCliente', 'id');
    }
    public function scopeOfid($query, $id)
    {
        if (trim($id) != "") {
            $query->where('id', $id);
        }
    }

}