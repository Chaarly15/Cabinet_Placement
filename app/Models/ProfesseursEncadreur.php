<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfesseursEncadreur extends Model
{
    use HasFactory;

    protected $fillablev = [
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
