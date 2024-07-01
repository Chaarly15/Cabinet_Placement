<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfesseurEncadreur extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'tel_prof',
        'adress_prof',
    ];

    public function stages()
    {
        return $this->hasMany(Stage::class);
    }
}

