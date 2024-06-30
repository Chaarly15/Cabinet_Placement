<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\AppelOffre;
use App\Models\Selection;
use App\Models\CategorieFiliaire;
use Illuminate\Http\Request;

class SelectionController extends Controller
{
    public function create($id)
    {
        $etudiants = Etudiant::all();
        $appelOffre = AppelOffre::find($id);
        $categoriefiliaires = CategorieFiliaire::all();
        return view('selection.create', [
            'etudiants' => $etudiants,
            'appelOffre' => $appelOffre,
            'categoriefiliaires' => $categoriefiliaires
        ]);
    }

    public function store(Request $request)
    {
        $appelOffreId = $request->input('appel_offre_id');
        $etudiantIds = $request->input('etudiant_ids');

        foreach ($etudiantIds as $etudiantId) {
            Selection::create([
                'employer_id' => $request->user()->employer->id,
                'appel_offre_id' => $appelOffreId,
                'etudiant_id' => $etudiantId,
                'type_selection' => 'selection_appel_offre',
            ]);
        }

        // Mettre à jour l'état de l'appel d'offre
        $appelOffre = AppelOffre::find($appelOffreId);
        $appelOffre->update(['etat_appel_offre' => 'attente_v_stage']);

        return redirect()->route('appel-offre.index')->with('success', 'Sélections créées avec succès.');
    }

    public function filter(Request $request)
    {
        $query = Etudiant::query();

        if ($request->filled('filiere')) {
            $query->where('categorie_filiaire_id', $request->filiere);
        }

        if ($request->filled('ville')) {
            $query->where('ville_etud', $request->ville);
        }

        if ($request->filled('commune')) {
            $query->where('commune_etud', $request->commune);
        }

        if ($request->filled('age')) {
            $query->whereRaw('TIMESTAMPDIFF(YEAR, date_naiss_etud, CURDATE()) = ?', [$request->age]);
        }

        if ($request->filled('niveau_formation')) {
            $query->where('niveau_formation_etud', $request->niveau_formation);
        }

        $etudiants = $query->get();

        return response()->json($etudiants);
    }

    public function bestMatch($appelOffreId)
    {
        $appelOffre = AppelOffre::find($appelOffreId);

        $etudiants = Etudiant::where('categorie_filiaire_id', $appelOffre->specialite)->get(); // correction ici

        return response()->json($etudiants);
    }
}
