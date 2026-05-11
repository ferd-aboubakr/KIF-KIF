<?php

namespace Database\Seeders;

use App\Models\Categorie;
use App\Models\Entreprise;
use App\Models\Ressource;
use Illuminate\Database\Seeder;

class RessourceSeeder extends Seeder
{
    public function run(): void
    {
        $entreprise = Entreprise::first();
        $categories = Categorie::all();

        if (!$entreprise) {
            $this->command->warn('No entreprise found. Please seed entreprise first.');
            return;
        }

        if ($categories->isEmpty()) {
            $this->command->warn('No categories found. Please seed categories first.');
            return;
        }

        // Update existing resources with valid categorie_id
        Ressource::all()->each(function ($resource) use ($categories) {
            if (empty($resource->categorie_id)) {
                $resource->categorie_id = $categories->random()->id;
                $resource->save();
            }
        });

        // Create additional sample resources if needed
        $sampleResources = [
            [
                'titre' => 'Sable de construction',
                'description' => 'Sable de haute qualité pour construction, livré en camion.',
                'type_ressource' => 'matiere_premiere',
                'quantite' => 5000,
                'unite' => 'kg',
                'etat' => 'neuf',
                'prix_unitaire' => 150,
                'localisation' => 'Casablanca',
                'statut' => 'active',
            ],
            [
                'titre' => 'Ciment Portland',
                'description' => 'Ciment Portland de qualité supérieure pour travaux de maçonnerie.',
                'type_ressource' => 'matiere_premiere',
                'quantite' => 1000,
                'unite' => 'sac',
                'etat' => 'neuf',
                'prix_unitaire' => 85,
                'localisation' => 'Rabat',
                'statut' => 'active',
            ],
            [
                'titre' => 'Bétonnière électrique',
                'description' => 'Bétonnière professionnelle 150L, état excellent.',
                'type_ressource' => 'machine',
                'quantite' => 2,
                'unite' => 'unité',
                'etat' => 'bon',
                'prix_unitaire' => 2500,
                'localisation' => 'Marrakech',
                'statut' => 'active',
            ],
        ];

        foreach ($sampleResources as $data) {
            Ressource::firstOrCreate(
                ['titre' => $data['titre']],
                array_merge($data, [
                    'entreprise_id' => $entreprise->id,
                    'categorie_id' => $categories->random()->id,
                ])
            );
        }

        $this->command->info('Resources seeded successfully.');
    }
}
