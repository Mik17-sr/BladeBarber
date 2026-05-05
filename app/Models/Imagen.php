<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    protected $table = 'imagenes';

    protected $primaryKey = 'id_imagen';

    public $timestamps = false;

    protected $fillable = [
        'id_publicacion',
        'imagen' 
    ];
    
    public function publicacion()
    {
        return $this->belongsTo(Publicacion::class, 'id_publicacion');
    }
}
