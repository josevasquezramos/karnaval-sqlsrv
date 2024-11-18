<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Hash;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cliente::create([
            'dni' => '12345678',
            'apellido_paterno' => 'Perez',
            'apellido_materno' => 'Gomez',
            'nombres' => 'Juan Carlos',
            'celular' => '987654321',
            'correo' => 'juan.perez@gmail.com',
            'genero' => 'M',
            'usuario' => 'juan123',
            'clave' => Hash::make('password123'),
            'estado' => 1,
        ]);

        Cliente::create([
            'dni' => '23456789',
            'apellido_paterno' => 'Rodriguez',
            'apellido_materno' => 'Lopez',
            'nombres' => 'Maria Fernanda',
            'celular' => '987654322',
            'correo' => 'maria.lopez@gmail.com',
            'genero' => 'F',
            'usuario' => 'mariaf',
            'clave' => Hash::make('password123'),
            'estado' => 1,
        ]);

        Cliente::create([
            'dni' => '34567890',
            'apellido_paterno' => 'Castro',
            'apellido_materno' => 'Sanchez',
            'nombres' => 'Luis Alberto',
            'celular' => '987654323',
            'correo' => 'luis.castro@gmail.com',
            'genero' => 'M',
            'usuario' => 'luisca',
            'clave' => Hash::make('password123'),
            'estado' => 1,
        ]);

        Cliente::create([
            'dni' => '45678901',
            'apellido_paterno' => 'Garcia',
            'apellido_materno' => 'Torres',
            'nombres' => 'Carla Patricia',
            'celular' => '987654324',
            'correo' => 'carla.torres@gmail.com',
            'genero' => 'F',
            'usuario' => 'carlapt',
            'clave' => Hash::make('password123'),
            'estado' => 0,
        ]);

        Cliente::create([
            'dni' => '56789012',
            'apellido_paterno' => 'Martinez',
            'apellido_materno' => 'Diaz',
            'nombres' => 'Pedro Pablo',
            'celular' => '987654325',
            'correo' => 'pedro.martinez@gmail.com',
            'genero' => 'M',
            'usuario' => 'pedrop',
            'clave' => Hash::make('password123'),
            'estado' => 1,
        ]);
    }
}
