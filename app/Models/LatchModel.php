<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LatchModel extends Model
{
    public $timestamps = true;
    protected $table = 'latchdatatoken';
    protected $fillable = [
        'tokenLatch',
        'idUsuario'
    ];

    protected $guarded = [];

    use SoftDeletes;
    protected $dates = ['deleted_at'];


    public function UsuariosLatch()
    {
        return $this->belongsTo(Usuario::class, 'idUsuario', 'id');
    }
    public function scopeOfid($query, $id)
    {
        if (trim($id) != "") {
            $query->where('id', $id);
        }
    }
}
