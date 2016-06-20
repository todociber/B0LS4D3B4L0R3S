<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class OperacionBolsa
 */
class OperacionBolsa extends Model
{
    protected $table = 'operacion_bolsas';

    public $timestamps = true;

    protected $fillable = [
        'monto',
        'idOden'
    ];

    protected $guarded = [];

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public function idOrden() {
        return $this->belongsTo('App\Models\Ordene', 'idOden');
    }
}