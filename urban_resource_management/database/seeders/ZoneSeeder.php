<?php

namespace Database\Seeders;

use App\Models\Zone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Zone::insert([

            ['name'=>'Centro Histórico','description'=>'Zona central de la ciudad','status_id'=>1,'zone_type_id'=>2],
            ['name'=>'Las Flores','description'=>'Zona residencial norte','status_id'=>1,'zone_type_id'=>1],
            ['name'=>'Minerva','description'=>'Área comercial y universitaria','status_id'=>1,'zone_type_id'=>2],
            ['name'=>'La Democracia','description'=>'Zona residencial sur','status_id'=>1,'zone_type_id'=>1],
            ['name'=>'Zona Industrial','description'=>'Área industrial de la ciudad','status_id'=>1,'zone_type_id'=>3]

        ]);
    }
}
