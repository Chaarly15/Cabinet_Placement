<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppelOffre;
use App\Models\Entreprises;

class AppelOffreController extends Controller
{
    public function index()
    {
        $currentDate = now(); // Obtenir la date et l'heure actuelles

        // Récupérer tous les appels d'offres
        $appelOffreEnCours = AppelOffre::where('date_limite_candidature', '>', $currentDate)->get();
        $appelOffreExpirers = AppelOffre::where('date_limite_candidature', '<=', $currentDate)->get();
        $appelOffreEnTraitements = AppelOffre::where('etat_appel_offre', '=', 'en_traitement')->get();
        $appelOffreAttenteVs = AppelOffre::where('etat_appel_offre', '=', 'attente_v_stage')->get();

        return view('appel-offre.index', [
            'appelOffreEnCours' => $appelOffreEnCours,
            'appelOffreExpirers' => $appelOffreExpirers,
            'appelOffreEnTraitements' => $appelOffreEnTraitements,
            'appelOffreAttenteVs' => $appelOffreAttenteVs,
        ]);
    }

    public function create()
    {
        $entreprises = Entreprises::all();
        return view('appel-offre.create', ['entreprises'=>$entreprises]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'entreprise_id' => 'required',
            'nom_contrat' => 'required|string|max:255',
            //'secteurs_activite' => 'required|string|max:255',

            'type_offre' => 'required|string|max:255',

            'intitule_poste' => 'required|string|max:255',

            'nb_poste' => 'required|integer',

            //'detail_mission' => 'string',

            //'age_min' => 'integer',
            //'age_max' => 'integer',
            //'nationalite' => 'string|max:255',
            //'2emelangue' => 'string|max:255',
            'debut_mission' => 'required|date',
            'fin_mission' => 'required|date',
            //'date_debut' => 'required|date',
            //'date_fin' => 'required|date',
            'specialite' => 'required|string|max:255',

            'niveau_formation' => 'required|integer',

            'nbr_experience_pro' => 'required|integer',

            //'detail_experience_pro' => 'string',

            //'detail_competence' => 'string',

            'renumeration' => 'required|integer',

            //'detail_renum eration' => 'required|string|max:255',

            //'nbr_poste_dispo' => 'integer',

            'lieu_poste' => 'required|string|max:255',

            //'date_limite_candidature' => 'required|date',

            //'date_candidature' => 'required|date',
            //'etat_appel_offre' => 'required|string|max:255',
        ]);

        if ($request->filled('nom_etp')) {
            $request->validate([
                'nom_etp' => 'required|string|max:255',
                'nom_directeur_etp' => 'required|string|max:255',
                'nom_drh_etp' => 'required|string|max:255',
                'adress_post_etp' => 'required|string|max:255',
                'localisation_etp' => 'required|string|max:255',
                'tel_etp' => 'required|string|max:20',
                'tel_etp2' => 'nullable|string|max:20',
                'email_etp' => 'required|string|email|max:255|unique:entreprises',
            ]);

            $entreprise = Entreprises::create($request->only([
                'nom_etp', 'nom_directeur_etp', 'nom_drh_etp', 'adress_post_etp',
                'localisation_etp', 'tel_etp', 'tel_etp2', 'email_etp'
            ]));

            $request->merge(['entreprise_id' => $entreprise->id]);
        }

        AppelOffre::create($request->all());

        return redirect()->route('appel-offre.index')->with('success', 'Entreprise créée avec succès.');
    }
}
