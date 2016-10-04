<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModuloAfectado extends Model
{
    public $timestamps = true;
    protected $table = 'ModuloAfectado';
    protected $fillable = [
        'nombre',
    ];

    use SoftDeletes;
    protected $dates = ['deleted_at'];


    public function ModulosAfectados()
    {
        return $this->hasMany(BitacoraUsuario::class, 'idModuloAfectado', 'id');
    }

}
