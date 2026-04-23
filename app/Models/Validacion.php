<?php
namespace App\Validations;

use Illuminate\Support\Facades\Validator;

class Validacion
{
    private static function reglasRegistro(): array
    {
        return [
            'nombre'                => 'required|string|max:100',
            'email'                 => 'required|email|unique:usuarios,email',
            'usuario'               => 'required|string|max:80|unique:usuarios,usuario',
            'password'              => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ];
    }

    private static function reglasLogin(): array
    {
        return [
            'email'    => 'required|email',
            'password' => 'required',
        ];
    }

    private static function reglasRecuperar(): array
    {
        return [
            'email' => 'required|email|exists:usuarios,email',
        ];
    }

    private static function reglasBarbero(int $idExcluir = null): array
    {
        $uniqueEmail    = 'unique:usuarios,email';
        $uniqueUsuario  = 'unique:usuarios,usuario';
        $uniqueTelefono = 'unique:usuarios,telefono';

        if ($idExcluir) {
            $uniqueEmail    = "unique:usuarios,email,{$idExcluir},id_usuario";
            $uniqueUsuario  = "unique:usuarios,usuario,{$idExcluir},id_usuario";
            $uniqueTelefono = "unique:usuarios,telefono,{$idExcluir},id_usuario";
        }

        return [
            'nombre'       => 'required|string|max:100',
            'email'        => "required|email|{$uniqueEmail}",
            'usuario'      => "required|string|max:80|{$uniqueUsuario}",
            'telefono'     => "required|string|max:20|{$uniqueTelefono}",
            'password'     => 'required|min:6',
            'especialidad' => 'nullable|string|max:100',
            'bio'          => 'nullable|string|max:500',
        ];
    }

    public static function barbero(array $datos, int $idExcluir = null): \Illuminate\Validation\Validator
    {
        return Validator::make($datos, static::reglasBarbero($idExcluir), static::mensajes());
    }

    private static function mensajes(): array
    {
        return [
            'nombre.required'               => 'El nombre es obligatorio.',
            'nombre.max'                    => 'El nombre no puede superar 100 caracteres.',
            'email.required'                => 'El correo es obligatorio.',
            'email.email'                   => 'El correo no tiene un formato válido.',
            'email.unique'                  => 'Este correo ya está registrado en el sistema.',
            'email.exists'                  => 'No encontramos una cuenta con ese correo.',
            'usuario.required'              => 'El nombre de usuario es obligatorio.',
            'usuario.max'                   => 'El usuario no puede superar 80 caracteres.',
            'usuario.unique'                => 'Este nombre de usuario ya está en uso.',
            'telefono.required'             => 'El teléfono es obligatorio.',
            'telefono.unique'               => 'Este número de teléfono ya está registrado.',
            'password.required'             => 'La contraseña es obligatoria.',
            'password.min'                  => 'La contraseña debe tener al menos 6 caracteres.',
            'password_confirmation.required' => 'Por favor confirma tu contraseña.',
            'password_confirmation.same'    => 'Las contraseñas no coinciden.',
            'especialidad.max'              => 'La especialidad no puede superar 100 caracteres.',
            'bio.max'                       => 'La descripción no puede superar 500 caracteres.',
        ];
    }

    public static function registro(array $datos): \Illuminate\Validation\Validator
    {
        return Validator::make($datos, static::reglasRegistro(), static::mensajes());
    }

    public static function login(array $datos): \Illuminate\Validation\Validator
    {
        return Validator::make($datos, static::reglasLogin(), static::mensajes());
    }

    public static function recuperar(array $datos): \Illuminate\Validation\Validator
    {
        return Validator::make($datos, static::reglasRecuperar(), static::mensajes());
    }
}