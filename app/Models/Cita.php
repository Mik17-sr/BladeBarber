<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cita extends Model
{
    protected $table = 'citas';
    protected $primaryKey = 'id_cita';

    protected $fillable = [
        'fecha_cita',
        'hora_cita',
        'estado',
        'id_cliente',
        'id_barbero',
    ];

    protected $casts = [
        'fecha_cita' => 'date',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'cita_servicio', 'id_cita', 'id_servicio');
    }

    public function barbero()
    {
        return $this->belongsTo(Barbero::class, 'id_barbero', 'id_barbero');
    }
    
    public function pago()
    {
        return $this->hasOne(Pago::class, 'id_cita');
    }

    public function reprogramaciones()
    {
        return $this->hasMany(Reprogramacion::class, 'id_cita', 'id_cita')
                    ->latest();
    }
    
    public function resena()
    {
        return $this->hasOne(Resena::class, 'id_cita', 'id_cita');
    }
}