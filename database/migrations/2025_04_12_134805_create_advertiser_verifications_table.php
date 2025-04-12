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
        Schema::create('advertiser_verifications', function (Blueprint $table) {
            $table->id();

            $table->unsignedTinyInteger('verification_annunciant_state')->default(0); // exemplo: 0=pending, 1=approved, 2=rejected

            $table->timestamp('submissionDate')->nullable();
            $table->timestamp('validationDate')->nullable();

            $table->string('document_url')->nullable();
            $table->string('photo_url')->nullable();

            $table->foreignId('validatedBy')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('submittedBy')->constrained('users')->onDelete('cascade');

            $table->timestamp('submittedAt')->nullable();
            $table->timestamp('validatedAt')->nullable();

            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertiser_verifications');
    }
};
