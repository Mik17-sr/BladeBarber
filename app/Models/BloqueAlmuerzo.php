<?php
// ══════════════════════════════════════════════════════
// MODELO 1: app/Models/BloqueAlmuerzo.php
// ══════════════════════════════════════════════════════
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;
 
class BloqueAlmuerzo extends Model
{
    protected $table = 'bloques_almuerzo';
 
    protected $fillable = [
        'id_barbero',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'automatico',
        'id_cita_origen',
    ];
 
    protected $casts = [
        'fecha'      => 'date',
        'automatico' => 'boolean',
    ];
 
    public function barbero(): BelongsTo
    {
        return $this->belongsTo(Barbero::class, 'id_barbero', 'id_barbero');
    }
 
    public function scopeDelBarbero($query, int $idBarbero)
    {
        return $query->where('id_barbero', $idBarbero);
    }
 
    public function scopeDeHoy($query)
    {
        return $query->whereDate('fecha', today());
    }
 
    public function scopeDeFecha($query, $fecha)
    {
        return $query->whereDate('fecha', $fecha);
    }
 
    public function bloqueaHora(string $hora): bool
    {
        return $hora >= $this->hora_inicio && $hora < $this->hora_fin;
    }
 
    public static function opcionesHora(): array
    {
        return ['12:00' => '12:00 – 13:00', '13:00' => '13:00 – 14:00'];
    }
 
    public static function calcularFin(string $horaInicio): string
    {
        return Carbon::createFromTimeString($horaInicio)->addHour()->format('H:i');
    }
 
    public static function asignarAutomatico(Cita $cita): ?self
    {
        $hora = Carbon::parse($cita->hora_cita)->format('H:i');
        $fecha = Carbon::parse($cita->fecha_cita)->toDateString();
 
        // Solo aplica si la cita cae entre 12:00 y 13:59
        if ($hora < '12:00' || $hora >= '14:00') return null;
 
        // Si ya existe bloque para ese día, no crear otro
        $existe = self::where('id_barbero', $cita->id_barbero)
                      ->whereDate('fecha', $fecha)
                      ->exists();
        if ($existe) return null;
 
        // Determinar qué hora libre queda para el almuerzo
        // Si la cita es a las 12:x, el almuerzo va a las 13:00
        $horaAlmuerzo = $hora < '13:00' ? '13:00' : '12:00';
 
        return self::create([
            'id_barbero'     => $cita->id_barbero,
            'fecha'          => $fecha,
            'hora_inicio'    => $horaAlmuerzo,
            'hora_fin'       => self::calcularFin($horaAlmuerzo),
            'automatico'     => true,
            'id_cita_origen' => $cita->id_cita,
        ]);
    }
}