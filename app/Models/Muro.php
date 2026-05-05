<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Muro extends Model
{
    protected $table = 'muros'; 
    protected $primaryKey = 'id_muro';
    public $timestamps = true;

    protected $fillable = [
        'id_usuario', 
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    public function publicaciones()
    {
        return $this->hasMany(Publicacion::class, 'id_muro', 'id_muro');
    }
}