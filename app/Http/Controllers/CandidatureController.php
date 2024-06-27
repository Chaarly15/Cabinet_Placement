<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CandidatureController extends Controller
{
    public function index()
    {
        // Logique pour récupérer et afficher les candidatures
        return view('candidature.index');
    }
}
