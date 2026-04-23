<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Validations\Validacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validador = Validacion::registro($request->all());

        if ($validador->fails()) {
            return back()
                ->withErrors($validador, 'registerForm')
                ->withInput();
        }

        Usuario::create([
            'nombre'     => $request->nombre,
            'email'      => $request->email,
            'usuario'    => $request->usuario,
            'telefono'   => $request->telefono,
            'contrasena' => Hash::make($request->password),
            'rol'        => 'cliente',
            'estado'     => 1,
        ]);

        return redirect()->route('login')
            ->with('reg_success', '¡Cuenta creada! Ya puedes iniciar sesión.');
    }
}