<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BitacoraUsuario
 */
class BitacoraUsuario extends Model
{
    /* Schema::create('bitacora', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipoCambio',20)->unsigned();
            $table->integer('idUsuario')->unsigned();
            $table->string('descripcion',100)->unsigned();
            $table->timestamps();
        });*/
    public $timestamps = true;
    protected $table = 'bitacora';
    protected $fillable = [
        'tipoCambio',
        'idUsuario',
        'descripcion',
        'idOrganizacion',
    ];

    protected $guarded = [];


    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function ModuloAfectado()
    {
        return $this->belongsTo(ModuloAfectado::class, 'idModuloAfectado', 'id');
    }


    public function scopeOfid($query, $id)
    {
        if (trim($id) != "") {
            $query->where('id', $id);
        }
    }
}