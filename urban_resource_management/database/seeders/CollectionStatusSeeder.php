<?php

namespace Database\Seeders;

use App\Models\CollectionStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CollectionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CollectionStatus::insert([
            ['id'=>1,'name'=>'Programada'],
            ['id'=>2,'name'=>'En proceso'],
            ['id'=>3,'name'=>'Completada'],
            ['id'=>4,'name'=>'Incompleta'],
        ]);
    }
}
