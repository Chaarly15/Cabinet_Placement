<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_debut',
        'date_fin',
        'type_obtention_stage_id',
        'etudiant_id',
        'appel_offre_id',
        'professeur_encadreur_id',
        'selection_id',
    ];

    public function selection()
    {
        return $this->belongsTo(Selection::class);
    }
}
