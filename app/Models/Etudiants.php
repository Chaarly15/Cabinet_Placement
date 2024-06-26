<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiants extends Model
{
    use HasFactory;
    protected $fillable = ["nom", "prenom", "sexe", "matricule", "filiere", "niveau_etude", "residence","competences"];
    protected $casts = [
        'competences' => 'json',
    ];

    
}
