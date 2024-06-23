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
        Schema::create('entreprises', function (Blueprint $table) {
            $table->id();
            $table->string('nom_etp');
            $table->string('nom_directeur_etp');
            $table->string('nom_drh_etp');
            $table->string('adress_post_etp');
            $table->string('localisation_etp');
            $table->string('tel_etp');
            $table->string('tel_etp2')->nullable();
            $table->string('email_etp');
            $table->string('site_web_etp');
            $table->string('natu_acti_etp');
            $table->unsignedInteger('eff_etp');
            $table->string('nom_cont_sa_etp');
            $table->string('fonction_cont_sa_etp');
            $table->string('tel_cont_sa_etp');
            $table->string('email_cont_sa_etp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entreprises');
    }
};
