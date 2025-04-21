<?php

use App\Enums\AttributeType;
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
            $table->enum('type', array_map(fn($type) => $type->value, AttributeType::cases()))
                ->default(AttributeType::TEXT->value);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_required')->default(false);
            $table->float('min_value')->nullable();
            $table->float('max_value')->nullable();
            $table->string('unit')->nullable();
            $table->integer('min_length')->nullable();
            $table->integer('max_length')->nullable();
            $table->date('min_date')->nullable();
            $table->date('max_date')->nullable();

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

            $table->foreignId('property_type_id')->constrained('property_types')->cascadeOnDelete();
            $table->foreignId('property_attribute_id')->constrained('property_attributes')->cascadeOnDelete();
            $table->boolean('is_required')->default(false);
            $table->boolean('is_active')->default(true);

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
