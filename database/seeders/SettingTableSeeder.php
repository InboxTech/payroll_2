<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            [
                'master_key' => 'config',
                'config_key' => 'config_company_name'
            ],
            [
                'master_key' => 'config',
                'config_key' => 'config_company_email'
            ],
            [
                'master_key' => 'config',
                'config_key' => 'config_company_mobile_no'
            ],
            [
                'master_key' => 'config',
                'config_key' => 'config_company_address'
            ],
            [
                'master_key' => 'config',
                'config_key' => 'config_company_logo'
            ],
            [
                'master_key' => 'config',
                'config_key' => 'config_fav_icon'
            ],
        ]);
    }
}
