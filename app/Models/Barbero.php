<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barbero extends Model
{
    protected $table      = 'barberos';
    protected $primaryKey = 'id_barbero';
    public    $incrementing = false;  

    protected $fillable = ['id_barbero', 'id_usuario'];

    public function usuario()
    {
        return $this->belongsTo(\App\Models\Usuario::class, 'id_barbero', 'id_usuario');                 
    }

    public function resenas()
    {
        return $this->hasMany(Resena::class, 'id_barbero', 'id_barbero');
    }

    public function promedioCalificacion(): float
    {
        return round($this->resenas()->avg('promedio') ?? 0, 1);
    }
}