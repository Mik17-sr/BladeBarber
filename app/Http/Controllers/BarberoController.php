<?php

namespace App\Http\Controllers;

use App\Models\Barbero;
use App\Models\Usuario;
use App\Validations\Validacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BarberoController extends Controller
{
    public function store(Request $request)
    {
        $validador = Validacion::barbero($request->all());

        if ($validador->fails()) {
            return back()
                ->withErrors($validador, 'barberoForm')
                ->withInput()
                ->with('panel', 'barber-register');
        }

        try {
            DB::transaction(function () use ($request) {
                $usuario = Usuario::create([
                    'nombre'       => $request->nombre,
                    'email'        => $request->email,
                    'usuario'      => $request->usuario,
                    'contrasena'   => Hash::make($request->password),
                    'telefono'     => $request->telefono,
                    'especialidad' => $request->especialidad,
                    'bio'          => $request->bio,
                    'rol'          => 'barbero',
                    'estado'       => 1,
                ]);

                Barbero::create([
                    'id_usuario' => $usuario->id_usuario,
                ]);
            });

        } catch (\Exception $e) {
            return back()
                ->withErrors(['general' => 'Error al registrar el barbero: ' . $e->getMessage()], 'barberoForm')
                ->withInput()
                ->with('panel', 'barber-register');
        }

        return redirect()->route('admin.dashboard')
            ->with('success', 'Barbero registrado exitosamente.')
            ->with('panel', 'barbers-list');
    }
}
