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
        Schema::create('property_type_attributes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('property_type')->constrained('property_types')->onDelete('cascade');
            $table->foreignId('attribute_id')->constrained('property_attributes')->onDelete('cascade');
            $table->boolean('required')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_type_attributes');
    }
};
