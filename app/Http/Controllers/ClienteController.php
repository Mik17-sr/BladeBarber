<?php

namespace App\Http\Controllers;

use App\Models\Barbero;
use App\Models\Publicacion;
use App\Models\Servicio;
use Illuminate\Http\Request;

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

        return view('dashboard_cliente', compact('publicaciones', 'servicios', 'barberos'));
    }
}
