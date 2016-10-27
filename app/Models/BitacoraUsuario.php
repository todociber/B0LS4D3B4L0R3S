<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BitacoraUsuario
 */
class BitacoraUsuario extends Model
{
    public $timestamps = true;
    protected $table = 'bitacora';
    protected $fillable = [
        'tipoCambio',
        'idUsuario',
        'descripcion',
        'idOrganizacion',
    ];

    protected $guarded = [];   


    public function scopeOfid($query, $id)
    {
        if (trim($id) != "") {
            $query->where('id', $id);
        }
    }
}