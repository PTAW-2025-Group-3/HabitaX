<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First add the new column
        Schema::table('users', function (Blueprint $table) {
            $table->string('status')->default('active')->after('is_suspended');
        });

        // Now update records (only after the column exists)
        DB::statement("UPDATE users SET status = 'suspended' WHERE is_suspended = true");

        // Finally remove the old column
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_suspended');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // First, add back the original column
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_suspended')->default(false)->after('status');
        });

        // Update records
        DB::statement("UPDATE users SET is_suspended = true WHERE status = 'suspended' OR status = 'banned'");

        // Remove the status column
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
