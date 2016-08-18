<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Organizacion
 */
class Organizacion extends Model
{
    public $timestamps = true;
    protected $table = 'organizacion';
    protected $fillable = [
        'codigo',
        'nombre',
        'logo',
        'correo',
        'direccion',
        'telefono',
        'idTipoOrganizacion'
    ];

    protected $guarded = [];

    use SoftDeletes;
    protected $dates = ['deleted_at'];


    public function TipoOrganizacionN()
    {
        return $this->belongsTo(TipoOrganizacion::class, 'idTipoOrganizacion', 'id');
    }
    //se hace la relacion la inversa con hasmany
    //belongsTo=pertnece a,hasmany = tiene muchos

    public function OrganizacionUsuario()
    {
        return $this->hasMany(Usuario::class, 'idOrganizacion', 'id');
    }

    public function SolicitudOrganizacion()
    {
        return $this->hasMany(SolicitudRegistro::class, 'idOrganizacion', 'id');
    }

    public function OrdenesOrganizacion()
    {
        return $this->hasMany(Ordene::class, 'idOrganizacion', 'id');
    }

    public function BitacoraUsuariosOrganizacion()
    {
        return $this->hasMany(BitacoraUsuario::class, 'idOrganizacion', 'id');
    }



    public function scopeOfid($query, $id)
    {
        if (trim($id) != "") {
            $query->where('id', $id);
        }
    }

}