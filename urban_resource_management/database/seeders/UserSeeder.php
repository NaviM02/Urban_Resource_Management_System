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

        // add more
        User::insert([

            ['name'=>'Carlos Méndez','username'=>'cmendez','email'=>'cmendez@mail.com','password'=>Hash::make('1234'),'role_id'=>2,'status_id'=>1],
            ['name'=>'Laura Díaz','username'=>'ldiaz','email'=>'ldiaz@mail.com','password'=>Hash::make('1234'),'role_id'=>2,'status_id'=>1],
            ['name'=>'Mario Castillo','username'=>'mcastillo','email'=>'mcastillo@mail.com','password'=>Hash::make('1234'),'role_id'=>2,'status_id'=>1],

            ['name'=>'Pedro Morales','username'=>'pmorales','email'=>'pmorales@mail.com','password'=>Hash::make('1234'),'role_id'=>3,'status_id'=>1],
            ['name'=>'Ana López','username'=>'alopez','email'=>'alopez@mail.com','password'=>Hash::make('1234'),'role_id'=>3,'status_id'=>1],
            ['name'=>'Luis Gómez','username'=>'lgomez','email'=>'lgomez@mail.com','password'=>Hash::make('1234'),'role_id'=>3,'status_id'=>1],
            ['name'=>'Karla Sapon','username'=>'ksapon','email'=>'ksapon@mail.com','password'=>Hash::make('1234'),'role_id'=>3,'status_id'=>1],

            ['name'=>'Andrea Pérez','username'=>'aperez','email'=>'aperez@mail.com','password'=>Hash::make('1234'),'role_id'=>4,'status_id'=>1],
            ['name'=>'José Ramírez','username'=>'jramirez','email'=>'jramirez@mail.com','password'=>Hash::make('1234'),'role_id'=>4,'status_id'=>1],
            ['name'=>'María López','username'=>'mlopez','email'=>'mlopez@mail.com','password'=>Hash::make('1234'),'role_id'=>4,'status_id'=>1],
            ['name'=>'Sofía Hernández','username'=>'shernandez','email'=>'shernandez@mail.com','password'=>Hash::make('1234'),'role_id'=>4,'status_id'=>1],
            ['name'=>'Luis García','username'=>'lgarcia','email'=>'lgarcia@mail.com','password'=>Hash::make('1234'),'role_id'=>4,'status_id'=>1],

            ['name'=>'Diego Morales','username'=>'dmorales','email'=>'dmorales@mail.com','password'=>Hash::make('1234'),'role_id'=>5,'status_id'=>1],
            ['name'=>'Claudia Soto','username'=>'csoto','email'=>'csoto@mail.com','password'=>Hash::make('1234'),'role_id'=>5,'status_id'=>1],
            ['name'=>'Juan de la Cruz','username'=>'jcruz','email'=>'jcruz@mail.com','password'=>Hash::make('1234'),'role_id'=>5,'status_id'=>1]

        ]);
    }
}
