<?php

namespace Database\Seeders;

use App\Models\Proveedor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Proveedor::create([
            'ruc' => '20123456789',
            'razon_social' => 'ElectroPerú S.A.',
            'celular' => '999888777',
            'direccion' => 'Av. Siempre Viva 123',
            'estado' => 1,
        ]);

        Proveedor::create([
            'ruc' => '20234567890',
            'razon_social' => 'Hogar Feliz',
            'celular' => '999888776',
            'direccion' => 'Calle Falsa 456',
            'estado' => 1,
        ]);

        Proveedor::create([
            'ruc' => '20345678901',
            'razon_social' => 'Ropa y Más',
            'celular' => '999888775',
            'direccion' => 'Jr. Comercio 789',
            'estado' => 1,
        ]);

        Proveedor::create([
            'ruc' => '20456789012',
            'razon_social' => 'Deportes S.A.',
            'celular' => '999888774',
            'direccion' => 'Av. Atletas 101',
            'estado' => 1,
        ]);

        Proveedor::create([
            'ruc' => '20567890123',
            'razon_social' => 'Juguetería Mágica',
            'celular' => '999888773',
            'direccion' => 'Av. Juegos 202',
            'estado' => 1,
        ]);
    }
}
