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
// automatico
class Usuario extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{

    public $timestamps = true;

    protected $table = 'usuarios';
//automatico
// son propiedades que sirmven para le modelo que se encargar de autentificar
    use Authenticatable, Authorizable, CanResetPassword, SoftDeletes;

// portect file se le especifica que campos de la base de datos deben ir llenos
    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'password',
        'idOrganizacion',
        'remember_token'
    ];

    protected $guarded = [];
//dates: es para permitir el soft delete se le debe agregar y es de tipo fecha
    protected $dates = ['deleted_at'];
//hiden se encarga a la hora de devolver un web service no mestra los campos definidos
    protected $hidden = ['password', 'remember_token'];

//definicion de relaciones en la base de datos
    public function Organizacion()
    {
        //se le coloca un return this
        //belongsTo sigmifica que usuarios pertnense a tabla relacionar
        // se e debera pasar al campo que relacionas las tablas
        //modelo a relacionar (campo foraneo,campo prinicipal primario)
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

    }
    public function scopeOfType($query, $id){

        if (trim($id)!="")
        {
            $query->where('id', $id);
        }
    }


}