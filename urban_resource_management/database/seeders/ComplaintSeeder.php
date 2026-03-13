<?php

namespace Database\Seeders;

use App\Models\Complaint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Complaint::insert([

            [
                'address'=>'Zona 3, Quetzaltenango',
                'lat'=>14.8420,
                'lng'=>-91.5200,
                'description'=>'Basurero clandestino en esquina',
                'dump_size'=>'mediano',
                'citizen_id'=>8,
                'complaint_status_id'=>1,
                'complaint_date'=>'2026-03-01'
            ],

            [
                'address'=>'Colonia Las Flores',
                'lat'=>14.8480,
                'lng'=>-91.5100,
                'description'=>'Acumulación de basura en terreno',
                'dump_size'=>'grande',
                'citizen_id'=>9,
                'complaint_status_id'=>2,
                'complaint_date'=>'2026-03-02'
            ],

            [
                'address'=>'Cerca Parque Minerva',
                'lat'=>14.8470,
                'lng'=>-91.5200,
                'description'=>'Bolsas de basura abandonadas',
                'dump_size'=>'pequeño',
                'citizen_id'=>10,
                'complaint_status_id'=>1,
                'complaint_date'=>'2026-03-03'
            ],

            [
                'address'=>'Colonia La Democracia',
                'lat'=>14.8295,
                'lng'=>-91.5231,
                'description'=>'Desechos acumulados cerca del parque',
                'dump_size'=>'mediano',
                'citizen_id'=>11,
                'complaint_status_id'=>1,
                'complaint_date'=>'2026-03-04'
            ],

            [
                'address'=>'Zona 5',
                'lat'=>14.8440,
                'lng'=>-91.5102,
                'description'=>'Basura tirada en lote baldío',
                'dump_size'=>'mediano',
                'citizen_id'=>12,
                'complaint_status_id'=>2,
                'complaint_date'=>'2026-03-04'
            ],

            [
                'address'=>'Colonia Molina',
                'lat'=>14.8405,
                'lng'=>-91.5178,
                'description'=>'Acumulación de bolsas de basura',
                'dump_size'=>'pequeño',
                'citizen_id'=>8,
                'complaint_status_id'=>1,
                'complaint_date'=>'2026-03-05'
            ],

            [
                'address'=>'Zona 7',
                'lat'=>14.8501,
                'lng'=>-91.5225,
                'description'=>'Desechos domésticos tirados en la calle',
                'dump_size'=>'mediano',
                'citizen_id'=>9,
                'complaint_status_id'=>3,
                'complaint_date'=>'2026-03-05'
            ],

            [
                'address'=>'Colonia El Rosario',
                'lat'=>14.8320,
                'lng'=>-91.5195,
                'description'=>'Basura acumulada cerca del drenaje',
                'dump_size'=>'mediano',
                'citizen_id'=>10,
                'complaint_status_id'=>1,
                'complaint_date'=>'2026-03-06'
            ],

            [
                'address'=>'Zona 2',
                'lat'=>14.8372,
                'lng'=>-91.5144,
                'description'=>'Restos de comida y bolsas en la banqueta',
                'dump_size'=>'pequeño',
                'citizen_id'=>11,
                'complaint_status_id'=>2,
                'complaint_date'=>'2026-03-06'
            ],

            [
                'address'=>'Sector Parque Minerva',
                'lat'=>14.8479,
                'lng'=>-91.5198,
                'description'=>'Basurero clandestino detrás de comercio',
                'dump_size'=>'grande',
                'citizen_id'=>12,
                'complaint_status_id'=>1,
                'complaint_date'=>'2026-03-07'
            ],

            [
                'address'=>'Zona 1',
                'lat'=>14.8355,
                'lng'=>-91.5181,
                'description'=>'Basura acumulada por varios días',
                'dump_size'=>'mediano',
                'citizen_id'=>8,
                'complaint_status_id'=>2,
                'complaint_date'=>'2026-03-07'
            ],

            [
                'address'=>'Colonia Las Rosas',
                'lat'=>14.8461,
                'lng'=>-91.5133,
                'description'=>'Bolsas de basura abiertas por animales',
                'dump_size'=>'pequeño',
                'citizen_id'=>9,
                'complaint_status_id'=>1,
                'complaint_date'=>'2026-03-08'
            ],

            [
                'address'=>'Zona 6',
                'lat'=>14.8429,
                'lng'=>-91.5228,
                'description'=>'Basura acumulada cerca de parada de buses',
                'dump_size'=>'mediano',
                'citizen_id'=>10,
                'complaint_status_id'=>3,
                'complaint_date'=>'2026-03-08'
            ],

            [
                'address'=>'Colonia Santa María',
                'lat'=>14.8334,
                'lng'=>-91.5165,
                'description'=>'Desechos orgánicos en la vía pública',
                'dump_size'=>'pequeño',
                'citizen_id'=>11,
                'complaint_status_id'=>1,
                'complaint_date'=>'2026-03-09'
            ],

            [
                'address'=>'Zona 4',
                'lat'=>14.8390,
                'lng'=>-91.5125,
                'description'=>'Basura tirada en esquina transitada',
                'dump_size'=>'mediano',
                'citizen_id'=>12,
                'complaint_status_id'=>2,
                'complaint_date'=>'2026-03-09'
            ],

            [
                'address'=>'Sector Terminal',
                'lat'=>14.8385,
                'lng'=>-91.5220,
                'description'=>'Acumulación de desechos cerca de mercado',
                'dump_size'=>'grande',
                'citizen_id'=>8,
                'complaint_status_id'=>1,
                'complaint_date'=>'2026-03-10'
            ],

            [
                'address'=>'Zona 8',
                'lat'=>14.8512,
                'lng'=>-91.5187,
                'description'=>'Basura acumulada en terreno abandonado',
                'dump_size'=>'grande',
                'citizen_id'=>9,
                'complaint_status_id'=>1,
                'complaint_date'=>'2026-03-10'
            ],

            [
                'address'=>'Colonia San Antonio',
                'lat'=>14.8457,
                'lng'=>-91.5212,
                'description'=>'Restos de basura y muebles viejos',
                'dump_size'=>'grande',
                'citizen_id'=>10,
                'complaint_status_id'=>2,
                'complaint_date'=>'2026-03-11'
            ]

        ]);
    }
}
