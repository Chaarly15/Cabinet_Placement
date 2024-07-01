<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stage;
use Carbon\Carbon;
use App\Models\Etudiant;

class DashboardController extends Controller
{
    public function index()
    {
        $stagesParCabinet = Stage::whereNotNull('selection_id')->count();
        $stagesSansCabinet = Stage::whereNull('selection_id')->count();

        $stagesParAnnee = Stage::selectRaw('YEAR(created_at) as year, COUNT(*) as count')
                               ->groupBy('year')
                               ->get();

        $stagesParFiliere = Stage::join('etudiants', 'stages.etudiant_id', '=', 'etudiants.id')
                                 ->selectRaw('etudiants.filiere_etud as filiere, COUNT(*) as count')
                                 ->groupBy('filiere')
                                 ->get();

        $stagesParEntreprise = Stage::join('entreprises', 'stages.entreprise_id', '=', 'entreprises.id')
                                    ->selectRaw('entreprises.nom_etp as entreprise, COUNT(*) as count')
                                    ->groupBy('entreprise')
                                    ->get();

        $stagesParNiveau = Stage::selectRaw('niveau_formation_etud as niveau, COUNT(*) as count')
                                 ->join('etudiants', 'stages.etudiant_id', '=', 'etudiants.id')
                                 ->groupBy('niveau')
                                 ->get();

        $stagesParTypeOffre = Stage::join('appel_offres', 'stages.appel_offre_id', '=', 'appel_offres.id')
                                    ->selectRaw('appel_offres.type_offre as type, COUNT(*) as count')
                                    ->groupBy('type')
                                    ->get();

        return view('dashboard', compact(
            'stagesParCabinet',
            'stagesSansCabinet',
            'stagesParAnnee',
            'stagesParFiliere',
            'stagesParEntreprise',
            'stagesParNiveau',
            'stagesParTypeOffre'
        ));
    }

    public function updateChart(Request $request)
    {
        return response()->json([
            'labels' => $request->input('labels'),
            'data' => $request->input('data')
        ]);
    }
}
