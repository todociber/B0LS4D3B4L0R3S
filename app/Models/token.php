<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class token extends Model
{
    public $timestamps = true;
    protected $table = 'tokens';
    protected $fillable = [
        'token',
        'idUsuario',
        'email_change',
    ];

    protected $guarded = [];
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function UsuarioToken()
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
