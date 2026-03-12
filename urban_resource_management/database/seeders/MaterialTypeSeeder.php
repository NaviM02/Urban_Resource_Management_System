<?php

namespace Database\Seeders;

use App\Models\MaterialType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MaterialType::insert([
            ['id' => 1, 'name' => 'Papel y cartón'],
            ['id' => 2, 'name' => 'Plástico (PET, HDPE, etc.)'],
            ['id' => 3, 'name' => 'Vidrio'],
            ['id' => 4, 'name' => 'Metal (aluminio, hierro)'],
            ['id' => 5, 'name' => 'Orgánico (compostaje)'],
            ['id' => 6, 'name' => 'Electrónicos (opcional)'],
        ]);
    }
}
