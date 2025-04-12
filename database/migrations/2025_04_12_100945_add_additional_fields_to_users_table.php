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
            $table->string('nome')->nullable();
            $table->integer('telephone')->nullable();
            $table->string('profilePhoto_url')->nullable();
            $table->enum('userType', ['user', 'moderator', 'admin'])->nullable();
            $table->integer('advertiserNumber')->nullable();
            $table->integer('staffNumber')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'nome',
                'telephone',
                'profilePhoto_url',
                'userType',
                'advertiserNumber',
                'staffNumber',
            ]);
        });
    }
};
