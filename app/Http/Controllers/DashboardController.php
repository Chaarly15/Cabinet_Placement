<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stage;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtenir les données pour les graphiques
        $stagesParCabinet = Stage::whereNotNull('selection_id')->count();
        $stagesSansCabinet = Stage::whereNull('selection_id')->count();

        // Evolution du nombre de stages par année
        $stagesParAnnee = Stage::selectRaw('YEAR(created_at) as year, COUNT(*) as count')
                               ->groupBy('year')
                               ->get();

        return view('dashboard', compact('stagesParCabinet', 'stagesSansCabinet', 'stagesParAnnee'));
    }
}
