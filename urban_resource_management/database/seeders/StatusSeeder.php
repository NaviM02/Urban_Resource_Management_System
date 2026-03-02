<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::insert([
            [
                'id' => 1,
                'name' => 'Activo'
            ],
            [
                'id' => 2,
                'name' => 'Inactivo'
            ],
            [
                'id' => 3,
                'name' => 'Eliminado'
            ],
        ]);
    }
}
