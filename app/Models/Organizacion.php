<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Organizacion
 */
class Organizacion extends Model
{
    protected $table = 'organizacion';

    public $timestamps = true;

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



    public function idTipoOrganizacion() {
        return $this->belongsTo('App\Models\TipoOrganizacion', 'idTipoOrganizacion');
    }
}