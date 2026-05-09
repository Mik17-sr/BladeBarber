<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\ConfiguracionFila;
use App\Models\FilaEspera;
use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

// app/Http/Controllers/BarberoFilaController.php
class BarberoFilaController extends Controller
{
    // Ver la fila
    public function index()
    {
        $idBarbero = Auth::user()->barbero->id_barbero;
        $fila = FilaEspera::with(['cliente.usuario', 'servicios'])
            ->whereIn('estado', ['esperando', 'asignado', 'en_atencion'])
            ->orderBy('posicion')
            ->get();
        $filaCount  = FilaEspera::whereIn('estado', ['esperando', 'asignado'])->count();
$filaActiva = ConfiguracionFila::vigente();
$turnos     = FilaEspera::with(['cliente.usuario', 'servicios'])
                ->whereIn('estado', ['esperando', 'asignado', 'en_atencion'])
                ->orderBy('posicion')
                ->get();    

        return view('barbero.fila', compact('fila', 'filaCount', 'filaActiva', 'turnos'));
    }

    // Iniciar atención → genera la cita
    public function iniciar(Request $request, $id)
    {
        $idBarbero = Auth::user()->barbero->id_barbero;

        $turno = FilaEspera::with('servicios')
            ->whereIn('estado', ['esperando', 'asignado'])
            ->findOrFail($id);

        DB::transaction(function () use ($turno, $idBarbero) {
            // Crear la cita en ese momento
            $cita = Cita::create([
                'id_cliente' => $turno->id_cliente,
                'id_barbero' => $idBarbero,
                'fecha_cita' => now()->toDateString(),
                'hora_cita'  => now()->format('H:i:s'),
                'estado'     => 'Confirmada',
            ]);
            $cita->servicios()->attach($turno->servicios->pluck('id_servicio'));

            $turno->update([
                'id_barbero' => $idBarbero,
                'id_cita'    => $cita->id_cita,
                'estado'     => 'en_atencion',
            ]);
        });

        return back()->with('success', 'Atención iniciada. Cita generada.');
    }

    // Finalizar servicio + validar pago
    public function finalizar(Request $request, $id)
    {
        $request->validate([
            'metodo_pago' => 'required|string|max:50',
        ]);

        $turno = FilaEspera::where('estado', 'en_atencion')
            ->with(['cita.servicios', 'servicios'])
            ->findOrFail($id);

        // Monto calculado desde los servicios (no viene del form)
        $monto = $turno->servicios->sum('precio');

        DB::transaction(function () use ($turno, $request, $monto) {
            if ($turno->cita) {
                Pago::create([
                    'id_cita'     => $turno->cita->id_cita,
                    'monto'       => $monto,
                    'metodo' => $request->metodo_pago,
                    'fecha_pago'  => now(),
                ]);
                $turno->cita->update(['estado' => 'Completada']);
            }

            $turno->update(['estado' => 'completado']);
            $this->reordenarFila();
        });

        return back()->with('success', 'Servicio finalizado y pago registrado.');
    }

    // Cancelar (no se presentó)
    public function cancelar($id)
    {
        $turno = FilaEspera::whereIn('estado', ['esperando', 'asignado', 'en_atencion'])->findOrFail($id);

        DB::transaction(function () use ($turno) {
            $turno->cita?->update(['estado' => 'Cancelada']);
            $turno->update(['estado' => 'no_se_presento']);
            $this->reordenarFila();
        });

        return back()->with('success', 'Turno cancelado por no presentación.');
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