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
        Schema::table('advertiser_verifications', function (Blueprint $table) {
            // Remover campos não necessários
            $table->dropColumn(['document_url', 'photo_url']);

            // Adicionar novo campo para o tipo de documento
            $table->string('identifier_type')->nullable()->comment('Tipo de documento (CC, Passaporte, Carta de Condução)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('advertiser_verifications', function (Blueprint $table) {
            // Reverter mudanças (adicionar campos removidos e remover os novos)
            $table->string('document_url')->nullable();
            $table->string('photo_url')->nullable();

            $table->dropColumn('identifier_type');
        });
    }
};
