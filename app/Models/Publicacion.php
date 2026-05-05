<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    protected $table='publicaciones';

    protected $primaryKey='id_publicacion';
    
    public $timestamps = false;

    protected $fillable=[
       'id_muro',
       'contenido',
       'fecha'
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];

    public function muro()
    {
        return $this->belongsTo(Muro::class, 'id_muro', 'id_muro');
    }

    public function imagenes()
    {
        return $this->hasMany(Imagen::class, 'id_publicacion', 'id_publicacion');
    }
}
