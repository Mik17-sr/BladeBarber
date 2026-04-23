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
    public function updateProfile(Request $request)
    {
        $user = Usuario::findOrFail(auth()->user()->id_usuario);

        $user->update([
            'nombre'       => $request->name,
            'email'        => $request->email,
            'telefono'     => $request->phone,
            'especialidad' => $request->specialty,
            'bio'          => $request->bio,
        ]);

        return back()->with('success', 'Perfil actualizado correctamente.');
    }

    public function updatePassword(Request $request)
    {
        $user = Usuario::findOrFail(auth()->user()->id_usuario);

        if (!Hash::check($request->current_password, $user->contrasena)) {
            return back()->withErrors(['current_password' => 'La contraseña actual es incorrecta.']);
        }

        if ($request->password !== $request->password_confirmation) {
            return back()->withErrors(['password' => 'Las contraseñas no coinciden.']);
        }

        $user->update([
            'contrasena' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Contraseña actualizada correctamente.');
    }
}
