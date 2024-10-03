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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('designation_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->string('emp_id')->nullable();
            $table->integer('job_type')->nullable()->comment('1 for Job, 2 for Internship');
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->bigInteger('mobile_no')->nullable();
            $table->string('personal_email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->integer('gender')->nullable();
            $table->date('dob')->nullable();
            $table->date('joining_date')->nullable();
            $table->date('releaving_date')->nullable();
            $table->date('probation_end_date')->nullable();
            $table->date('confirmation_date')->nullable();
            $table->string('profile_image')->nullable();
            $table->integer('emp_status')->nullable();
            $table->text('temporary_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->rememberToken();
            $table->integer('status')->default(1)->comment('1 for active, 0 for inactive');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
