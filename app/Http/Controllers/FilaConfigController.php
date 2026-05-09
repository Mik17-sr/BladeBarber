<?php

namespace App\Http\Controllers;

use App\Models\ConfiguracionFila;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FilaConfigController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'fecha_inicio' => [
                'required',
                'date',
                'after_or_equal:' . Carbon::now()->subMinutes(5)->format('Y-m-d H:i'),
            ],
            'fecha_fin'          => 'required|date|after:fecha_inicio',
            'intervalo_atencion' => 'required|integer|min:5|max:120',
        ]);

        // Desactivar cualquier config activa anterior
        ConfiguracionFila::where('activa', true)->update(['activa' => false]);

        ConfiguracionFila::create([
            'fecha_inicio'       => $request->fecha_inicio,
            'fecha_fin'          => $request->fecha_fin,
            'activa'             => true,
            'intervalo_atencion' => $request->intervalo_atencion,
        ]);

        return back()->with('success', 'Fila de espera programada correctamente.');
    }

    public function desactivar()
    {
        ConfiguracionFila::where('activa', true)->update(['activa' => false]);
        return back()->with('success', 'Fila de espera desactivada.');
    }
}