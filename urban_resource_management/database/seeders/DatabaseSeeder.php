<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            StatusSeeder::class,
            UserSeeder::class,
            WasteTypeSeeder::class,
            TruckStatusSeeder::class,
            ZoneTypeSeeder::class,
            CollectionStatusSeeder::class,
            MaterialTypeSeeder::class,
            ComplaintStatusSeeder::class,
            ZoneSeeder::class,
            ComplaintSeeder::class,
            GreenPointSeeder::class,
            RouteSeeder::class,
            TruckSeeder::class,
        ]);
    }
}
