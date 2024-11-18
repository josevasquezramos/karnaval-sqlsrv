<?php

namespace Database\Seeders;

use App\Models\Pedido;
use App\Models\PedidoDetalle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pedidos = [
            [
                'id_cliente' => 1,
                'fecha' => now(),
                'descuento' => 5.00,
                'tipo_comprobante' => 'B',
                'estado' => 1,
                'detalles' => [
                    ['producto_id' => 1, 'cantidad' => 2, 'precio_unitario' => 19.90],
                    ['producto_id' => 5, 'cantidad' => 1, 'precio_unitario' => 15.90],
                ],
            ],
            [
                'id_cliente' => 2,
                'fecha' => now()->subDays(1),
                'descuento' => 2.50,
                'tipo_comprobante' => 'F',
                'estado' => 1,
                'detalles' => [
                    ['producto_id' => 4, 'cantidad' => 10, 'precio_unitario' => 5.90],
                    ['producto_id' => 6, 'cantidad' => 2, 'precio_unitario' => 29.90],
                ],
            ],
            [
                'id_cliente' => 3,
                'fecha' => now()->subDays(2),
                'descuento' => 10.00,
                'tipo_comprobante' => 'B',
                'estado' => 1,
                'detalles' => [
                    ['producto_id' => 7, 'cantidad' => 1, 'precio_unitario' => 35.90],
                ],
            ],
        ];

        foreach ($pedidos as $pedido) {
            $detalles = $pedido['detalles'];
            unset($pedido['detalles']);
            $pedidoModel = Pedido::create($pedido);

            foreach ($detalles as $detalle) {
                $detalle['pedido_id'] = $pedidoModel->id;
                PedidoDetalle::create($detalle);
            }
        }
    }
}
