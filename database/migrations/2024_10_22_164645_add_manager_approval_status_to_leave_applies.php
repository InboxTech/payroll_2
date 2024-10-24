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
        Schema::table('leave_applies', function (Blueprint $table) {
            $table->integer('manager_approval_status')->nullable()->comment('0 for pending, 1 for Approved, 2 for Rejected')->after('leave_status_remark');
            $table->text('manager_remark')->nullable()->after('manager_approval_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leave_applies', function (Blueprint $table) {
            $table->dropColumn('manager_approval_status');
            $table->dropColumn('manager_remark');
        });
    }
};
