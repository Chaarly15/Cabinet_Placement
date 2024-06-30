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
        Schema::create('appel_offres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entreprise_id')->constrained()->onDelete('cascade');
            $table->string('nom_contrat');
            $table->string('type_offre');
            $table->string('intitule_poste');
            $table->string('nb_poste')->nullable();
            $table->text('detail_mission');
            $table->unsignedInteger('age_min');
            $table->unsignedInteger('age_max');
            $table->string('nationalite');
            $table->string('2emelangue');
            $table->string('debut_mission');
            $table->string('fin_mission');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->string('specialite');
            $table->unsignedInteger('niveau_formation');
            $table->unsignedInteger('nbr_experience_pro');
            $table->text('detail_experience_pro')->nullable();
            $table->text('detail_competence');
            $table->unsignedInteger('renumeration');
            $table->unsignedInteger('nbr_poste_dispo');
            $table->string('lieu_poste');
            //$table->date('date_limite_candidature');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appel_offres');
    }
};
