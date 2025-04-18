<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['nom' => 'Roman', 'description' => 'Oeuvres de fiction narrative'],
            ['nom' => 'Science-Fiction', 'description' => 'Fiction spéculative'],
            ['nom' => 'Histoire', 'description' => 'Ouvrages historiques'],
            ['nom' => 'Biographie', 'description' => 'Récits de vie'],
            ['nom' => 'Poésie', 'description' => 'Oeuvres poétiques'],
        ];

        DB::table('categories')->insert($categories);
    }
}