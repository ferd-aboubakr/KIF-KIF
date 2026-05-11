<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['nom' => 'Matériaux de construction', 'description' => 'Briques, ciment, sable, gravier, etc.'],
            ['nom' => 'Équipements de chantier', 'description' => 'Engins, outils, machines'],
            ['nom' => 'Matériaux électriques', 'description' => 'Câbles, interrupteurs, luminaires'],
            ['nom' => 'Plomberie', 'description' => 'Tuyaux, robinets, sanitaires'],
            ['nom' => 'Peinture et finition', 'description' => 'Peinture, vernis, enduits'],
            ['nom' => 'Isolation', 'description' => 'Isolation thermique et phonique'],
        ];

        foreach ($categories as $category) {
            Categorie::firstOrCreate(
                ['nom' => $category['nom']],
                ['description' => $category['description']]
            );
        }
    }
}
