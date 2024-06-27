<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppelOffreController extends Controller
{
    public function index()
    {
        // Logique pour récupérer et afficher les appels d'offre
        return view('appel-offre.index');
    }
}
