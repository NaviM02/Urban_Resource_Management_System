<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            [
                'id' => 1,
                'name' => 'Administrador Municipal',
                'description' => 'System Super Administrator'
            ],
            [
                'id' => 2,
                'name' => 'Coordinador de Rutas',
                'description' => 'Gestiona rutas, camiones y reportes de estos.'
            ],
            [
                'id' => 3,
                'name' => 'Operador de Punto Verde',
                'description' => 'Gestiona puntos verdes y contenedores.'
            ],
            [
                'id' => 4,
                'name' => 'Ciudadano',
                'description' => 'Consulta horarios, rutas, puntos verdes y puede denunciar.'
            ],
            [
                'id' => 5,
                'name' => 'Auditor',
                'description' => 'Consulta todos los reportes y exportacion de datos.'
            ]
        ]);
    }
}
