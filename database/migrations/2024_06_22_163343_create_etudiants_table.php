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
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nom_etude');
            $table->string('prenom_etud');
            $table->string('tel_etud');
            $table->string('adress_etud');
            $table->string('ville_etud');
            $table->string('commune_etud');
            $table->date('date_naiss_etud');
            $table->string('filiere_etud');
            $table->unsignedInteger('niveau_formation_etud');
            $table->string('cv_path');
            $table->string('role')->default('student');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};
