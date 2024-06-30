<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Selection extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id',
        'appel_offre_id',
        'etudiant_id',
        'candidature_id',
        'type_selection',
    ];

    public function stages()
    {
        return $this->hasMany(Stage::class);
    }

    public function employers()
    {
        return $this->belongsTo(Employer::class);
    }

    public function etudiants()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function candidatures()
    {
        return $this->belongsTo(Candidature::class);
    }

    public function appelsOffres()
    {
        return $this->belongsTo(AppelOffre::class);
    }
}
