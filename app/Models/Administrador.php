<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    protected $table      = 'administradores';
    protected $primaryKey = 'id_administrador';

    protected $fillable = [
        'id_administrador',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_administrador', 'id_usuario');
    }
}
