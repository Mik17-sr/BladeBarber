<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Resena.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resena extends Model
{
    protected $table    = 'resenas';
    protected $primaryKey = 'id_resena';

    protected $fillable = [
        'id_cita', 'id_cliente', 'id_barbero',
        'cal_citacion', 'cal_trato', 'cal_resultado',
        'observaciones',
    ];

    public function cita()
    {
        return $this->belongsTo(Cita::class, 'id_cita', 'id_cita');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    public function barbero()
    {
        return $this->belongsTo(Barbero::class, 'id_barbero', 'id_barbero');
    }

    
}