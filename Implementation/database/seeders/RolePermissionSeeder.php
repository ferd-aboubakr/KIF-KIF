<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Entreprise permissions
            'create_resource',
            'edit_resource',
            'delete_resource',
            'view_own_resources',
            
            // Admin permissions
            'validate_enterprise',
            'reject_enterprise',
            'moderate_resources',
            'view_all_statistics',
            'manage_categories',
            
            // Particulier permissions
            'contact_seller',
            'view_contact_info',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo([
            'validate_enterprise',
            'reject_enterprise',
            'moderate_resources',
            'view_all_statistics',
            'manage_categories',
        ]);

        $entrepriseRole = Role::firstOrCreate(['name' => 'entreprise']);
        $entrepriseRole->givePermissionTo([
            'create_resource',
            'edit_resource',
            'delete_resource',
            'view_own_resources',
        ]);

        $particulierRole = Role::firstOrCreate(['name' => 'particulier']);
        $particulierRole->givePermissionTo([
            'contact_seller',
            'view_contact_info',
        ]);
    }
}
