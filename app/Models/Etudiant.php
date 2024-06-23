<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stage;
use App\Models\User;
use App\Models\Candidature;

namespace App\Models;

class Etudiant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nom',
        'prenom',
        'prenom_etud',
        'tel_etud',
        'adress_etud',
        'ville_etud',
        'commune_etud',
        'date_naiss_etud',
        'filiere_etud',
        'niveau_formation_etud',
        'cv_path',
        'role',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stages()
    {
        return $this->hasMany(Stage::class, 'etudiant_id');
    }

    public function candidatures()
    {
        return $this->hasMany(Candidature::class, 'etudiant_id');
    }
}
