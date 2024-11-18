<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TipoCambioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tiposCambio = [
            // Datos históricos de USD a PEN
            ['moneda_origen' => 'USD', 'moneda_destino' => 'PEN', 'tasa' => 3.2850, 'fecha' => '2018-01-04 00:00:00'],
            ['moneda_origen' => 'USD', 'moneda_destino' => 'PEN', 'tasa' => 3.2880, 'fecha' => '2018-11-15 00:00:00'],
            ['moneda_origen' => 'USD', 'moneda_destino' => 'PEN', 'tasa' => 3.3350, 'fecha' => '2019-07-11 00:00:00'],
            ['moneda_origen' => 'USD', 'moneda_destino' => 'PEN', 'tasa' => 3.3380, 'fecha' => '2019-09-02 00:00:00'],
            ['moneda_origen' => 'USD', 'moneda_destino' => 'PEN', 'tasa' => 3.4920, 'fecha' => '2020-01-02 00:00:00'],
            ['moneda_origen' => 'USD', 'moneda_destino' => 'PEN', 'tasa' => 3.4970, 'fecha' => '2020-11-16 00:00:00'],
            ['moneda_origen' => 'USD', 'moneda_destino' => 'PEN', 'tasa' => 3.8780, 'fecha' => '2021-04-08 00:00:00'],
            ['moneda_origen' => 'USD', 'moneda_destino' => 'PEN', 'tasa' => 3.8860, 'fecha' => '2021-09-30 00:00:00'],
            ['moneda_origen' => 'USD', 'moneda_destino' => 'PEN', 'tasa' => 3.8310, 'fecha' => '2022-04-04 00:00:00'],
            ['moneda_origen' => 'USD', 'moneda_destino' => 'PEN', 'tasa' => 3.8400, 'fecha' => '2022-10-24 00:00:00'],
            ['moneda_origen' => 'USD', 'moneda_destino' => 'PEN', 'tasa' => 3.7390, 'fecha' => '2023-07-18 00:00:00'],
            ['moneda_origen' => 'USD', 'moneda_destino' => 'PEN', 'tasa' => 3.7460, 'fecha' => '2023-01-25 00:00:00'],
            ['moneda_origen' => 'USD', 'moneda_destino' => 'PEN', 'tasa' => 3.7460, 'fecha' => '2024-03-13 00:00:00'],
            ['moneda_origen' => 'USD', 'moneda_destino' => 'PEN', 'tasa' => 3.7550, 'fecha' => '2024-02-13 00:00:00'],
            // Datos históricos de EUR a PEN
            ['moneda_origen' => 'EUR', 'moneda_destino' => 'PEN', 'tasa' => 4.0150, 'fecha' => '2024-11-11 00:00:00'],
            ['moneda_origen' => 'EUR', 'moneda_destino' => 'PEN', 'tasa' => 4.0450, 'fecha' => '2024-11-09 00:00:00'],
            ['moneda_origen' => 'EUR', 'moneda_destino' => 'PEN', 'tasa' => 4.0670, 'fecha' => '2024-11-07 00:00:00'],
            ['moneda_origen' => 'EUR', 'moneda_destino' => 'PEN', 'tasa' => 4.0400, 'fecha' => '2024-11-06 00:00:00'],
            ['moneda_origen' => 'EUR', 'moneda_destino' => 'PEN', 'tasa' => 4.1080, 'fecha' => '2024-11-05 00:00:00'],
            ['moneda_origen' => 'EUR', 'moneda_destino' => 'PEN', 'tasa' => 4.1190, 'fecha' => '2024-11-04 00:00:00'],
        ];

        foreach ($tiposCambio as $tipoCambio) {
            DB::table('tipo_cambio')->insert([
                'moneda_origen' => $tipoCambio['moneda_origen'],
                'moneda_destino' => $tipoCambio['moneda_destino'],
                'tasa' => $tipoCambio['tasa'],
                'fecha' => Carbon::parse($tipoCambio['fecha']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
