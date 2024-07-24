<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bank_name',
        'bank_branch_name',
        'account_number',
        'ifsc_code',
        'gross_salary_yearly',
        'gross_salary_monthly',
        'basic_yearly',
        'basic_monthly',
        'hra_yearly',
        'hra_monthly',
        'medical_yearly',
        'medical_monthly',
        'education_yearly',
        'education_monthly',
        'conveyance_yearly',
        'conveyance_monthly',
        'special_allowance_yearly',
        'special_allowance_monthly',
        'employee_contribution_yearly',
        'employee_contribution_monthly',
        'esi_employee_contribution_yearly',
        'esi_employee_contribution_monthly',
        'labour_welfare_employee_yearly',
        'labour_welfare_employee_monthly',
        'professional_yearly',
        'professional_monthly',
        'employer_contribution_yearly',
        'employer_contribution_monthly',
        'esi_employer_contribution_yearly',
        'esi_employer_contribution_monthly',
        'labour_welfare_employer_yearly',
        'labour_welfare_employer_monthly',
    ];
}
