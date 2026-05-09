<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfiguracionFila extends Model
{
    protected $table = 'configuracion_fila';
    protected $primaryKey = 'id_config';
    protected $fillable = ['fecha_inicio', 'fecha_fin', 'activa', 'intervalo_atencion'];
    protected $casts = ['fecha_inicio' => 'datetime', 'fecha_fin' => 'datetime', 'activa' => 'boolean'];

    public static function vigente(): ?self
    {
        return self::where('activa', true)
            ->where('fecha_inicio', '<=', now())
            ->where('fecha_fin', '>=', now())
            ->latest()
            ->first();
    }
}

class FilaEspera extends Model
{
    protected $table = 'fila_espera';
    protected $primaryKey = 'id_turno';
    protected $fillable = ['id_cliente', 'id_barbero', 'id_cita', 'posicion', 'estado'];

    public function cliente() { return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente'); }
    public function barbero() { return $this->belongsTo(Barbero::class, 'id_barbero', 'id_barbero'); }
    public function cita()    { return $this->belongsTo(Cita::class, 'id_cita', 'id_cita'); }
    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'fila_espera_servicios', 'id_turno', 'id_servicio');
    }
}