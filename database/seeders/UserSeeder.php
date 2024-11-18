<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Ámbar Masiel Carhuapoma Castañeda',
            'email' => 'ambar@karnaval.pe',
            'password' => Hash::make('1234'),
        ]);

        User::create([
            'name' => 'Jhon Angelo Sanchez Garcia',
            'email' => 'jhon@karnaval.pe',
            'password' => Hash::make('1234'),
        ]);
    }
}
