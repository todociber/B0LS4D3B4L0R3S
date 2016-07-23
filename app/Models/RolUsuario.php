<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class RolUsuario
 */
class RolUsuario extends Model
{
    public $timestamps = true;
    protected $table = 'rol_usuarios';
    protected $fillable = [
        'idUsuario',
        'idRol',
        'idCliente'
    ];

    protected $guarded = [];

    use SoftDeletes;
    protected $dates = ['deleted_at'];


    public function idRol() {
        return $this->belongsTo('App\Models\Role', 'idRol');
    }
    public function idCliente() {
        return $this->belongsTo('App\Models\Cliente', 'idCliente');
    }

    public function scopeOfid($query, $id)
    {
        if (trim($id) != "") {
            $query->where('id', $id);
        }
    }
}
