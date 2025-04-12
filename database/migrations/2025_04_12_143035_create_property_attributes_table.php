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
            $table->boolean('isActive')->default(true);

            $table->decimal('minimal_value', 19, 0)->nullable(); // para type number
            $table->decimal('maximal_value', 19, 0)->nullable();

            $table->integer('min_char')->nullable(); // para type text
            $table->integer('max_char')->nullable();

            $table->json('options')->nullable(); // para type select

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_attributes');
    }
};
