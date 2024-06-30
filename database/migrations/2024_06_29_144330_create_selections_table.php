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
        Schema::create('selections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_id')->constrained('employers')->onDelete('cascade');
            $table->foreignId('appel_offre_id')->constrained('appel_offres')->onDelete('cascade');
            $table->foreignId('etudiant_id')->nullable()->constrained('etudiants')->onDelete('cascade');
            $table->foreignId('candidature_id')->nullable()->constrained('candidatures')->onDelete('cascade');
            $table->string('type_selection');
            $table->timestamps();
        });

        Schema::table('stages', function (Blueprint $table) {
            $table->foreignId('selection_id')->nullable()->constrained('selections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the foreign key first, then the column, and finally the table 'selections'
        Schema::table('stages', function (Blueprint $table) {
            $table->dropForeign(['selection_id']);
            $table->dropColumn('selection_id');
        });

        Schema::dropIfExists('selections');
    }
};

