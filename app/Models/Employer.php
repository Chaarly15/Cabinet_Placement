<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Candidature;

class Employer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'nom', 'prenom', 'tel_empl', 'adress_empl', 'role',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function candidatures()
    {
        return $this->hasMany(Candidature::class, 'employer_id');
    }

    /**
     * Get all of the validMails for the Employer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function validMails(): HasMany
    {
        return $this->hasMany(ValidMail::class);
    }

    public function selections()
    {
        return $this->hasMany(Selection::class);
    }
}
