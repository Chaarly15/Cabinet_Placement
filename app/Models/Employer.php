<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Candidature;

class Employer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'nom', 'prenom', 'role',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function candidatures()
    {
        return $this->hasMany(Candidature::class, 'employer_id');
    }
}
