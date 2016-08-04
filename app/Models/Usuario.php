<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;

/**
 * Class Usuario
 */
class Usuario extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{


    use Authenticatable, Authorizable, CanResetPassword, SoftDeletes;



    public $timestamps = true;
    protected $table = 'usuarios';
    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'password',
        'idOrganizacion',
        'remember_token'
    ];

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    protected $hidden = ['password', 'remember_token'];

    public function Organizacion()
    {
        return $this->belongsTo(Organizacion::class, 'idOrganizacion', 'id');
    }

    public function OrdenesUsuario()
    {
        return $this->hasMany(Ordene::class, 'idCorredor', 'id');
    }

    public function UsuarioRoles()
    {
        return $this->hasMany(RolUsuario::class, 'idUsuario', 'id');
    }

    public function UsuarioAsignado()
    {
        return $this->hasMany(SolicitudRegistro::class, 'idUsuario', 'id');
    }

    public function BitacoraUsuarios()
    {
        return $this->hasMany(BitacoraUsuario::class, 'idUsuario', 'id');
    }

    public function MensajesUsuarios()
    {
        return $this->hasMany(Mensaje::class, 'idUsuario', 'id');
    }

    public function ClienteN()
    {
        return $this->hasOne(Cliente::class, 'idUsuario', 'id');
    }

    public function scopeOfid($query, $id)
    {
        if (trim($id)!="")
        {
            $query->where('id', $id);
        }
    }


}