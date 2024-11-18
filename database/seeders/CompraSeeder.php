<?php

namespace Database\Seeders;

use App\Models\Compra;
use App\Models\CompraDetalle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $compras = [
            [
                'proveedor_id' => 1,
                'empleado_id' => 1,
                'fecha' => now(),
                'estado' => 1,
                'detalles' => [
                    ['producto_id' => 2, 'cantidad' => 10, 'precio_unitario' => 24.50],
                    ['producto_id' => 3, 'cantidad' => 5, 'precio_unitario' => 49.90],
                ],
            ],
            [
                'proveedor_id' => 2,
                'empleado_id' => 2,
                'fecha' => now()->subDays(1),
                'estado' => 1,
                'detalles' => [
                    ['producto_id' => 4, 'cantidad' => 50, 'precio_unitario' => 5.90],
                    ['producto_id' => 6, 'cantidad' => 10, 'precio_unitario' => 29.90],
                ],
            ],
            [
                'proveedor_id' => 3,
                'empleado_id' => 3,
                'fecha' => now()->subDays(2),
                'estado' => 1,
                'detalles' => [
                    ['producto_id' => 8, 'cantidad' => 7, 'precio_unitario' => 49.90],
                ],
            ],
        ];

        foreach ($compras as $compra) {
            $detalles = $compra['detalles'];
            unset($compra['detalles']);
            $compraModel = Compra::create($compra);

            foreach ($detalles as $detalle) {
                $detalle['compra_id'] = $compraModel->id;
                CompraDetalle::create($detalle);
            }
        }
    }
}
