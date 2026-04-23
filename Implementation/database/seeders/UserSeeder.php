<?php

namespace Database\Seeders;

use App\Models\Entreprise;
use App\Models\Particulier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@kifkif.ma'],
            [
                'nom' => 'Admin',
                'prenom' => 'KifKif',
                'password' => Hash::make('password'),
                'role' => 'administrateur',
                'type' => 'particulier',
            ]
        );
        $admin->assignRole('admin');

        // Create Entreprise User with Entreprise record
        $entreprise = Entreprise::firstOrCreate(
            ['email' => 'entreprise@kifkif.ma'],
            [
                'nom' => 'Tech Solutions SARL',
                'ice' => '00123456789',
                'secteur_activite' => 'Technologie',
                'ville' => 'Casablanca',
                'telephone' => '0522123456',
                'statut_validation' => 'validee',
            ]
        );

        $entrepriseUser = User::firstOrCreate(
            ['email' => 'entreprise@kifkif.ma'],
            [
                'nom' => 'Responsable',
                'prenom' => 'Tech',
                'password' => Hash::make('password'),
                'role' => 'responsable_tpm',
                'type' => 'entreprise',
                'entreprise_id' => $entreprise->id,
            ]
        );
        $entrepriseUser->assignRole('entreprise');

        // Create Particulier User
        $particulierModel = Particulier::firstOrCreate(
            ['email' => 'particulier@kifkif.ma'],
            [
                'nom' => 'Ahmed',
                'prenom' => 'Benali',
                'ville' => 'Casablanca',
                'telephone' => '0522345678',
                'email' => 'particulier@kifkif.ma',
            ]
        );

        $particulierUser = User::updateOrCreate(
            ['email' => 'particulier@kifkif.ma'],
            [
                'nom' => 'Ahmed',
                'prenom' => 'Benali',
                'password' => Hash::make('password'),
                'role' => 'responsable_tpm',
                'type' => 'particulier',
                'particulier_id' => $particulierModel->id,
            ]
        );
        $particulierUser->assignRole('particulier');

        $this->command->info('Test users created successfully!');
        $this->command->info('====================================');
        $this->command->info('ADMIN: admin@kifkif.ma / password');
        $this->command->info('ENTREPRISE: entreprise@kifkif.ma / password');
        $this->command->info('PARTICULIER: particulier@kifkif.ma / password');
        $this->command->info('====================================');
    }
}
