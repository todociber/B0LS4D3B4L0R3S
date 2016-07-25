<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoEjecucion
 */
class TipoEjecucion extends Model
{
    public $timestamps = true;
    protected $table = 'tipo_ejecucion';
    protected $fillable = [
        'forma'
    ];

    protected $guarded = [];


    public function Tipo_ordenes()
    {
        return $this->hasMany(Ordene::class, 'idTipoEjecucion', 'id');
    }
    public function scopeOfid($query, $id)
    {
        if (trim($id) != "") {
            $query->where('id', $id);
        }
    }
}