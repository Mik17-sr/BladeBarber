<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Validations\Validacion;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function sendLink(Request $request)
    {
        $validador = Validacion::recuperar($request->all());

        if ($validador->fails()) {
            return back()
                ->withErrors($validador, 'forgotForm')
                ->withInput();
        }

        // Password::sendResetLink($request->only('email'));

        return back()
            ->with('forgot_status', 'Si el correo existe, recibirás instrucciones en breve.');
    }
}