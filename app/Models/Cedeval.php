<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Cedeval
 */
class Cedeval extends Model
{
    public $timestamps = true;
    protected $table = 'cedevals';
    protected $fillable = [
        'cuenta',
        'idCliente'
    ];

    protected $guarded = [];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function idCliente() {
        return $this->belongsTo('App\Models\Cliente', 'idCliente');
    }

    public function scopeOfid($query, $id)
    {
        if (trim($id) != "") {
            $query->where('id', $id);
        }
    }

}