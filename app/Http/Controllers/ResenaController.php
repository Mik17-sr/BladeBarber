<?php

// app/Http/Controllers/ResenaController.php
namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Resena;
use App\Models\Barbero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResenaController extends Controller
{

    public function show($id_cita)
    {
        $cita = Cita::with(['barbero.usuario', 'servicios', 'resena'])
                    ->findOrFail($id_cita);
        abort_if($cita->id_cliente !== Auth::user()->cliente->id_cliente, 403);
        abort_if($cita->estado !== 'Completada', 403);
        if ($cita->resena) {
            return redirect()->route('cliente.dashboard')
                             ->with('info', 'Ya enviaste una reseña para esta cita.');
        }

        return view('resena.form', compact('cita'));
    }

    public function store(Request $request, $id_cita)
    {
        $request->validate([
            'cal_citacion'  => 'required|integer|min:1|max:5',
            'cal_trato'     => 'required|integer|min:1|max:5',
            'cal_resultado' => 'required|integer|min:1|max:5',
            'observaciones' => 'nullable|string|max:1000',
        ]);

        $cita = Cita::with('resena')->findOrFail($id_cita);

        abort_if($cita->id_cliente !== Auth::user()->cliente->id_cliente, 403);
        abort_if($cita->estado !== 'Completada', 403);
        abort_if($cita->resena !== null, 403);

        Resena::create([
            'id_cita'       => $cita->id_cita,
            'id_cliente'    => $cita->id_cliente,
            'id_barbero'    => $cita->id_barbero,
            'cal_citacion'  => $request->cal_citacion,
            'cal_trato'     => $request->cal_trato,
            'cal_resultado' => $request->cal_resultado,
            'observaciones' => $request->observaciones,
        ]);

        return redirect()->route('dashboard.cliente')
                         ->with('success', '¡Gracias por tu reseña!');
    }

    public function historial($id_barbero)
    {
        $barbero = Barbero::with(['usuario', 'resenas.cliente.usuario'])
                          ->findOrFail($id_barbero);
        $promedio  = $barbero->promedioCalificacion();
        $resenas   = $barbero->resenas()->with('cliente.usuario')
                             ->latest()->get();
        return view('resena.historial', compact('barbero', 'promedio', 'resenas'));
    }
}