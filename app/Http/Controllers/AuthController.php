<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Models\Usuario;
use App\Models\Cliente;
use App\Models\Barbero;
use App\Models\Administrador;
use App\Mail\RegistroExitoso;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function mostrar()
    {
        return view('login', [
            'active_panel' => 'login',
            'login_error'  => '',
            'reg_error'    => '',
            'reg_success'  => request('reset') ? 'La contraseña se restableció correctamente. Ya puedes iniciar sesión.' : '',
            'forgot_msg'   => '',
        ]);
    }
    public function login(Request $request)
    {
        $usuario  = trim($request->input('usuario', ''));
        $password = $request->input('password', '');

        if (empty($usuario) || empty($password)) {
            return view('login', [
                'active_panel' => 'login',
                'login_error'  => 'Completa todos los campos.',
                'reg_error'    => '',
                'reg_success'  => '',
                'forgot_msg'   => '',
            ]);
        }

        $user = Usuario::where('usuario', $usuario)
            ->where('estado', 1)
            ->first();

        if (!$user || !Hash::check($password, $user->contrasena)) {
            return view('login', [
                'active_panel' => 'login',
                'login_error'  => 'Usuario o contraseña incorrectos.',
                'reg_error'    => '',
                'reg_success'  => '',
                'forgot_msg'   => '',
            ]);
        }

        Auth::login($user);
        $request->session()->regenerate();

        return match ($user->rol) {
            'admin'   => redirect()->route('dashboard.admin'),
            'barbero' => redirect()->route('dashboard.barbero'),
            default   => redirect()->route('dashboard.cliente'),
        };
    }

    public function registro(Request $request)
    {
        $nombre   = trim($request->input('nombre', ''));
        $usuario  = trim($request->input('usuario', ''));
        $email    = trim($request->input('email', ''));
        $telefono = trim($request->input('telefono', ''));
        $password = $request->input('password', '');
        $confirm  = $request->input('confirmar', '');

        $base = ['active_panel' => 'registro', 'login_error' => '', 'reg_success' => '', 'forgot_msg' => ''];

        if (empty($nombre) || empty($usuario) || empty($email) || empty($telefono) || empty($password) || empty($confirm))
            return view('login', array_merge($base, ['reg_error' => 'Todos los campos son obligatorios.']));
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            return view('login', array_merge($base, ['reg_error' => 'El correo no tiene un formato válido.']));
        if (strlen($telefono) < 7)
            return view('login', array_merge($base, ['reg_error' => 'El teléfono no tiene un formato válido.']));
        if (strlen($password) < 6)
            return view('login', array_merge($base, ['reg_error' => 'La contraseña debe tener al menos 6 caracteres.']));
        if ($password !== $confirm)
            return view('login', array_merge($base, ['reg_error' => 'Las contraseñas no coinciden.']));
        if (Usuario::where('usuario', $usuario)->exists())
            return view('login', array_merge($base, ['reg_error' => 'Este usuario ya está registrado.']));
        if (Usuario::where('email', $email)->exists())
            return view('login', array_merge($base, ['reg_error' => 'Este correo ya está registrado.']));

        $user = Usuario::create([
            'nombre'     => $nombre,
            'usuario'    => $usuario,
            'email'      => $email,
            'telefono'   => $telefono,
            'contrasena' => Hash::make($password),
            'rol'        => 'cliente',
            'estado'     => true,
        ]);

        match ($user->rol) {
            'cliente' => Cliente::create(['id_cliente' => $user->id_usuario]),
            'barbero' => Barbero::create(['id_barbero' => $user->id_usuario]),
            'admin'   => Administrador::create(['id_administrador' => $user->id_usuario]),
        };

        try {
            Mail::to($user->email)->send(new RegistroExitoso($user->nombre));
        } catch (\Exception $e) {
            
        }

        return view('login', [
            'active_panel' => 'login',
            'login_error'  => '',
            'reg_error'    => '',
            'reg_success'  => '¡Cuenta creada exitosamente! Ya puedes iniciar sesión.',
            'forgot_msg'   => '',
        ]);

        return view('login', ['active_panel' => 'login', 'login_error' => '', 'reg_error' => '', 'reg_success' => '¡Cuenta creada exitosamente! Ya puedes iniciar sesión.', 'forgot_msg' => '']);
    }
    public function recuperar(Request $request)
    {
        $correo = trim($request->input('correo_recuperar', ''));
        $base   = ['active_panel' => 'forgot', 'login_error' => '', 'reg_error' => '', 'reg_success' => ''];

        if (empty($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL))
            return view('login', array_merge($base, ['forgot_msg' => 'Ingresa un correo válido.']));

        $user = Usuario::where('email', $correo)->where('estado', 1)->first();

        if (!$user) {
            return view('login', array_merge($base, ['forgot_msg' => 'Si el correo existe, recibirás instrucciones en breve.']));
        }

        Password::broker()->sendResetLink(['email' => $correo]);

        return view('login', array_merge($base, ['forgot_msg' => 'Si el correo existe, recibirás instrucciones en breve.']));
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    }
}
