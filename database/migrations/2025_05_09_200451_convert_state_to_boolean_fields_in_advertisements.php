<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('advertisements', function (Blueprint $table) {
            // Adicionar novos campos
            $table->boolean('is_published')->default(false);
            $table->boolean('is_suspended')->default(false);
        });

        // Popula os novos campos baseados no valor de state
        DB::statement("
            UPDATE advertisements
            SET is_published = (CASE
                WHEN state = 'active' THEN TRUE
                ELSE FALSE
            END),
            is_suspended = (CASE
                WHEN state = 'archived' THEN TRUE
                ELSE FALSE
            END)
        ");

        Schema::table('advertisements', function (Blueprint $table) {
            // Remover o campo state após migração dos dados
            $table->dropColumn('state');
        });
    }

    public function down(): void
    {
        Schema::table('advertisements', function (Blueprint $table) {
            // Recriar o campo state
            $table->string('state')->default('pending');
        });

        // Restaurar valores baseados nos campos booleanos
        DB::statement("
            UPDATE advertisements
            SET state = CASE
                WHEN is_suspended = TRUE THEN 'archived'
                WHEN is_published = TRUE THEN 'active'
                ELSE 'pending'
            END
        ");

        Schema::table('advertisements', function (Blueprint $table) {
            // Remover os novos campos
            $table->dropColumn(['is_published', 'is_suspended']);
        });
    }
};
