<?php

namespace App\Http\Controllers;

use App\Models\Barbero;
use App\Models\Cita;
use App\Models\Publicacion;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    public function dashboard()
    {
        $servicios = Servicio::all();
        $barberos = Barbero::with('usuario')
            ->whereHas('usuario', function ($query) {
                $query->where('estado', 1);
            })
            ->get();
        $publicaciones = Publicacion::with([
        'muro.usuario',
        'imagenes'
        ])->orderBy('fecha', 'desc')->get();

        $idCliente = Auth::user()->cliente->id_cliente;
        $citas = Cita::with('barbero.usuario')
            ->where('id_cliente', $idCliente)
            ->get();

        return view('dashboard_cliente', compact('publicaciones', 'servicios', 'barberos', 'citas'));
    }
}
