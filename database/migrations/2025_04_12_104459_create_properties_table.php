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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('country');
            $table->float('total_area');
            $table->json('images')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_verified')->default(false);

            // Foreign keys
            $table->foreignId('type_property')->constrained('type_properties')->onDelete('cascade');
            $table->foreignId('parish_id')->constrained('parishes')->onDelete('cascade');

            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
