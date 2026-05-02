<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        Usuario::updateOrCreate(
            ['email' => 'admin@bladebarber.com'],
            [
                'nombre' => 'Administrador',
                'usuario' => 'admin',
                'telefono' => '3000000000',
                'contrasena' => Hash::make('123456'),
                'rol' => 'admin',
                'estado' => true,
            ]
        );
    }
}
