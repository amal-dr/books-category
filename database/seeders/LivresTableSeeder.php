<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LivresTableSeeder extends Seeder
{
    public function run()
    {
        $livres = [
            [
                'titre' => 'Le Petit Prince',
                'pages' => 96,
                'description' => 'Conte philosophique',
                'image' => 'petit-prince.jpg',
                'categorie_id' => 1, // Roman
            ],
            [
                'titre' => 'Dune',
                'pages' => 412,
                'description' => 'Épopée science-fiction',
                'image' => 'dune.jpg',
                'categorie_id' => 2, // Science-Fiction
            ],
            [
                'titre' => 'Les Misérables',
                'pages' => 1463,
                'description' => 'Roman historique',
                'image' => 'miserables.jpg',
                'categorie_id' => 1, // Roman
            ],
            [
                'titre' => 'Une brève histoire du temps',
                'pages' => 256,
                'description' => 'Cosmologie pour le grand public',
                'image' => 'histoire-temps.jpg',
                'categorie_id' => 3, // Histoire
            ],
        ];

        DB::table('livres')->insert($livres);
    }
}