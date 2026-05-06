<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Horario;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_barbero'  => 'required|integer|exists:barberos,id_barbero',
            'fecha_cita'  => 'required|date|after_or_equal:today',
            'hora_cita'   => 'required',
            'servicios'   => 'required|array|min:1',
            'servicios.*' => 'integer|exists:servicios,id_servicio',
        ]);

        $idCliente = Auth::user()->cliente->id_cliente;

        $cita = Cita::create([
            'fecha_cita' => $request->fecha_cita,
            'hora_cita'  => $request->hora_cita,
            'estado'     => 'Pendiente',
            'id_cliente' => $idCliente,
            'id_barbero' => $request->id_barbero,
        ]);

        $cita->servicios()->attach($request->servicios);

        return redirect()->route('dashboard.cliente')
            ->with('success', '¡Cita agendada exitosamente!');
    }

    public function disponibilidad($id_barbero)
    {
        $horarios = Horario::where('id_barbero', $id_barbero)->get()
            ->map(fn($h) => [
                'dia'         => (int) $h->dia,
                'hora_inicio' => substr($h->hora_inicio, 0, 5),
                'hora_fin'    => substr($h->hora_fin,    0, 5),
            ]);

        return response()->json([
            'horarios' => $horarios,
            'citas'    => [],
       
            ]);
    }
    public function horasOcupadas(Request $request)
    {
    $horas = Cita::where('id_barbero', $request->barbero)
        ->whereDate('hora_cita', $request->fecha)
        ->whereIn('estado', ['Pendiente', 'Confirmada'])
        ->pluck('hora_cita')
        ->map(fn($h) => \Carbon\Carbon::parse($h)->format('H:i'))
        ->values();

    return response()->json($horas);
    }
}
