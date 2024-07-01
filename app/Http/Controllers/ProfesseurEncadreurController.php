<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfesseurEncadreur;

class ProfesseurEncadreurController extends Controller
{
    public function create()
    {
        return view('professeurs.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'tel_prof' => 'required|string|max:20',
            'adress_prof' => 'required|string|max:255',
        ]);

        ProfesseurEncadreur::create($validatedData);

        return redirect()->route('dashboard')->with('success', 'Professeur encadreur créé avec succès.');
    }
}
