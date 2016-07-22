<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Usuario
 */
class Usuario extends Model
{
    protected $table = 'usuarios';

    public $timestamps = true;

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
    public function idOrganizacion() {
        return $this->belongsTo('App\Models\Organizacion', 'idOrganizacion');
    }

    public function scopeOfType($query, $id){
        if (trim($id)!="")
        {
            $query->where('id', $id);
        }
    }
        
}