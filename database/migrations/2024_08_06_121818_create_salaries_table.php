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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('month_year', 20)->nullable();
            $table->decimal('present_days')->nullable();
            $table->integer('total_week_off')->nullable();
            $table->integer('paid_holiday')->nullable();
            $table->decimal('number_of_paid_leaves')->nullable();
            $table->decimal('absent_days')->nullable();
            $table->integer('total_days')->nullable();
            $table->decimal('number_of_days_work')->nullable();
            $table->decimal('per_day_salary')->nullable();
            $table->string('overtime_work_hr', 10)->nullable();
            $table->decimal('ot_per_hr_rs')->nullable();
            $table->decimal('basic')->nullable();
            $table->decimal('hra')->nullable();
            $table->decimal('medical')->nullable();
            $table->decimal('education')->nullable();
            $table->decimal('conveyance')->nullable();
            $table->decimal('special_allowance')->nullable();
            $table->decimal('gross_salary_A')->nullable();
            $table->string('is_pf_deduct', 10)->nullable();
            $table->decimal('employee_contribution')->nullable();
            $table->decimal('esi_employee_contribution')->nullable();
            $table->decimal('labour_welfare_employee')->nullable();
            $table->decimal('professional_tax')->nullable();
            $table->decimal('employee_contri_B')->nullable();
            $table->decimal('net_salary_C')->nullable();
            $table->decimal('employer_contribution')->nullable();
            $table->decimal('esi_employer_contribution')->nullable();
            $table->decimal('labour_welfare_employer')->nullable();
            $table->decimal('employee_contri_D')->nullable();
            $table->decimal('ctc_BCD')->nullable();
            $table->decimal('final_amount')->nullable();
            $table->integer('payment_mode')->nullable();
            $table->text('remark')->nullable();
            $table->integer('is_salary_slip_generate')->default(0)->comment('1 for Yes, 0 for No');
            $table->string('salary_slip_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
