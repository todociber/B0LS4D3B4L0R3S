<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Usuario
 */
class Usuario extends Model
{
    public $timestamps = true;
    protected $table = 'usuarios';

    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'password',
        'idOrganizacion',

        'remember_token'
    ];

    protected $guarded = [];
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $hidden = ['password', 'remember_token'];
    public function idOrganizacion() {
        return $this->belongsTo('App\Models\Organizacion', 'idOrganizacion');
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

    public function ClienteN()
    {
        return $this->hasOne(Cliente::class, 'idUsuario', 'id');
    }

    public function scopeOfid($query, $id)
    {
    public function scopeOfType($query, $id){
        if (trim($id)!="")
        {
            $query->where('id', $id);
        }
    }
        
}