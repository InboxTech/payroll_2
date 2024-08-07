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
                'name' => 'view-role',
                'group_name' => 'Role'
            ],
            [
                'name' => 'create-role',
                'group_name' => 'Role'
            ],
            [
                'name' => 'edit-role',
                'group_name' => 'Role'
            ],
            [
                'name' => 'delete-role',
                'group_name' => 'Role'
            ],
            [
                'name' => 'view-employee',
                'group_name' => 'Employee'
            ],
            [
                'name' => 'create-employee',
                'group_name' => 'Employee'
            ],
            [
                'name' => 'edit-employee',
                'group_name' => 'Employee'
            ],
            [
                'name' => 'delete-employee',
                'group_name' => 'Employee'
            ],
            [
                'name' => 'view-designation',
                'group_name' => 'Designation'
            ],
            [
                'name' => 'create-designation',
                'group_name' => 'Designation'
            ],
            [
                'name' => 'edit-designation',
                'group_name' => 'Designation'
            ],
            [
                'name' => 'delete-designation',
                'group_name' => 'Designation'
            ],
            [
                'name' => 'view-leave',
                'group_name' => 'Leave'
            ],
            [
                'name' => 'create-leave',
                'group_name' => 'Leave'
            ],
            [
                'name' => 'edit-leave',
                'group_name' => 'Leave'
            ],
            [
                'name' => 'delete-leave',
                'group_name' => 'Leave'
            ],
            [
                'name' => 'view-leave-apply',
                'group_name' => 'LeaveApply'
            ],
            [
                'name' => 'create-leave-apply',
                'group_name' => 'LeaveApply'
            ],
            [
                'name' => 'edit-leave-apply',
                'group_name' => 'LeaveApply'
            ],
            [
                'name' => 'delete-leave-apply',
                'group_name' => 'LeaveApply'
            ],
            [
                'name' => 'view-applied-leave',
                'group_name' => 'AppliedLeave'
            ],
            [
                'name' => 'create-applied-leave',
                'group_name' => 'AppliedLeave'
            ],
            [
                'name' => 'edit-applied-leave',
                'group_name' => 'AppliedLeave'
            ],
            [
                'name' => 'delete-applied-leave',
                'group_name' => 'AppliedLeave'
            ],
            [
                'name' => 'view-attendance-report',
                'group_name' => 'AttendanceReport'
            ],
            [
                'name' => 'create-attendance-report',
                'group_name' => 'AttendanceReport'
            ],
            [
                'name' => 'edit-attendance-report',
                'group_name' => 'AttendanceReport'
            ],
            [
                'name' => 'delete-attendance-report',
                'group_name' => 'AttendanceReport'
            ],
            [
                'name' => 'view-salary',
                'group_name' => 'Salary'
            ],
            [
                'name' => 'create-salary',
                'group_name' => 'Salary'
            ],
            [
                'name' => 'edit-salary',
                'group_name' => 'Salary'
            ],
            [
                'name' => 'delete-salary',
                'group_name' => 'Salary'
            ],
            [
                'name' => 'view-setting',
                'group_name' => 'Setting'
            ],
            [
                'name' => 'edit-setting',
                'group_name' => 'Setting'
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        // Assign permissions to roles
        $role = Role::findByName('Admin');
        $role->givePermissionTo(Permission::all());
    }
}
