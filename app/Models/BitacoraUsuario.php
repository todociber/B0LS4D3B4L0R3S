<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BitacoraUsuario
 */
class BitacoraUsuario extends Model
{
    public $timestamps = true;
    protected $table = 'bitacora';
    protected $fillable = [
        'idUsuario',
        'idUsuarioAfectado',
        'idOrden',
        'idModuloAfectado'
    ];

    protected $guarded = [];


    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function ModuloAfectado()
    {
        return $this->belongsTo(ModuloAfectado::class, 'idModuloAfectado', 'id');
    }


    public function scopeOfid($query, $id)
    {
        if (trim($id) != "") {
            $query->where('id', $id);
        }
    }
}