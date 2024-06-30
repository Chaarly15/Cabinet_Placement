<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Etudiant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nom',
        'prenom',
        'nom_etude',
        'prenom_etud',
        'tel_etud',
        'adress_etud',
        'ville_etud',
        'commune_etud',
        'date_naiss_etud',
        'filiere_etud',
        'categorie_filier_etd',
        'niveau_formation_etud',
        'cv_path',
        'role',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categorieFiliaire()
    {
        return $this->belongsTo(FategorieFiliaire::class);
    }

    public function stages()
    {
        return $this->hasMany(Stage::class, 'etudiant_id');
    }

    public function candidatures()
    {
        return $this->hasMany(Candidature::class, 'etudiant_id');
    }

    public function selections()
    {
        return $this->hasMany(Selection::class);
    }
}
