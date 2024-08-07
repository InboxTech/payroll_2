<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'month_year',
        'present_days',
        'total_week_off',
        'paid_holiday',
        'number_of_paid_leaves',
        'absent_days',
        'total_days',
        'number_of_days_work',
        'per_day_salary',
        'overtime_work_hr',
        'ot_per_hr_rs',
        'basic',
        'hra',
        'medical',
        'education',
        'conveyance',
        'special_allowance',
        'gross_salary_A',
        'is_pf_deduct',
        'employee_contribution',
        'esi_employee_contribution',
        'labour_welfare_employee',
        'professional_tax',
        'employee_contri_B',
        'net_salary_C',
        'employer_contribution',
        'esi_employer_contribution',
        'labour_welfare_employer',
        'employee_contri_D',
        'ctc_BCD',
        'final_amount',
        'payment_mode',
        'remark',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
