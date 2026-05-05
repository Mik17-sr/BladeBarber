<?php

namespace App\Http\Controllers;

use App\Models\Barbero;
use App\Models\Configuracion;
use App\Models\Publicacion;
use App\Models\User;
use App\Models\Horario;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Muro;
use App\Models\Imagen;

class AdminController extends Controller
{

    public function storeBarber(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email|unique:usuarios,email',
            'usuario' => 'required|unique:usuarios,usuario',
            'contrasena' => 'required|min:8'
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
            'Lunes' => 1,
            'Martes' => 2,
            'Miercoles' => 3,
            'Jueves' => 4,
            'Viernes' => 5,
            'Sabado' => 6
        ];

        foreach ($request->horarios as $dia => $h) {

            Horario::create([
                'id_barbero' => $barbero->id_barbero,
                'dia' => $dias[$dia],
                'hora_inicio' => $h['inicio'],
                'hora_fin' => $h['fin']
            ]);
        }

        return back()->with('success', 'Barbero registrado');
    }
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'nombre'   => 'required|string|max:100',
            'email'    => 'required|email|unique:usuarios,email,' . $user->id_usuario . ',id_usuario',
            'usuario'  => 'required|string|max:50|unique:usuarios,usuario,' . $user->id_usuario . ',id_usuario',
            'telefono' => 'nullable|string|max:20',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['nombre', 'email', 'usuario', 'telefono']);

        if ($request->hasFile('foto')) {
            if ($user->foto) {
                \Storage::disk('public')->delete($user->foto);
            }
            // Guardar nueva
            $data['foto'] = $request->file('foto')->store('avatars', 'public');
        }

        $user->update($data);

        return back()->with('success', 'Perfil actualizado correctamente.');
    }

    public function updatePassword(Request $request)
    {
        return back();
    }

    public function storePost(Request $request)
    {
        $request->validate([
            'content'  => 'required|string',
            'image'    => 'nullable|image|max:2048',
        ]);

        $muro = Muro::firstOrCreate(
            ['id_usuario' => auth()->user()->id_usuario]
        );

        $publicacion = Publicacion::create([
            'id_muro'   => $muro->id_muro,
            'contenido' => $request->content,
            'fecha'     => now()->toDateString(),
        ]);


        if ($request->hasFile('image')) {
            $ruta = $request->file('image')->store('publicaciones', 'public');

            Imagen::create([
                'id_publicacion' => $publicacion->id_publicacion,
                'imagen'         => $ruta,
            ]);
        }

        return redirect()->back()->with('success', 'Publicación creada.');
    } 

    public function updateSchedule(Request $request)
    {
        return back();
    }

    public function index()
    {
        $posts = Publicacion::with(['imagenes', 'muro.usuario'])
                ->orderBy('fecha', 'desc')
                ->get();
        $config   = Configuracion::first();
        $barberos = Barbero::with('usuario')->get();
        return view('dashboard_admin', compact('posts', 'config', 'barberos'));
        
    }

    public function toggleBarber($id)
    {
        $barbero = Barbero::findOrFail($id);
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

    public function updatePost(Request $request, $id)
    {
        $publicacion = Publicacion::findOrFail($id);
        $publicacion->update([
            'contenido' => $request->contenido,
        ]);

        return redirect()->back()->with('success', 'Publicación actualizada.');
    }

    public function destroyPost($id)
    {
        $publicacion = Publicacion::findOrFail($id);

        // Eliminar imágenes del storage
        foreach ($publicacion->imagenes as $img) {
            \Storage::disk('public')->delete($img->imagen);
            $img->delete();
        }

        $publicacion->delete();

        return redirect()->back()->with('success', 'Publicación eliminada.');
    }
}
