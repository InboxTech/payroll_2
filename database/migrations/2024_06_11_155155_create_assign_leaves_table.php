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
        Schema::create('assign_leaves', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('leave_id');
            $table->decimal('assign_leave', 8, 2);
            $table->decimal('leave_balance', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_leaves');
    }
};
