<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Usuario
 */
class Usuario extends Model
{
    public $timestamps = true;
    protected $table = 'usuarios';
    protected $fillable = [
        'nombre',
        'apellido',
        'correo',
        'password',
        'idOrganizacion',
        'remember_token'
    ];

    protected $guarded = [];
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $hidden = ['password', 'remember_token'];

    public function Organizacion()
    {
        return $this->belongsTo(Organizacion::class, 'idOrganizacion', 'id');
    }

    public function scopeOfid($query, $id)
    {
        if (trim($id)!="")
        {
            $query->where('id', $id);
        }
    }


}