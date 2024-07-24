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
        Schema::create('punch_in_outs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->Date('date');
            $table->integer('punch_in')->nullable();
            $table->string('punch_in_lat')->nullable();
            $table->string('punch_in_long')->nullable();
            $table->integer('punch_out')->nullable();
            $table->string('punch_out_lat')->nullable();
            $table->string('punch_out_long')->nullable();
            $table->integer('punch_in_out_status')->comment('1 for Punch In, 0 for Punch Out');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('punch_in_outs');
    }
};
