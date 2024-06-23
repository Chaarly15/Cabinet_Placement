<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprises extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_etp',
        'nom_directeur_etp',
        'nom_drh_etp',
        'adress_post_etp',
        'localisation_etp',
        'tel_etp',
        'tel_etp2',
        'email_etp',
        'site_web_etp',
        'natu_acti_etp',
        'eff_etp',
        'nom_cont_sa_etp',
        'fonction_cont_sa_etp',
        'tel_cont_sa_etp',
        'email_cont_sa_etp',
    ];

    public function appelsOffres()
    {
        return $this->hasMany(AppelOffre::class);
    }
}
