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
            $table->boolean('is_published')->default(false);
            $table->boolean('is_suspended')->default(false);

            $table->foreignId('property_id')->constrained('properties')->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });

        Schema::create('favorite_advertisements', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('advertisement_id')->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisements');
        Schema::dropIfExists('favorite_advertisements');
    }
};
