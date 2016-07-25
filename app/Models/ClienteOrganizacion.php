<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ClienteOrganizacion
 */
class ClienteOrganizacion extends Model
{
    public $timestamps = true;
    protected $table = 'cliente_organizacions';
    protected $fillable = [
        'idCliente',
        'idOrganizacion'
    ];

    protected $guarded = [];
    use SoftDeletes;
    protected $dates = ['deleted_at'];


    public function OrganizacionesDeCliente()
    {
        return $this->belongsTo(Cliente::class, 'idCliente', 'id');
    }

    public function ClienteOrganizacion_Organizacion()
    {
        return $this->belongsTo(Organizacion::class, 'idOrganizacion', 'id');
    }


    public function scopeOfid($query, $id)
    {
        if (trim($id) != "") {
            $query->where('id', $id);
        }
    }
}