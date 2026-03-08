<?php

namespace Database\Seeders;

use App\Models\ZoneType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ZoneTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ZoneType::insert([
            ['name' => 'Residencial'],
            ['name' => 'Comercial'],
            ['name' => 'Industrial']
        ]);
    }
}
