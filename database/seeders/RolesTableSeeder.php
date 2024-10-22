<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \App\Models\Department;
use App\Models\Designation;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = new Role();

        $role = [
            [
                'name' => 'Admin',
                'guard_name' => 'web'
            ],
            [
                'name' => 'HR',
                'guard_name' => 'web'
            ],
            [
                'name' => 'Account',
                'guard_name' => 'web'
            ],
            [
                'name' => 'Employee',
                'guard_name' => 'web'
            ],
            [
                'name' => 'Project Manager',
                'guard_name' => 'web'
            ],
        ];

        foreach($role as $role) {
            Role::create($role);
        }

        $department = [
            [
                'name' => 'Development',
                'status' => 1
            ],
            [
                'name' => 'Marketing & Sales',
                'status' => 1
            ],
            [
                'name' => 'Other',
                'status' => 1
            ],
            [
                'name' => 'Management',
                'status' => 1
            ],
        ];

        foreach($department as $dpt) {
            Department::create($dpt);
        }

        $desgination = new Designation();

        $desgination->name = 'Admin';
        $desgination->status = 1;
        $desgination->save();
    }
}
