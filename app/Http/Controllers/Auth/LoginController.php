<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\Cliente;
use App\Models\Barbero;
use App\Models\Administrador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistroExitoso;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function handlePost(Request $request)
    {
        $action = $request->input('action');

        if ($action === 'login') {
            return $this->login($request);
        } elseif ($action === 'registro') {
            return $this->register($request);
        } elseif ($action === 'recuperar') {
            return $this->forgotPassword($request);
        }

        return back()->withErrors('Acción no válida.');
    }

    private function login(Request $request)
    {
        $usuario = trim($request->input('usuario', ''));
        $password = $request->input('password', '');

        if (empty($usuario) || empty($password)) {
            return back()->with('login_error', 'Por favor completa todos los campos.')->with('active_panel', 'login');
        }

        $user = Usuario::where('usuario', $usuario)->where('estado', true)->first();
        if ($user && Hash::check($password, $user->contrasena)) {
            session(['usuario_id' => $user->id_usuario, 'usuario_nombre' => $user->nombre, 'usuario_rol' => $user->rol]);
            switch ($user->rol) {
                case 'admin':
                    return redirect('dashboard_admin.php');
                case 'barbero':
                    return redirect('dashboard_barbero.php');
                default:
                    return redirect('dashboard_cliente.php');
            }
        } else {
            return back()->with('login_error', 'Usuario o contraseña incorrectos.')->with('active_panel', 'login');
        }
    }

    private function register(Request $request)
    {
        $nombre = trim($request->input('nombre', ''));
        $usuario = trim($request->input('usuario', ''));
        $email = trim($request->input('email', ''));
        $telefono = trim($request->input('telefono', ''));
        $password = $request->input('password', '');
        $confirm = $request->input('confirmar', '');

        if (empty($nombre) || empty($usuario) || empty($email) || empty($telefono) || empty($password) || empty($confirm)) {
            return back()->with('reg_error', 'Todos los campos son obligatorios.')->with('active_panel', 'registro')->withInput();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return back()->with('reg_error', 'El correo no tiene un formato válido.')->with('active_panel', 'registro')->withInput();
        }

        if (strlen($telefono) < 7) {
            return back()->with('reg_error', 'El teléfono no tiene un formato válido.')->with('active_panel', 'registro')->withInput();
        }

        if (strlen($password) < 6) {
            return back()->with('reg_error', 'La contraseña debe tener al menos 6 caracteres.')->with('active_panel', 'registro')->withInput();
        }

        if ($password !== $confirm) {
            return back()->with('reg_error', 'Las contraseñas no coinciden.')->with('active_panel', 'registro')->withInput();
        }

        $existe_usuario = Usuario::where('usuario', $usuario)->exists();
        $existe_email = Usuario::where('email', $email)->exists();
        if ($existe_usuario) {
            return back()->with('reg_error', 'Este usuario ya está registrado.')->with('active_panel', 'registro')->withInput();
        }
        if ($existe_email) {
            return back()->with('reg_error', 'Este correo ya está registrado.')->with('active_panel', 'registro')->withInput();
        }

        $user = Usuario::create([
            'nombre' => $nombre,
            'usuario' => $usuario,
            'email' => $email,
            'telefono' => $telefono,
            'contrasena' => Hash::make($password),
            'rol' => 'cliente',
            'estado' => true,
        ]);

        switch ($user->rol) {
            case 'cliente':
                Cliente::create(['id_cliente' => $user->id_usuario]);
                break;
            case 'barbero':
                Barbero::create(['id_barbero' => $user->id_usuario]);
                break;
            case 'admin':
                Administrador::create(['id_administrador' => $user->id_usuario]);
                break;
        }

        // Enviar email de bienvenida
        Mail::to($user->email)->send(new RegistroExitoso($user->nombre));

        return back()->with('reg_success', '¡Cuenta creada exitosamente! Ya puedes iniciar sesión.')->with('active_panel', 'login');
    }

    private function forgotPassword(Request $request)
    {
        $correo = trim($request->input('correo_recuperar', ''));

        if (empty($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            return back()->with('forgot_msg', 'Ingresa un correo válido.')->with('active_panel', 'forgot');
        }

        $status = Password::sendResetLink(['email' => $correo]);

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('forgot_msg', 'Si el correo existe, recibirás instrucciones en breve.')->with('active_panel', 'forgot');
        } else {
            return back()->with('forgot_msg', 'No se pudo enviar el enlace de recuperación. Intenta nuevamente.')->with('active_panel', 'forgot');
        }
    }

    public function logout(Request $request)
    {
        session()->flush();
        return redirect()->route('login');
    }
}