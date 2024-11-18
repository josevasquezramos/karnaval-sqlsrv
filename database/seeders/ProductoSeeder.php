<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Producto::create([
            'nombre' => 'Funda para celular',
            'precio_unitario' => 19.90,
            'stock' => 50,
            'ubicacion_almacen' => 'A-12',
            'id_categoria' => 1,
            'estado' => 1,
        ]);

        Producto::create([
            'nombre' => 'Cargador USB',
            'precio_unitario' => 24.50,
            'stock' => 30,
            'ubicacion_almacen' => 'A-15',
            'id_categoria' => 1,
            'estado' => 1,
        ]);

        Producto::create([
            'nombre' => 'Set de utensilios de cocina',
            'precio_unitario' => 49.90,
            'stock' => 20,
            'ubicacion_almacen' => 'B-13',
            'id_categoria' => 2,
            'estado' => 1,
        ]);

        Producto::create([
            'nombre' => 'Cuaderno escolar',
            'precio_unitario' => 5.90,
            'stock' => 100,
            'ubicacion_almacen' => 'C-14',
            'id_categoria' => 2,
            'estado' => 1,
        ]);

        Producto::create([
            'nombre' => 'Pelota de plástico',
            'precio_unitario' => 15.90,
            'stock' => 40,
            'ubicacion_almacen' => 'D-18',
            'id_categoria' => 3,
            'estado' => 1,
        ]);

        Producto::create([
            'nombre' => 'Juguete de bloques',
            'precio_unitario' => 29.90,
            'stock' => 30,
            'ubicacion_almacen' => 'D-16',
            'id_categoria' => 3,
            'estado' => 1,
        ]);

        Producto::create([
            'nombre' => 'Polo de algodón',
            'precio_unitario' => 35.90,
            'stock' => 25,
            'ubicacion_almacen' => 'D-17',
            'id_categoria' => 4,
            'estado' => 1,
        ]);

        Producto::create([
            'nombre' => 'Pantalón deportivo',
            'precio_unitario' => 49.90,
            'stock' => 20,
            'ubicacion_almacen' => 'E-10',
            'id_categoria' => 5,
            'estado' => 1,
        ]);
    }
}
