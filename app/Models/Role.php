<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 */
class Role extends Model
{
    public $timestamps = true;
    protected $table = 'roles';
    protected $fillable = [
        'nombre'
    ];

    protected $guarded = [];

    public function RolUsuariosN()
    {
        return $this->hasMany(RolUsuario::class, 'idRol', 'id');
    }

    public function scopeOfid($query, $id)
    {
        if (trim($id) != "") {
            $query->where('id', $id);
        }
    }
}