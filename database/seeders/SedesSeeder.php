<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SedesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sedes')->insert([
            [
                'nombre' => 'Ñuñoa',
                'direccion' => 'Av. Irarrázaval 1292, Ñuñoa, Santiago',
            ],
            [
                'nombre' => 'La Reina',
                'direccion' => 'Av. Larraín 10200, La Reina, Santiago',
            ],
            [
                'nombre' => 'Vitacura',
                'direccion' => 'Av. Vitacura 6800, Vitacura, Santiago',
            ],
            [
                'nombre' => 'Providencia',
                'direccion' => 'Av. Nueva Providencia 1336, Providencia, Santiago',
            ],
        ]);
    }
}