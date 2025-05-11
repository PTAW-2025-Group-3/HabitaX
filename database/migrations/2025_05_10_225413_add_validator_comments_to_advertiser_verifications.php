<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advertiser_verifications', function (Blueprint $table) {
            // Verifica se a coluna não existe antes de adicioná-la
            if (!Schema::hasColumn('advertiser_verifications', 'validator_comments')) {
                $table->text('validator_comments')->nullable()->after('validated_by');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advertiser_verifications', function (Blueprint $table) {
            if (Schema::hasColumn('advertiser_verifications', 'validator_comments')) {
                $table->dropColumn('validator_comments');
            }
        });
    }
};
