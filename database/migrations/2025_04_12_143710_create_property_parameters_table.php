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

            $table->text('value')->nullable();
            $table->text('text_value')->nullable();
            $table->integer('int_value')->nullable();
            $table->float('float_value')->nullable();
            $table->boolean('boolean_value')->nullable();
            $table->foreignId('select_value')->nullable()->constrained('property_attribute_options')->nullOnDelete();
            $table->date('date_value')->nullable();
            $table->boolean('is_multiple')->default(false);

            $table->timestamps();
        });

        Schema::create('property_parameter_options', function (Blueprint $table) {
            $table->id();

            $table->foreignId('parameter_id')->constrained('property_parameters')->cascadeOnDelete();
            $table->foreignId('option_id')->constrained('property_attribute_options')->cascadeOnDelete();

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
