<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;

class Usuario extends Authenticatable implements CanResetPassword
{
    use Notifiable, CanResetPasswordTrait;

    protected $table      = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'nombre',
        'email',
        'usuario',
        'telefono',
        'contrasena',
        'rol',
        'estado',
        'foto',  
    ];

    protected $hidden = ['contrasena'];

    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    public function getAuthIdentifierName()
    {
        return 'usuario';
    }

    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\ResetPassword($token));
    }
    public function setRememberToken($value)
    {
    }
    public function horarios()
    {
    return $this->hasMany(Horario::class,'id_barbero','id_usuario');
    }

    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'id_cliente', 'id_usuario');
    }

    public function barbero()
    {
        return $this->hasOne(Barbero::class, 'id_barbero', 'id_usuario');
    }

    public function muro()
    {
        return $this->hasOne(Muro::class, 'id_usuario', 'id_usuario');
    }
}