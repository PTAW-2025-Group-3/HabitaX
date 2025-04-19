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
        Schema::create('property_attributes', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->enum('type', ['text', 'number', 'boolean', 'select']);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_required')->default(false);
            $table->decimal('minimal', 19, 0)->nullable();
            $table->decimal('maximal', 19, 0)->nullable();
            $table->string('unit')->nullable();

            $table->timestamps();
        });

        Schema::create('property_attribute_options', function (Blueprint $table) {
            $table->id();

            $table->foreignId('property_attribute_id')->constrained('property_attributes')->cascadeOnDelete();
            $table->string('name');
            $table->integer('order')->default(0);
            $table->string('icon_url')->nullable();

            $table->timestamps();
        });

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
        Schema::dropIfExists('property_attributes');
        Schema::dropIfExists('property_attribute_options');
        Schema::dropIfExists('property_type_attributes');
    }
};
