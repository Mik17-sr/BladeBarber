<?php

namespace App\Http\Controllers;

use App\Models\Barbero;
use App\Models\Configuracion;
use App\Models\User;
use App\Models\Horario;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function storeBarber(Request $request)
{
    $request->validate([
        'nombre'=>'required',
        'email'=>'required|email|unique:usuarios,email',
        'usuario'=>'required|unique:usuarios,usuario',
        'contrasena'=>'required|min:8'
    ]);

    $usuario = Usuario::create([
        'nombre' => $request->nombre,
        'email' => $request->email,
        'usuario' => $request->usuario,
        'telefono' => $request->telefono,
        'contrasena' => bcrypt($request->contrasena),
        'rol' => 'barbero',
        'estado' => 1
    ]);


    $barbero = Barbero::create([
        'id_barbero' => $usuario->id_usuario
    ]);


    $dias = [
      'Lunes'=>1,
      'Martes'=>2,
      'Miercoles'=>3,
      'Jueves'=>4,
      'Viernes'=>5,
      'Sabado'=>6
    ];

    foreach($request->horarios as $dia=>$h){

        Horario::create([
            'id_barbero' => $barbero->id_barbero,
            'dia' => $dias[$dia],
            'hora_inicio' => $h['inicio'],
            'hora_fin' => $h['fin']
        ]);
    }

    return back()->with('success','Barbero registrado');
}
    public function updateProfile(Request $request)
    {
        return back();
    }

    public function updatePassword(Request $request)
    {
        return back();
    }

    public function storePost(Request $request)
    {
        return back();
    }

    public function destroyPost($id)
    {
        return back();
    }

    public function updateSchedule(Request $request)
    {
        return back();
    }
    
    public function index()
    {
        $config   = Configuracion::first(); 
        $barberos = \App\Models\Barbero::with('usuario')->get();
        return view('dashboard_admin', compact('config', 'barberos'));
    }

    public function toggleBarber($id)
    {
        $barbero = \App\Models\Barbero::findOrFail($id);
        $nuevoEstado = $barbero->usuario->estado ? 0 : 1;
        $barbero->usuario->update(['estado' => $nuevoEstado]);

        return back()->with('success', $nuevoEstado ? 'Barbero activado.' : 'Barbero desactivado.');
    }
    public function updateConfig(Request $request)
    {
        $request->validate([
            'nombre_negocio' => 'required|string|max:100',
            'hora_apertura'  => 'required|date_format:H:i',
            'hora_cierre'    => 'required|date_format:H:i|after:hora_apertura',
        ]);

        $config = Configuracion::instancia();
        $config->update($request->only([
            'nombre_negocio',
            'hora_apertura',
            'hora_cierre',
        ]));

        return back()->with('success', 'Configuración guardada.');
    }

    public function toggleBarberia()
    {
        $config         = Configuracion::first();
        $config->estado = ! $config->estado;
        $config->save();

        $msg = $config->estado ? 'Barbería abierta. Agenda habilitada.' 
                            : 'Barbería cerrada. Agenda bloqueada.';

        return back()->with('success', $msg);
    }

    public function updateBarberia(Request $request)
    {
        $request->validate([
            'nombre_negocio' => 'required|string|max:100',
            'hora_apertura'  => 'required|date_format:H:i',
            'hora_cierre'    => 'required|date_format:H:i|after:hora_apertura',
        ]);

        $config = Configuracion::first();
        $config->update($request->only([
            'nombre_negocio',
            'hora_apertura',
            'hora_cierre',
        ]));

        return back()->with('success', 'Configuración guardada correctamente.');
    }
}
