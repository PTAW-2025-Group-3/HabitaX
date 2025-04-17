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
            // title max 255 chars
            $table->string('title', 255);
            $table->text('description');
            $table->enum('transaction_type', ['sale', 'rent']);
            $table->float('price');
            $table->enum('state', ['pending', 'active', 'archived'])->default('pending');

            $table->foreignId('property_id')->constrained('properties')->onDelete('cascade');
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
        Schema::dropIfExists('advertisements');
    }
};
