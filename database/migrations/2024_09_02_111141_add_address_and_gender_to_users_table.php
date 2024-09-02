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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('gender')->nullable()->after('password')->comment('1 for Male, 2 for Female');
            $table->text('temporary_address')->nullable()->after('profile_image');
            $table->text('permanent_address')->nullable()->after('temporary_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('gender');
            $table->dropColumn('temporary_address');
            $table->dropColumn('permanent_address');
        });
    }
};
