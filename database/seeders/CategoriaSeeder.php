<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoria::create(['nombre' => 'Electrónica', 'descripcion' => 'Artículos electrónicos']);
        Categoria::create(['nombre' => 'Hogar', 'descripcion' => 'Productos para el hogar']);
        Categoria::create(['nombre' => 'Juguetes', 'descripcion' => 'Juguetes para niños']);
        Categoria::create(['nombre' => 'Ropa', 'descripcion' => 'Vestimenta para todas las edades']);
        Categoria::create(['nombre' => 'Deportes', 'descripcion' => 'Accesorios y ropa deportiva']);
    }
}
