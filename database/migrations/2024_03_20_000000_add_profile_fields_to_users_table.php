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
            $table->text('bio')->nullable();
            $table->boolean('email_notifications')->default(true);
            $table->boolean('message_notifications')->default(true);
            $table->boolean('public_profile')->default(true);
            $table->boolean('show_email')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'bio',
                'email_notifications',
                'message_notifications',
                'public_profile',
                'show_email',
            ]);
        });
    }
}; 