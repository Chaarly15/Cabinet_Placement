<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppelsOffre extends Model
{
    use HasFactory;

    protected $fillable = [
        'entreprise_id',
        'nom_contrat',
        'type_offre',
        'intitule_poste',
        'nb_poste',
        'detail_mission',
        'age_min',
        'age_max',
        'nationalite',
        '2emelangue',
        'debut_mission',
        'fin_mission',
        'date_debut',
        'date_fin',
        'specialite',
        'niveau_formation',
        'nbr_experience_pro',
        'detail_experience_pro',
        'detail_competence',
        'renumeration',
        'nbr_poste_dispo',
        'lieu_poste',
    ];

    public function stages()
    {
        return $this->hasMany(Stage::class);
    }
}
