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
        Schema::create('categorie_filiaires', function (Blueprint $table) {
            $table->id();
            $table->string('nom_categori_fil');
            $table->timestamps();
        });

        Schema::table('etudiants', function (Blueprint $table) {
            $table->foreignId('categorie_filiaire_id')->nullable()->constrained('categorie_filiaires')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorie_filiaires');

        Schema::table('etudiants', function (Blueprint $table) {
            $table->dropForeign(['etudiant_id']);
            $table->dropColumn('etudiant_id');
        });
    }
};
