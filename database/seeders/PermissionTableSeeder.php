<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate the permissions table
        DB::table('permissions')->truncate();

        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $permissions = [
            [
                'name' => 'View Role',
                'group_name' => 'Role'
            ],
            [
                'name' => 'Create Role',
                'group_name' => 'Role'
            ],
            [
                'name' => 'Edit Role',
                'group_name' => 'Role'
            ],
            [
                'name' => 'Delete Role',
                'group_name' => 'Role'
            ],
            [
                'name' => 'View User',
                'group_name' => 'User'
            ],
            [
                'name' => 'Create User',
                'group_name' => 'User'
            ],
            [
                'name' => 'Edit User',
                'group_name' => 'User'
            ],
            [
                'name' => 'Delete User',
                'group_name' => 'User'
            ]            
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        // Assign permissions to roles
        $role = Role::findByName('Admin');
        $role->givePermissionTo(Permission::all());
    }
}
