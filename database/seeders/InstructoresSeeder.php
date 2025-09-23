<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstructoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('instructores')->insert([
            [
                'nombre' => 'Eduardo',
                'apellido' => 'Quiñones',
            ],
            [
                'nombre' => 'Juan Pablo',
                'apellido' => 'Fuentes',
            ],
        ]);
    }
}