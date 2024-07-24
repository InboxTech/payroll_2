<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();

        $user->first_name = 'Admin';
        $user->middle_name = '';
        $user->last_name = 'Admin';
        $user->email = 'admin@example.com';
        $user->password = Hash::make('123456');
        $user->mobile_no = '1234567890';
        $user->status = 1;

        $user->save();

        $role = Role::findByName('Admin');
        if($role)
            $user->assignRole($role);
    }
}
