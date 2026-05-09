<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilaEspera extends Model
{
    protected $table      = 'fila_espera';
    protected $primaryKey = 'id_turno';

    protected $fillable = [
        'id_cliente', 'id_cita', 'posicion', 'estado',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    public function servicios()
    {
        return $this->belongsToMany(
            Servicio::class,
            'fila_espera_servicios',
            'id_turno',
            'id_servicio'
        );
    }

    public function cita()
    {
        return $this->belongsTo(Cita::class, 'id_cita', 'id_cita');
    }
}