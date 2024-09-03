<?php

namespace App\Imports;

use App\Models\User;
use App\Models\UserDetail;
use App\Models\SalaryHistory;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Carbon;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $userData = User::where('emp_id', $row['employee_id'])->whereOr('email', '%'.$row['email_official'].'%')->whereOr('personal_email', '%'.$row['email_personal'].'%')->first();
        $roleData = Role::where('id', $row['role_please_put_sr_no_from_role'])->first();
        
        if($userData)
        {
            $userDetail = UserDetail::updateOrCreate(
                ['user_id' => $userData->id],
                [
                    'bank_name' => $row['bank_name'],
                    'bank_branch_name' => $row['bank_branch_name'],
                    'account_number' => $row['account_number'],
                    'ifsc_code' => $row['ifsc_code'],
                    'uan_number' => $row['uan_number'],
                    'gross_salary_yearly' => $row['gross_salaray_yearly'],
                    'gross_salary_monthly' => $row['gross_salaray_monthly'],
                    'basic_yearly' => $row['basic_yearly'],
                    'basic_monthly' => $row['basic_monthly'],
                    'hra_yearly' => $row['hra_yearly'],
                    'hra_monthly' => $row['hra_monthly'],
                    'medical_yearly' => $row['medical_yearly'],
                    'medical_monthly' => $row['medical_monthly'],
                    'education_yearly' => $row['education_yearly'],
                    'education_monthly' => $row['education_monthly'],
                    'conveyance_yearly' => $row['conveyance_yearly'],
                    'conveyance_monthly' => $row['conveyance_monthly'],
                    'special_allowance_yearly' => $row['special_allowance_yearly'],
                    'special_allowance_monthly' => $row['special_allowance_mothly'],
                    'gross_salary_A_yearly' => $row['gross_salary_a_yearly'],
                    'gross_salary_A_monthly' => $row['gross_salary_a_monthly'],
                    'is_pf_deduct_yearly' => $row['do_you_want_deduct_pf_yes_no_fix_yearly'],
                    'is_pf_deduct_monthly' => $row['do_you_want_deduct_pf_yes_no_fix_monthly'],
                    'employee_contribution_yearly' => $row['employee_contribution_12_of_basic_yearly'],
                    'employee_contribution_monthly' => $row['employee_contribution_12_of_basic_monthly'],
                    'esi_employee_contribution_yearly' => $row['esi_employee_contribution_025_yearly'],
                    'esi_employee_contribution_monthly' => $row['esi_employee_contribution_025_monthly'],
                    'labour_welfare_employee_yearly' => $row['labour_welfare_fund_gujarat_employee_contribution_yearly'],
                    'labour_welfare_employee_monthly' => $row['labour_welfare_fund_gujarat_employee_contribution_monthly'],
                    'professional_tax_yearly' => $row['professional_tax_yearly'],
                    'professional_tax_monthly' => $row['professional_tax_monthly'],
                    'employee_contribution_B_yearly' => $row['employee_contribution_b_yearly'],
                    'employee_contribution_B_monthly' => $row['employee_contribution_b_monthly'],
                    'net_salary_C_yearly' => $row['net_salary_c_yearly'],
                    'net_salary_C_monthly' => $row['net_salary_c_monthly'],
                    'employer_contribution_yearly' => $row['pf_employers_controbution_12_of_basic_yearly'],
                    'employer_contribution_monthly' => $row['pf_employers_controbution_12_of_basic_monthly'],
                    'esi_employer_contribution_yearly' => $row['esi_employer_contribution_yearly'],
                    'esi_employer_contribution_monthly' => $row['esi_employer_contribution_monthly'],
                    'labour_welfare_employer_yearly' => $row['labour_welfare_fund_gujarat_employer_contribution_yearly'],
                    'labour_welfare_employer_monthly' => $row['labour_welfare_fund_gujarat_employer_contribution_monthly'],
                    'employer_contri_D_yearly' => $row['employer_contribution_d_yearly'],
                    'employer_contri_D_monthly' => $row['employer_contribution_d_monthly'],
                    'ctc_bcd_yearly' => $row['ctc_bcd_yearly'],
                    'ctc_bcd_monthly' => $row['ctc_bcd_monthly'],
                ]
            );

            SalaryHistory::updateOrCreate(
                ['user_id' => $userData->id, 'year' => Carbon::now()->year, 'job_type' => $row['job_type_1_for_job_2_for_intenship']],
                [
                    'gross_salary_yearly' => $row['gross_salaray_yearly'],
                    'gross_salary_monthly' => $row['gross_salaray_monthly'],
                    'basic_yearly' => $row['basic_yearly'],
                    'basic_monthly' => $row['basic_monthly'],
                    'hra_yearly' => $row['hra_yearly'],
                    'hra_monthly' => $row['hra_monthly'],
                    'medical_yearly' => $row['medical_yearly'],
                    'medical_monthly' => $row['medical_monthly'],
                    'education_yearly' => $row['education_yearly'],
                    'education_monthly' => $row['education_monthly'],
                    'conveyance_yearly' => $row['conveyance_yearly'],
                    'conveyance_monthly' => $row['conveyance_monthly'],
                    'special_allowance_yearly' => $row['special_allowance_yearly'],
                    'special_allowance_monthly' => $row['special_allowance_mothly'],
                    'gross_salary_A_yearly' => $row['gross_salary_a_yearly'],
                    'gross_salary_A_monthly' => $row['gross_salary_a_monthly'],
                    'is_pf_deduct_yearly' => $row['do_you_want_deduct_pf_yes_no_fix_yearly'],
                    'is_pf_deduct_monthly' => $row['do_you_want_deduct_pf_yes_no_fix_monthly'],
                    'employee_contribution_yearly' => $row['employee_contribution_12_of_basic_yearly'],
                    'employee_contribution_monthly' => $row['employee_contribution_12_of_basic_monthly'],
                    'esi_employee_contribution_yearly' => $row['esi_employee_contribution_025_yearly'],
                    'esi_employee_contribution_monthly' => $row['esi_employee_contribution_025_monthly'],
                    'labour_welfare_employee_yearly' => $row['labour_welfare_fund_gujarat_employee_contribution_yearly'],
                    'labour_welfare_employee_monthly' => $row['labour_welfare_fund_gujarat_employee_contribution_monthly'],
                    'professional_tax_yearly' => $row['professional_tax_yearly'],
                    'professional_tax_monthly' => $row['professional_tax_monthly'],
                    'employee_contribution_B_yearly' => $row['employee_contribution_b_yearly'],
                    'employee_contribution_B_monthly' => $row['employee_contribution_b_monthly'],
                    'net_salary_C_yearly' => $row['net_salary_c_yearly'],
                    'net_salary_C_monthly' => $row['net_salary_c_monthly'],
                    'employer_contribution_yearly' => $row['pf_employers_controbution_12_of_basic_yearly'],
                    'employer_contribution_monthly' => $row['pf_employers_controbution_12_of_basic_monthly'],
                    'esi_employer_contribution_yearly' => $row['esi_employer_contribution_yearly'],
                    'esi_employer_contribution_monthly' => $row['esi_employer_contribution_monthly'],
                    'labour_welfare_employer_yearly' => $row['labour_welfare_fund_gujarat_employer_contribution_yearly'],
                    'labour_welfare_employer_monthly' => $row['labour_welfare_fund_gujarat_employer_contribution_monthly'],
                    'employer_contri_D_yearly' => $row['employer_contribution_d_yearly'],
                    'employer_contri_D_monthly' => $row['employer_contribution_d_monthly'],
                    'ctc_bcd_yearly' => $row['ctc_bcd_yearly'],
                    'ctc_bcd_monthly' => $row['ctc_bcd_monthly'],
                ]
            );
        }
        else
        {
            $user = new User;

            $user->designation_id = $row['designation_please_put_sr_no_from_master_designation'];
            $user->department_id = $row['department_please_put_sr_no_from_master_department'];
            $user->emp_id = $row['employee_id'];
            $user->job_type = $row['job_type_1_for_job_2_for_intenship'];
            $user->first_name = $row['first_name'];
            $user->middle_name = $row['middle_name'];
            $user->last_name = $row['last_name'];
            $user->email = $row['email_official'];
            $user->mobile_no = $row['mobile_number'];
            $user->personal_email = $row['email_personal'];
            $user->password = Hash::make($row['login_password']);
            $user->gender = $row['gender_1_for_male_2_for_female'];
            $user->dob = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_of_birth_yyyy_mm_dd']);
            $user->joining_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['joining_date_yyyy_mm_dd']);
            $user->probation_end_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['probation_end_date_or_internship_end_date_yyyy_mm_dd']);
            $user->temporary_address = $row['temporary_address'];
            $user->permanent_address = $row['permanent_address'];
            $user->status = $row['status_1_for_active_0_for_inactive'];

            $user->save();
            $user->assignRole($roleData->name);

            $userDetail = UserDetail::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'bank_name' => $row['bank_name'],
                    'bank_branch_name' => $row['bank_branch_name'],
                    'account_number' => $row['account_number'],
                    'ifsc_code' => $row['ifsc_code'],
                    'uan_number' => $row['uan_number'],
                    'gross_salary_yearly' => $row['gross_salaray_yearly'],
                    'gross_salary_monthly' => $row['gross_salaray_monthly'],
                    'basic_yearly' => $row['basic_yearly'],
                    'basic_monthly' => $row['basic_monthly'],
                    'hra_yearly' => $row['hra_yearly'],
                    'hra_monthly' => $row['hra_monthly'],
                    'medical_yearly' => $row['medical_yearly'],
                    'medical_monthly' => $row['medical_monthly'],
                    'education_yearly' => $row['education_yearly'],
                    'education_monthly' => $row['education_monthly'],
                    'conveyance_yearly' => $row['conveyance_yearly'],
                    'conveyance_monthly' => $row['conveyance_monthly'],
                    'special_allowance_yearly' => $row['special_allowance_yearly'],
                    'special_allowance_monthly' => $row['special_allowance_mothly'],
                    'gross_salary_A_yearly' => $row['gross_salary_a_yearly'],
                    'gross_salary_A_monthly' => $row['gross_salary_a_monthly'],
                    'is_pf_deduct_yearly' => $row['do_you_want_deduct_pf_yes_no_fix_yearly'],
                    'is_pf_deduct_monthly' => $row['do_you_want_deduct_pf_yes_no_fix_monthly'],
                    'employee_contribution_yearly' => $row['employee_contribution_12_of_basic_yearly'],
                    'employee_contribution_monthly' => $row['employee_contribution_12_of_basic_monthly'],
                    'esi_employee_contribution_yearly' => $row['esi_employee_contribution_025_yearly'],
                    'esi_employee_contribution_monthly' => $row['esi_employee_contribution_025_monthly'],
                    'labour_welfare_employee_yearly' => $row['labour_welfare_fund_gujarat_employee_contribution_yearly'],
                    'labour_welfare_employee_monthly' => $row['labour_welfare_fund_gujarat_employee_contribution_monthly'],
                    'professional_tax_yearly' => $row['professional_tax_yearly'],
                    'professional_tax_monthly' => $row['professional_tax_monthly'],
                    'employee_contribution_B_yearly' => $row['employee_contribution_b_yearly'],
                    'employee_contribution_B_monthly' => $row['employee_contribution_b_monthly'],
                    'net_salary_C_yearly' => $row['net_salary_c_yearly'],
                    'net_salary_C_monthly' => $row['net_salary_c_monthly'],
                    'employer_contribution_yearly' => $row['pf_employers_controbution_12_of_basic_yearly'],
                    'employer_contribution_monthly' => $row['pf_employers_controbution_12_of_basic_monthly'],
                    'esi_employer_contribution_yearly' => $row['esi_employer_contribution_yearly'],
                    'esi_employer_contribution_monthly' => $row['esi_employer_contribution_monthly'],
                    'labour_welfare_employer_yearly' => $row['labour_welfare_fund_gujarat_employer_contribution_yearly'],
                    'labour_welfare_employer_monthly' => $row['labour_welfare_fund_gujarat_employer_contribution_monthly'],
                    'employer_contri_D_yearly' => $row['employer_contribution_d_yearly'],
                    'employer_contri_D_monthly' => $row['employer_contribution_d_monthly'],
                    'ctc_bcd_yearly' => $row['ctc_bcd_yearly'],
                    'ctc_bcd_monthly' => $row['ctc_bcd_monthly'],
                ]
            );

            SalaryHistory::updateOrCreate(
                ['user_id' => $user->id, 'year' => Carbon::now()->year, 'job_type' => $row['job_type_1_for_job_2_for_intenship']],
                [
                    'gross_salary_yearly' => $row['gross_salaray_yearly'],
                    'gross_salary_monthly' => $row['gross_salaray_monthly'],
                    'basic_yearly' => $row['basic_yearly'],
                    'basic_monthly' => $row['basic_monthly'],
                    'hra_yearly' => $row['hra_yearly'],
                    'hra_monthly' => $row['hra_monthly'],
                    'medical_yearly' => $row['medical_yearly'],
                    'medical_monthly' => $row['medical_monthly'],
                    'education_yearly' => $row['education_yearly'],
                    'education_monthly' => $row['education_monthly'],
                    'conveyance_yearly' => $row['conveyance_yearly'],
                    'conveyance_monthly' => $row['conveyance_monthly'],
                    'special_allowance_yearly' => $row['special_allowance_yearly'],
                    'special_allowance_monthly' => $row['special_allowance_mothly'],
                    'gross_salary_A_yearly' => $row['gross_salary_a_yearly'],
                    'gross_salary_A_monthly' => $row['gross_salary_a_monthly'],
                    'is_pf_deduct_yearly' => $row['do_you_want_deduct_pf_yes_no_fix_yearly'],
                    'is_pf_deduct_monthly' => $row['do_you_want_deduct_pf_yes_no_fix_monthly'],
                    'employee_contribution_yearly' => $row['employee_contribution_12_of_basic_yearly'],
                    'employee_contribution_monthly' => $row['employee_contribution_12_of_basic_monthly'],
                    'esi_employee_contribution_yearly' => $row['esi_employee_contribution_025_yearly'],
                    'esi_employee_contribution_monthly' => $row['esi_employee_contribution_025_monthly'],
                    'labour_welfare_employee_yearly' => $row['labour_welfare_fund_gujarat_employee_contribution_yearly'],
                    'labour_welfare_employee_monthly' => $row['labour_welfare_fund_gujarat_employee_contribution_monthly'],
                    'professional_tax_yearly' => $row['professional_tax_yearly'],
                    'professional_tax_monthly' => $row['professional_tax_monthly'],
                    'employee_contribution_B_yearly' => $row['employee_contribution_b_yearly'],
                    'employee_contribution_B_monthly' => $row['employee_contribution_b_monthly'],
                    'net_salary_C_yearly' => $row['net_salary_c_yearly'],
                    'net_salary_C_monthly' => $row['net_salary_c_monthly'],
                    'employer_contribution_yearly' => $row['pf_employers_controbution_12_of_basic_yearly'],
                    'employer_contribution_monthly' => $row['pf_employers_controbution_12_of_basic_monthly'],
                    'esi_employer_contribution_yearly' => $row['esi_employer_contribution_yearly'],
                    'esi_employer_contribution_monthly' => $row['esi_employer_contribution_monthly'],
                    'labour_welfare_employer_yearly' => $row['labour_welfare_fund_gujarat_employer_contribution_yearly'],
                    'labour_welfare_employer_monthly' => $row['labour_welfare_fund_gujarat_employer_contribution_monthly'],
                    'employer_contri_D_yearly' => $row['employer_contribution_d_yearly'],
                    'employer_contri_D_monthly' => $row['employer_contribution_d_monthly'],
                    'ctc_bcd_yearly' => $row['ctc_bcd_yearly'],
                    'ctc_bcd_monthly' => $row['ctc_bcd_monthly'],
                ]
            );
        }
    }
}
