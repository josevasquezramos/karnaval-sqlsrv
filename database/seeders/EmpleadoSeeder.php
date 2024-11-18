<?php

namespace Database\Seeders;

use App\Models\Empleado;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Empleado::create([
            'dni' => '87654321',
            'apellido_paterno' => 'Lopez',
            'apellido_materno' => 'Perez',
            'nombres' => 'Javier Antonio',
            'celular' => '999888777',
            'correo' => 'javier.lopez@bazar.com',
            'usuario' => 'javierl',
            'clave' => Hash::make('empleado123'),
            'estado' => 1,
        ]);

        Empleado::create([
            'dni' => '76543210',
            'apellido_paterno' => 'Diaz',
            'apellido_materno' => 'Torres',
            'nombres' => 'Rosa María',
            'celular' => '999888776',
            'correo' => 'rosa.diaz@bazar.com',
            'usuario' => 'rosad',
            'clave' => Hash::make('empleado123'),
            'estado' => 0,
        ]);

        Empleado::create([
            'dni' => '65432109',
            'apellido_paterno' => 'Perez',
            'apellido_materno' => 'Garcia',
            'nombres' => 'Juan Pablo',
            'celular' => '999888775',
            'correo' => 'luis.perez@bazar.com',
            'usuario' => 'luisp',
            'clave' => Hash::make('empleado123'),
            'estado' => 1,
        ]);

        Empleado::create([
            'dni' => '54321098',
            'apellido_paterno' => 'Martinez',
            'apellido_materno' => 'Soto',
            'nombres' => 'Clara Patricia',
            'celular' => '999888774',
            'correo' => 'clara.martinez@bazar.com',
            'usuario' => 'claram',
            'clave' => Hash::make('empleado123'),
            'estado' => 1,
        ]);

        Empleado::create([
            'dni' => '43210987',
            'apellido_paterno' => 'Torres',
            'apellido_materno' => 'Vega',
            'nombres' => 'Andres Felipe',
            'celular' => '999888773',
            'correo' => 'andres.torres@bazar.com',
            'usuario' => 'andrest',
            'clave' => Hash::make('empleado123'),
            'estado' => 1,
        ]);
    }
}
