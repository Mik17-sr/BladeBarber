<?php

namespace Database\Seeders;

use App\Models\Usuario;
use App\Models\Cliente;
use App\Models\Barbero;
use App\Models\Administrador;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user1 = Usuario::create([
            'nombre' => 'Carlos Méndez',
            'usuario' => 'carlos',
            'email' => 'carlos@barberos.com',
            'contrasena' => Hash::make('demo123'),
            'rol' => 'cliente',
            'estado' => true,
        ]);
        Cliente::create(['id_cliente' => $user1->id_usuario]);

        $user2 = Usuario::create([
            'nombre' => 'Juan Rodríguez',
            'usuario' => 'juan.barbero',
            'email' => 'juan.barbero@barberos.com',
            'contrasena' => Hash::make('barber2025'),
            'rol' => 'barbero',
            'estado' => true,
        ]);
        Barbero::create(['id_barbero' => $user2->id_usuario]);

        $user3 = Usuario::create([
            'nombre' => 'Super Admin',
            'usuario' => 'admin',
            'email' => 'admin@barberos.com',
            'contrasena' => Hash::make('admin2025'),
            'rol' => 'admin',
            'estado' => true,
        ]);
        Administrador::create(['id_administrador' => $user3->id_usuario]);
    }
}
