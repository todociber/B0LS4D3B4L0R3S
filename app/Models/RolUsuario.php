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


    public function UsuarioN()
    {
        return $this->belongsTo(Usuario::class, 'idUsuario', 'id');
    }

    public function RolN()
    {
        return $this->belongsTo(Role::class, 'idRol', 'id');
    }

    public function ClienteN()
    {
        return $this->belongsTo(Cliente::class, 'idCliente', 'id');
    }



    public function scopeOfid($query, $id)
    {
        if (trim($id) != "") {
            $query->where('id', $id);
        }
    }
}
