<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bank_name',
        'bank_branch_name',
        'ac_no',
        'ifsc_code',
        'uan_number',
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
        'gross_salary_A_yearly',
        'gross_salary_A_monthly',
        'is_pf_deduct_yearly',
        'is_pf_deduct_monthly',
        'employee_contribution_yearly',
        'employee_contribution_monthly',
        'esi_employee_contribution_yearly',
        'esi_employee_contribution_monthly',
        'labour_welfare_employee_yearly',
        'labour_welfare_employee_monthly',
        'professional_tax_yearly',
        'professional_tax_monthly',
        'employee_contribution_B_yearly',
        'employee_contribution_B_monthly',
        'net_salary_C_yearly',
        'net_salary_C_monthly',
        'employer_contribution_yearly',
        'employer_contribution_monthly',
        'esi_employer_contribution_yearly',
        'esi_employer_contribution_monthly',
        'labour_welfare_employer_yearly',
        'labour_welfare_employer_monthly',
        'employer_contri_D_yearly',
        'employer_contri_D_monthly',
        'ctc_bcd_yearly',
        'ctc_bcd_monthly',
    ];
    
    public function setBankNameAttribute($value)
    {
        $this->attributes['bank_name'] = Crypt::encrypt($value);
    }
    
    public function setBankBranchNameAttribute($value)
    {
        $this->attributes['bank_branch_name'] = Crypt::encrypt($value);
    }

    public function setAcNoAttribute($value)
    {
        $this->attributes['ac_no'] = Crypt::encrypt($value);
    }
    
    public function setIfscCodeAttribute($value)
    {
        $this->attributes['ifsc_code'] = Crypt::encrypt($value);
    }
    
    public function getBankNameAttribute($value)
    {
        return Crypt::decrypt($value);
    }
    
    public function getBankBranchNameAttribute($value)
    {
        return Crypt::decrypt($value);
    }

    public function getAcNoAttribute($value)
    {
        return Crypt::decrypt($value);
    }
    
    public function getIfscCodeAttribute($value)
    {
        return Crypt::decrypt($value);
    }
}
