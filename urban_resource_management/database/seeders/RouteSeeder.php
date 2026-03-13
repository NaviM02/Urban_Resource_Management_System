<?php

namespace Database\Seeders;

use App\Models\Route;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Route::insert([

            [
                'name'=>'Ruta Centro Norte',
                'zone_id'=>1,
                'waste_type_id'=>3,
                'status_id'=>1,
                'lat_start'=>14.8348,
                'lng_start'=>-91.5185,
                'lat_end'=>14.8420,
                'lng_end'=>-91.5120,
                'path_coordinates'=>json_encode([
                    [14.8348,-91.5185],
                    [14.8365,-91.5170],
                    [14.8380,-91.5155],
                    [14.8420,-91.5120]
                ]),
                'distance_km'=>3.5,
                'collection_days'=>'1010100',
                'start_time'=>'06:00',
                'end_time'=>'10:00'
            ]

        ]);
    }
}
