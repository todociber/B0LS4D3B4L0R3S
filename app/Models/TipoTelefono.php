<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoTelefono
 */
class TipoTelefono extends Model
{
    public $timestamps = true;
    protected $table = 'tipo_telefonos';
    protected $fillable = [
        'tipo'
    ];

    protected $guarded = [];

    public function scopeOfid($query, $id)
    {
        if (trim($id) != "") {
            $query->where('id', $id);
        }
    }
        
}