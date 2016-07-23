<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Cliente
 */
class Cliente extends Model
{
    public $timestamps = true;
    protected $table = 'clientes';
    protected $fillable = [
        'dui',
        'nit',
        'fecha de nacimiento'
    ];

    protected $guarded = [];
    use SoftDeletes;
    protected $dates = ['deleted_at'];


    public function scopeOfid($query, $id)
    {
        if (trim($id) != "") {
            $query->where('id', $id);
        }
    }

}