<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table='horarios';

    protected $primaryKey='id_horario';

    public $timestamps=false;

    protected $fillable=[
       'id_barbero',
       'dia',
       'hora_inicio',
       'hora_fin'
    ];

    public function barbero()
    {
    return $this->belongsTo(Usuario::class,'id_barbero','id_usuario');
    }
}