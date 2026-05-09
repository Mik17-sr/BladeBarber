<?php

namespace App\Http\Controllers;

use App\Models\ConfiguracionFila;
use App\Models\FilaEspera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

// app/Http/Controllers/FilaEsperaController.php
class FilaEsperaController extends Controller
{
    // Ingresar a la fila
    public function ingresar(Request $request)
    {
        $request->validate([
            'servicios'   => 'required|array|min:1',
            'servicios.*' => 'exists:servicios,id_servicio',
        ]);

        $config = ConfiguracionFila::vigente();
        abort_if(!$config, 403, 'La fila de espera no está activa en este momento.');

        $idCliente = Auth::user()->cliente->id_cliente;

        // Regla: no puede estar más de una vez en la fila
        $yaEnFila = FilaEspera::where('id_cliente', $idCliente)
            ->whereIn('estado', ['esperando', 'asignado', 'en_atencion'])
            ->exists();
        abort_if($yaEnFila, 422, 'Ya tienes un turno activo en la fila.');

        // Posición = último + 1 (con bloqueo para evitar race conditions)
        $posicion = DB::transaction(function () use ($idCliente, $request) {
            $ultima = FilaEspera::whereIn('estado', ['esperando', 'asignado'])
                ->lockForUpdate()
                ->max('posicion') ?? 0;

            $turno = FilaEspera::create([
                'id_cliente' => $idCliente,
                'posicion'   => $ultima + 1,
                'estado'     => 'esperando',
            ]);

            $turno->servicios()->attach($request->servicios);
            return $turno;
        });

        return back()->with('success', "Ingresaste a la fila en la posición #{$posicion->posicion}.");
    }

    // Salir voluntariamente
    public function salir()
    {
        $idCliente = Auth::user()->cliente->id_cliente;

        $turno = FilaEspera::where('id_cliente', $idCliente)
            ->whereIn('estado', ['esperando', 'asignado'])
            ->firstOrFail();

        DB::transaction(function () use ($turno) {
            $turno->update(['estado' => 'cancelado']);
            $this->reordenarFila();
        });

        return back()->with('success', 'Saliste de la fila.');
    }

    private function reordenarFila(): void
    {
        $turnos = FilaEspera::whereIn('estado', ['esperando', 'asignado'])
            ->orderBy('created_at')
            ->get();

        foreach ($turnos as $i => $t) {
            $t->update(['posicion' => $i + 1]);
        }
    }
}