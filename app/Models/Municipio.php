<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Municipio
 */
class Municipio extends Model
{
    public $timestamps = true;
    protected $table = 'municipios';
    protected $fillable = [
        'nombre',
        'id_departamento'
    ];

    protected $guarded = [];


    public function Departamento()
    {
        return $this->belongsTo(Departamento::class, 'id_departamento', 'id');
    }

    public function scopeOfid($query, $id)
    {
        if (trim($id) != "") {
            $query->where('id', $id);
        }
    }
}