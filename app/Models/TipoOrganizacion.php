<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoOrganizacion
 */
class TipoOrganizacion extends Model
{
    public $timestamps = true;
    protected $table = 'tipo_organizacion';
    protected $fillable = [
        'nombre'
    ];

    protected $guarded = [];

    public function scopeOfid($query, $id)
    {
        if (trim($id) != "") {
            $query->where('id', $id);
        }
    }
}