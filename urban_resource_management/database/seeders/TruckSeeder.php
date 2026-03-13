<?php

namespace Database\Seeders;

use App\Models\Truck;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TruckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Truck::insert([

            ['plate'=>'XEL-001','capacity_tons'=>8,'truck_status_id'=>1,'driver_name'=>'Juan Pérez','status_id'=>1],
            ['plate'=>'XEL-002','capacity_tons'=>10,'truck_status_id'=>1,'driver_name'=>'Carlos Gómez','status_id'=>1],
            ['plate'=>'XEL-003','capacity_tons'=>7,'truck_status_id'=>1,'driver_name'=>'Mario Díaz','status_id'=>1],
            ['plate'=>'XEL-004','capacity_tons'=>9,'truck_status_id'=>1,'driver_name'=>'Pedro Castillo','status_id'=>1],
            ['plate'=>'XEL-005','capacity_tons'=>6,'truck_status_id'=>2,'driver_name'=>'Luis Morales','status_id'=>1]

        ]);
    }
}
