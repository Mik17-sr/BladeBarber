<?php
// app/Models/Configuracion.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $table = 'configuracion';
    protected $primaryKey = 'id_config';
    public $timestamps = false;

    protected $fillable = [
        'nombre_negocio',
        'hora_apertura',
        'hora_cierre',
        'estado',
    ];

    protected $casts = [
        'estado' => 'boolean',
    ];

    public static function instancia(): self
    {
        return self::firstOrCreate([], [
            'nombre_negocio' => 'BladeBarber',
            'hora_apertura'  => '08:00:00',
            'hora_cierre'    => '20:00:00',
            'estado'         => true,
        ]);
    }
}