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
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('reference')->unique();
            $table->text('description');
            $table->enum('transaction_type', ['sale', 'rent']);
            $table->float('price');
            $table->timestamps(); // cria automaticamente created_at e updated_at
            $table->enum('state', ['pending', 'active', 'archived'])->default('pending');

            $table->foreignId('property_id')->constrained('properties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisements');
    }
};
