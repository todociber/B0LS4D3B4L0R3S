<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoMercado
 */
class TipoMercado extends Model
{
    public $timestamps = true;
    protected $table = 'tipo_mercados';
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