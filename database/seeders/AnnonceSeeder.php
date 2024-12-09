<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnnonceSeeder extends Seeder


{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("annonces")->insert([
            [
                'titre' => "appart à vendre",
                'description' => "joli appart",
                'type' => 'Appartement',
                'ville' => "fès",
                'superficie' => 100,
                'neuf' => true,
                'prix' => 400000
            ],
            [
                'titre' => "villa à vendre",
                'description' => "joli villa",
                'type' => 'Villa',
                'ville' => "Meknès",
                'superficie' => 220,
                'neuf' => false,
                'prix' => 1200000
            ]
        ]);
    }
}
