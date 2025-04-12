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
        Schema::create('advertisement_collection', function (Blueprint $table) {
            $table->foreignId('collection_id')->constrained('collections')->onDelete('cascade');
            $table->foreignId('advertisement_id')->constrained('advertisements')->onDelete('cascade');
            $table->timestamp('addedAt')->default(now());

            $table->primary(['collection_id', 'advertisement_id']); // evita duplicação
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisement_collections');
    }
};
