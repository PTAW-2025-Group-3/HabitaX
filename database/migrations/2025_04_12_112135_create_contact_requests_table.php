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
        Schema::create('contact_requests', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email');
            $table->string('telephone');
            $table->text('message');
            $table->enum('state', ['unread', 'read', 'archived',])->default('unread');

            $table->foreignId('advertisement_id')->constrained('advertisements')->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_requests');
    }
};
