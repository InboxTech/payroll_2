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
        Schema::create('leave_applies', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->integer('leave_id')->nullable();
            $table->integer('leave_mode')->nullable()->comment('1 for Full Day, 2 for Half Day - 1st, 3 for Half Day - 2nd');
            $table->integer('is_leave_cancle')->nullable()->comment('1 for No, 2 for Yes')->default('1');
            $table->text('reason')->nullable();
            $table->integer('is_approved')->nullable()->comment('0 for pending, 1 for Approved, 2 for Rejected')->default('0');
            $table->float('number_of_days', 8, 2)->nullable();
            $table->integer('deleted_by')->nullable()->comment('This is User Id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_applies');
    }
};
