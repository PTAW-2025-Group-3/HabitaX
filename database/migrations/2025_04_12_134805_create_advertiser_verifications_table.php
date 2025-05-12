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

            $table->unsignedTinyInteger('verification_advertiser_state')->default(0); // exemplo: 0=pending, 1=approved, 2=rejected

            $table->timestamp('submission_date')->nullable();
            $table->timestamp('validation_date')->nullable();

            $table->text('validator_comments')->nullable();

            $table->foreignId('validated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('submitted_by')->constrained('users')->onDelete('cascade');

            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('validated_at')->nullable();

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
