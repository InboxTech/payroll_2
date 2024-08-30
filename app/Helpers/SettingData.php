<?php
namespace App\Helpers;

class SettingData
{
    public function getFinancialYear()
    {
        $data = \App\Models\Setting::select('config_value')->where('config_key', 'config_start_financial_year')->first();

        return $data;
    }
}