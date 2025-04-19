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
        Schema::create('property_parameters', function (Blueprint $table) {
            $table->id();

            $table->foreignId('property_id')->constrained('properties')->onDelete('cascade');
            $table->foreignId('attribute_id')->constrained('property_attributes')->onDelete('cascade');

            $table->text('value'); // Armazena como string; depois fazes cast se necessário

            $table->timestamps();
        });

        Schema::create('property_parameter_options', function (Blueprint $table) {
            $table->id();

            $table->foreignId('property_parameter_id')->constrained('property_parameters')->cascadeOnDelete();
            $table->foreignId('property_attribute_option_id')->constrained('property_attribute_options')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_values');
        Schema::dropIfExists('property_parameter_options');
    }
};
