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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_branch_name', 150)->nullable();
            $table->string('account_number', 150)->nullable();
            $table->string('ifsc_code', 150)->nullable();
            $table->float('gross_salary_yearly', 8, 2)->nullable();
            $table->float('gross_salary_monthly', 8, 2)->nullable();
            $table->float('basic_yearly', 8, 2)->nullable();
            $table->float('basic_monthly', 8, 2)->nullable();
            $table->float('hra_yearly', 8, 2)->nullable();
            $table->float('hra_monthly', 8, 2)->nullable();
            $table->float('medical_yearly', 8, 2)->nullable();
            $table->float('medical_monthly', 8, 2)->nullable();
            $table->float('education_yearly', 8, 2)->nullable();
            $table->float('education_monthly', 8, 2)->nullable();
            $table->float('conveyance_yearly', 8, 2)->nullable();
            $table->float('conveyance_monthly', 8, 2)->nullable();
            $table->float('special_allowance_yearly', 8, 2)->nullable();
            $table->float('special_allowance_monthly', 8, 2)->nullable();
            $table->float('gross_salary_A_yearly', 8, 2)->nullable()->comment('addition basic+hra+medical+education+conveyance+special_allowance');
            $table->float('gross_salary_A_monthly', 8, 2)->nullable()->comment('addition basic+hra+medical+education+conveyance+special_allowance');
            $table->float('employee_contribution_yearly', 8, 2)->nullable()->commet('Employee Contribution 12% of Basic Gross');
            $table->float('employee_contribution_monthly', 8, 2)->nullable()->commet('Employee Contribution 12% of Basic Gross');
            $table->float('esi_employee_contribution_yearly', 8, 2)->nullable();
            $table->float('esi_employee_contribution_monthly', 8, 2)->nullable();
            $table->float('labour_welfare_employee_yearly', 8, 2)->nullable();
            $table->float('labour_welfare_employee_monthly', 8, 2)->nullable();
            $table->float('professional_tax_yearly', 8, 2)->nullable();
            $table->float('professional_tax_monthly', 8, 2)->nullable();
            $table->float('employee_contribution_B_yearly', 8, 2)->nullable()->comment('addition employee_contribution_yearly+labour_welfare_employee_yearly+professional_tax_yearly');
            $table->float('employee_contribution_B_monthly', 8, 2)->nullable()->comment('addition employee_contribution_monthly+labour_welfare_employee_monthly+professional_tax_monthly');
            $table->float('net_salary_yearly', 8, 2)->nullable()->comment('gross_salary_yearly-employee_contribution_B_yearly');
            $table->float('net_salary_monthly', 8, 2)->nullable()->comment('gross_salary_monthly-employee_contribution_B_monthly');
            $table->float('employer_contribution_yearly', 8, 2)->nullable();
            $table->float('employer_contribution_monthly', 8, 2)->nullable();
            $table->float('esi_employer_contribution_yearly', 8, 2)->nullable();
            $table->float('esi_employer_contribution_monthly', 8, 2)->nullable();
            $table->float('labour_welfare_employer_yearly', 8, 2)->nullable();
            $table->float('labour_welfare_employer_monthly', 8, 2)->nullable();
            $table->float('employer_contri_yearly', 8, 2)->nullable();
            $table->float('employer_contri_monthly', 8, 2)->nullable();
            $table->float('ctc_bcd_yearly', 8, 2)->nullable()->comment('');
            $table->float('ctc_bcd_monthly', 8, 2)->nullable()->comment('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
