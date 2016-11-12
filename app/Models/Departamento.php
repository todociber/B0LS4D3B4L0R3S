<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Departamento
 */
class Departamento extends Model
{
    public $timestamps = true;
    protected $table = 'departamentos';
    protected $fillable = [
        'nombre'
    ];

    protected $guarded = ['id'];


    public function Municipio()
    {
        return $this->hasMany(Municipio::class, 'id_departamento', 'id');
    }


    public function scopeOfid($query, $id)
    {
        if (trim($id) != "") {
            $query->where('id', $id);
        }
    }
}