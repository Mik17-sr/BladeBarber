<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function dashboard()
    {
        $publicaciones = Publicacion::with([
        'muro.usuario',
        'imagenes'
        ])->orderBy('fecha', 'desc')->get();

        return view('dashboard_cliente', compact('publicaciones'));
    }
}
