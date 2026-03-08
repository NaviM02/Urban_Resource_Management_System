<?php

namespace Database\Seeders;

use App\Models\TruckStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TruckStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TruckStatus::insert([
            ['id' => 1, 'name' => 'Operativo'],
            ['id' => 2, 'name' => 'En mantenimiento'],
            ['id' => 3, 'name' => 'Fuera de servicio'],
        ]);
    }
}
