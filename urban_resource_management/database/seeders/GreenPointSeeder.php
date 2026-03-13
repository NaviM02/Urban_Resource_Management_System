<?php

namespace Database\Seeders;

use App\Models\Container;
use App\Models\GreenPoint;
use App\Models\MaterialType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GreenPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $greenPoints = [

            ['name'=>'Punto Verde Parque Central','address'=>'Parque Central','status_id'=>1,'lat'=>14.8349,'lng'=>-91.5187,'capacity_m3'=>20,'open_time'=>'08:00','close_time'=>'18:00','manager_user_id'=>5],

            ['name'=>'Punto Verde Minerva','address'=>'Parque Minerva','status_id'=>1,'lat'=>14.8476,'lng'=>-91.5202,'capacity_m3'=>15,'open_time'=>'08:00','close_time'=>'17:00','manager_user_id'=>5],

            ['name'=>'Punto Verde Las Flores','address'=>'Zona Las Flores','status_id'=>1,'lat'=>14.8500,'lng'=>-91.5120,'capacity_m3'=>12,'open_time'=>'08:00','close_time'=>'17:00','manager_user_id'=>6],

            ['name'=>'Punto Verde La Democracia','address'=>'Colonia La Democracia','status_id'=>1,'lat'=>14.8280,'lng'=>-91.5250,'capacity_m3'=>10,'open_time'=>'08:00','close_time'=>'17:00','manager_user_id'=>6],

            ['name'=>'Punto Verde Terminal','address'=>'Terminal de buses','status_id'=>1,'lat'=>14.8380,'lng'=>-91.5220,'capacity_m3'=>18,'open_time'=>'08:00','close_time'=>'18:00','manager_user_id'=>7],

            ['name'=>'Punto Verde Zona 5','address'=>'Zona 5','status_id'=>1,'lat'=>14.8430,'lng'=>-91.5100,'capacity_m3'=>14,'open_time'=>'08:00','close_time'=>'17:00','manager_user_id'=>7],

            ['name'=>'Punto Verde Universidad','address'=>'Área universitaria','status_id'=>1,'lat'=>14.8485,'lng'=>-91.5230,'capacity_m3'=>16,'open_time'=>'08:00','close_time'=>'18:00','manager_user_id'=>5]


        ];

        $materials = MaterialType::all();

        foreach ($greenPoints as $data) {

            $greenPoint = GreenPoint::create($data);

            foreach ($materials as $material) {

                Container::create([
                    'green_point_id' => $greenPoint->id,
                    'material_type_id' => $material->id,
                    'capacity_kg' => 500,
                    'current_kg' => 0
                ]);

            }

        }
    }
}
