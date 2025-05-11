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
            $table->integer('telephone')->nullable();
            $table->string('profile_picture_path')->nullable();
            $table->enum('user_type', ['user', 'moderator', 'admin'])->default('user');
            $table->integer('advertiser_number')->nullable();
            $table->integer('staff_number')->nullable();
            $table->enum('state', ['active', 'suspended', 'banned', 'archived'])->default('active');

            $table->boolean('email_notifications')->default(true);
            $table->boolean('message_notifications')->default(true);
            $table->boolean('public_profile')->default(true);
            $table->boolean('show_email')->default(false);

            $table->string('document_number')->nullable();
            $table->foreignId('document_type_id')->nullable()->constrained('document_types')->nullOnDelete();
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
                'telephone',
                'profile_picture_path',
                'user_type',
                'advertiser_number',
                'staff_number',
                'state',
                'email_notifications',
                'message_notifications',
                'public_profile',
                'show_email',
                'document_number',
                'document_type_id',
            ]);
        });
    }
};
