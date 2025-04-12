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
        Schema::create('property_verifications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('property_id')->constrained('properties')->onDelete('cascade');
            $table->enum('state', ['pending', 'approved', 'rejected'])->default('pending');

            $table->string('documentation')->nullable();
            $table->timestamp('submission_date')->nullable();
            $table->timestamp('validation_date')->nullable();

            $table->foreignId('submitted_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('validated_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_verifications');
    }
};
