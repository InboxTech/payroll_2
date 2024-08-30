<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('salary_histories', function (Blueprint $table) {
            $table->id();
            $table->year('year')->nullable();
            $table->integer('job_type')->nullable()->comment('1 for Job, 2 for Internship');
            $table->integer('user_id')->nullable();
            $table->decimal('gross_salary_yearly', 8, 2)->nullable();
            $table->decimal('gross_salary_monthly', 8, 2)->nullable();
            $table->decimal('basic_yearly', 8, 2)->nullable();
            $table->decimal('basic_monthly', 8, 2)->nullable();
            $table->decimal('hra_yearly', 8, 2)->nullable();
            $table->decimal('hra_monthly', 8, 2)->nullable();
            $table->decimal('medical_yearly', 8, 2)->nullable();
            $table->decimal('medical_monthly', 8, 2)->nullable();
            $table->decimal('education_yearly', 8, 2)->nullable();
            $table->decimal('education_monthly', 8, 2)->nullable();
            $table->decimal('conveyance_yearly', 8, 2)->nullable();
            $table->decimal('conveyance_monthly', 8, 2)->nullable();
            $table->decimal('special_allowance_yearly', 8, 2)->nullable();
            $table->decimal('special_allowance_monthly', 8, 2)->nullable();
            $table->decimal('gross_salary_A_yearly', 8, 2)->nullable()->comment('addition basic+hra+medical+education+conveyance+special_allowance');
            $table->decimal('gross_salary_A_monthly', 8, 2)->nullable()->comment('addition basic+hra+medical+education+conveyance+special_allowance');
            $table->string('is_pf_deduct_yearly', 10)->nullable();
            $table->string('is_pf_deduct_monthly', 10)->nullable();
            $table->decimal('employee_contribution_yearly', 8, 2)->nullable()->commet('Employee Contribution 12% of Basic Gross');
            $table->decimal('employee_contribution_monthly', 8, 2)->nullable()->commet('Employee Contribution 12% of Basic Gross');
            $table->decimal('esi_employee_contribution_yearly', 8, 2)->nullable();
            $table->decimal('esi_employee_contribution_monthly', 8, 2)->nullable();
            $table->decimal('labour_welfare_employee_yearly', 8, 2)->nullable();
            $table->decimal('labour_welfare_employee_monthly', 8, 2)->nullable();
            $table->decimal('professional_tax_yearly', 8, 2)->nullable();
            $table->decimal('professional_tax_monthly', 8, 2)->nullable();
            $table->decimal('employee_contribution_B_yearly', 8, 2)->nullable()->comment('addition employee_contribution_yearly+labour_welfare_employee_yearly+professional_tax_yearly');
            $table->decimal('employee_contribution_B_monthly', 8, 2)->nullable()->comment('addition employee_contribution_monthly+labour_welfare_employee_monthly+professional_tax_monthly');
            $table->decimal('net_salary_C_yearly', 8, 2)->nullable()->comment('gross_salary_yearly-employee_contribution_B_yearly');
            $table->decimal('net_salary_C_monthly', 8, 2)->nullable()->comment('gross_salary_monthly-employee_contribution_B_monthly');
            $table->decimal('employer_contribution_yearly', 8, 2)->nullable();
            $table->decimal('employer_contribution_monthly', 8, 2)->nullable();
            $table->decimal('esi_employer_contribution_yearly', 8, 2)->nullable();
            $table->decimal('esi_employer_contribution_monthly', 8, 2)->nullable();
            $table->decimal('labour_welfare_employer_yearly', 8, 2)->nullable();
            $table->decimal('labour_welfare_employer_monthly', 8, 2)->nullable();
            $table->decimal('employer_contri_D_yearly', 8, 2)->nullable();
            $table->decimal('employer_contri_D_monthly', 8, 2)->nullable();
            $table->decimal('ctc_bcd_yearly', 8, 2)->nullable()->comment('addition = employee_contribution_B_yearly + net_salary_C_yearly + employer_contri_D_yearly');
            $table->decimal('ctc_bcd_monthly', 8, 2)->nullable()->comment('addition = employee_contribution_B_monthly + net_salary_C_yearly + employer_contri_D_monthly');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_histories');
    }
};
