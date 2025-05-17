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
            $table->string('telephone', 20)->nullable();
            $table->enum('user_type', ['user', 'moderator', 'admin'])->default('user');
            $table->boolean('is_advertiser')->default(false);
            $table->integer('staff_number')->nullable();
            $table->enum('state', ['active', 'suspended', 'banned', 'archived'])->default('active');

            $table->boolean('email_notifications')->default(true);
            $table->boolean('message_notifications')->default(true);
            $table->boolean('public_profile')->default(true);
            $table->boolean('show_email')->default(false);

            $table->integer('nif')->nullable();
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
                'user_type',
                'is_advertiser',
                'staff_number',
                'state',
                'email_notifications',
                'message_notifications',
                'public_profile',
                'show_email',
                'nif',
                'document_number',
                'document_type_id',
            ]);
        });
    }
};
