<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reprogramacion extends Model
{
    protected $table = 'reprogramaciones';

    public $timestamps = true;

    protected $fillable = [
        'id_cita',
        'id_barbero',
        'hora_original',
        'hora_nueva',
        'motivo',
    ];

    protected $casts = [
        'hora_original' => 'datetime',
        'hora_nueva'    => 'datetime',
    ];

    public function cita(): BelongsTo
    {
        return $this->belongsTo(Cita::class, 'id_cita', 'id_cita');
    }

    public function barbero(): BelongsTo
    {
        return $this->belongsTo(Barbero::class, 'id_barbero');
    }

    public function scopeDelBarbero($query, int $idBarbero)
    {
        return $query->where('id_barbero', $idBarbero);
    }

    public function scopeDeLaCita($query, int $idCita)
    {
        return $query->where('id_cita', $idCita);
    }

    public function scopeDeHoy($query)
    {
        return $query->whereDate('created_at', today());
    }

    public function getDiferenciaHorasAttribute(): float
    {
        return $this->hora_original->diffInHours($this->hora_nueva, false);
    }
}