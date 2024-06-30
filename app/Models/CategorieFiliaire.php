<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieFiliaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'categorie_filiaires_id', 'nom_categori_fil',
    ];

    public function etudiant()
    {
        return $this->hasMany(Etudiant::class, 'categorie_filiaires_id');
    }
}
