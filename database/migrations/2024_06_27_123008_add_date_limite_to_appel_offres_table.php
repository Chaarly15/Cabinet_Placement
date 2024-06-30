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
        Schema::table('appel_offres', function (Blueprint $table) {
            $table->date('date_limite_candidature');
            $table->string('etat_appel_offre');
        });

        Schema::table('stages', function (Blueprint $table) {
            $table->foreignId('type_obtention_stage_id')->constrained('type_obtention_stage')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appel_offres', function (Blueprint $table) {
            $table->dropColumn('date_limite_candidature');
            $table->dropColumn('etat_appel_offre');
        });

        Schema::table('stages', function (Blueprint $table) {
            $table->dropForeign(['type_obtention_stage_id']);
            $table->dropColumn('type_obtention_stage_id');
        });
    }
};
