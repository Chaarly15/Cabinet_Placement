<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfesseurEncadreur;
use App\Models\AppelOffre;
use App\Models\Selection;
use App\Models\Etudiant;
use App\Models\Entreprises;
use App\Models\Stage;

class StageController extends Controller
{
    public function create($id)
    {
        $selections = Selection::where('appel_offre_id', $id)->with('etudiant')->get();
        $encadreurs = ProfesseurEncadreur::all();
        $appelOffre = AppelOffre::find($id);
        return view('stage.create', [
            'selections' => $selections,
            'appelOffre' => $appelOffre,
            'encadreurs' => $encadreurs,
        ]);
    }

    public function directCreate()
    {
        $etudiants = Etudiant::all();
        $encadreurs = ProfesseurEncadreur::all();
        $entreprises = Entreprises::all();
        return view('stage.directCreate', [
            'etudiants' => $etudiants,
            'entreprises' => $entreprises,
            'encadreurs' => $encadreurs,
        ]);
    }

    public function store(Request $request)
    {
        $selectedEtudiantIds = $request->input('etudiant_ids');
        $appelOffreId = $request->input('appel_offre_id');
        $encadreurIds = $request->input('encadreur_ids');
        $datesDebut = $request->input('date_debut');
        $datesFin = $request->input('date_fin');

        foreach ($selectedEtudiantIds as $index => $etudiantId) {
            Stage::create([
                //'appel_offre_id' => $appelOffreId,
                //'etudiant_id' => $etudiantId,
                'selection_id' => Selection::where('appel_offre_id', $appelOffreId)
                                          ->where('etudiant_id', $etudiantId)
                                          ->first()->id,
                'professeur_encadreur_id' => $encadreurIds[$index],
                'date_debut' => $datesDebut[$index],
                'date_fin' => $datesFin[$index],
                'type_obtention_stage_id' => 1,
            ]);
        }

        // Mettre à jour l'état de l'appel d'offre si nécessaire
        AppelOffre::find($appelOffreId)->update(['etat_appel_offre' => 'validé']);

        return redirect()->route('appel-offre.index')->with('success', 'Stages validés avec succès.');
    }

    public function directStore(Request $request)
    {
        $etudiantDirectId = $request->input('etudiant_direct_id');
        $encadreurId = $request->input('encadreur');
        $dateDebutDirect = $request->input('date_debut_direct');
        $dateFinDirect = $request->input('date_fin_direct');

        $entrepriseId = $request->input('entreprise_direct_id');

        // Si une nouvelle entreprise est spécifiée
        if ($request->input('new_entreprise_nom')) {
            $entreprise = Entreprises::create([
                'nom_etp' => $request->input('new_entreprise_nom'),
                'nom_directeur_etp' => $request->input('new_entreprise_directeur'),
                'nom_drh_etp' => $request->input('new_entreprise_drh'),
                'adress_post_etp' => $request->input('new_entreprise_adresse'),
                'localisation_etp' => $request->input('new_entreprise_localisation'),
                'tel_etp' => $request->input('new_entreprise_tel'),
                'tel_etp2' => $request->input('new_entreprise_tel2'),
                'email_etp' => $request->input('new_entreprise_email'),
            ]);
            $entrepriseId = $entreprise->id;
        }

        Stage::create([
            'etudiant_id' => $etudiantDirectId,
            'professeur_encadreur_id' => $encadreurId,
            'date_debut' => $dateDebutDirect,
            'date_fin' => $dateFinDirect,
            'entreprise_id' => $entrepriseId,
            'selection_id' => null,
            'type_obtention_stage_id' => 2,
        ]);

        return redirect()->route('appel-offre.index')->with('success', 'Stages validés avec succès.');
    }
}
