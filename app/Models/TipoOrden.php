<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoOrden
 */
class TipoOrden extends Model
{
    public $timestamps = true;
    protected $table = 'tipo_orden';
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