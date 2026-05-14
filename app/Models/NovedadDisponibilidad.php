<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
 
class NovedadDisponibilidad extends Model
{
    protected $table = 'novedades_disponibilidad';
 
    protected $fillable = [
        'id_barbero',
        'fecha',
        'tipo',
        'motivo',
        'hora_afectada',
        'estado',
        'aprobado_por',
    ];
 
    protected $casts = [
        'fecha' => 'date',
    ];
 
    public function barbero(): BelongsTo
    {
        return $this->belongsTo(Barbero::class, 'id_barbero', 'id_barbero');
    }
 
    public function aprobadoPor(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'aprobado_por', 'id_usuario');
    }
 

    public function scopePendientes($query)
    {
        return $query->where('estado', 'pendiente');
    }
 
    public function scopeAprobadas($query)
    {
        return $query->where('estado', 'aprobada');
    }
 
    public function scopeDelBarbero($query, int $idBarbero)
    {
        return $query->where('id_barbero', $idBarbero);
    }

 
    public static function etiquetasTipo(): array
    {
        return [
            'inasistencia'          => 'Inasistencia',
            'cancelacion_anticipada'=> 'Cancelación anticipada',
            'otro'                  => 'Otro',
        ];
    }
 
    public function etiquetaTipo(): string
    {
        return self::etiquetasTipo()[$this->tipo] ?? $this->tipo;
    }
 
    public function estaAprobada(): bool
    {
        return $this->estado === 'aprobada';
    }
}
 