<?php

namespace Database\Seeders;

use App\Models\ComplaintStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComplaintStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ComplaintStatus::insert([
            ['id'=>1,'name'=>'Recibida'],
            ['id'=>2,'name'=>'En revisión'],
            ['id'=>3,'name'=>'Asignada'],
            ['id'=>4,'name'=>'En atención'],
            ['id'=>5,'name'=>'Atendida'],
            ['id'=>6,'name'=>'Cerrada']
        ]);
    }
}
