<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidatures extends Model
{
    use HasFactory;

    protected $fillable = [
        'etudiant_id',
        'employer_id',
        'status',
    ];
}
