<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Root User',
            'username' => 'root',
            'email' => 'root@municipal.local',
            'password' => Hash::make('root123'),
            'role_id' => 1,
            'status_id' => 1,
        ]);
    }
}
