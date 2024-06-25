<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EtudiantController extends Controller
{
    //montrer la page de creation de compte
    public function create()
    {
        return view('etudiants.create');
    }

    public function edit()
    {
        $etudiant = Auth::user()->etudiant;
        return view('etudiants.update', compact('etudiant'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $etudiant = $user->etudiant;

        $request->validate([
            'nom_etude' => 'required|string|max:255',
            'prenom_etud' => 'required|string|max:255',
            'tel_etud' => 'required|string|max:255',
            'adress_etud' => 'required|string|max:255',
            'ville_etud' => 'required|string|max:255',
            'commune_etud' => 'required|string',
            'date_naiss_etud'=>'required|string',
            'niveau_formation_etud'=>'required|integer|min:2',
            'filiere_etud'=>'required|string',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $etudiant->update([
            'nom_etude' => $request->nom_etude,
            'prenom_etud' => $request->prenom_etud,
            'tel_etud' => $request->tel_etud,
            'adress_etud' => $request->adress_etud,
            'ville_etud' => $request->ville_etud,
            'commune_etud' => $request->commune_etud,
            'date_naiss_etud'=> $request->date_naiss_etud,
            'niveau_formation_etud'=> $request->niveau_formation_etud,
            'filiere_etud'=> $request->filiere_etud,
        ]);

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->email = $request->email;
        $user->save();

        return redirect()->route('cabinet-de-placement.index')->with('success', 'Informations mises à jour avec succès.');
    }

    //enregistrer dans la bas de donnée
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            //'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nom_etude' => ['required', 'string', 'max:255'],
            'prenom_etud' => ['required', 'string', 'max:255'],
            'tel_etud' => ['required', 'string', 'max:20'],
            'adress_etud' => ['required', 'string', 'max:255'],
            'ville_etud' => ['required', 'string', 'max:255'],
            'commune_etud' => ['required', 'string', 'max:255'],
            'date_naiss_etud' => ['required', 'date'],
            'filiere_etud' => ['required', 'string', 'max:255'],
            'niveau_formation_etud' => ['required', 'integer'],
            'cv_path' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:2048'],
        ]);

        /*$validator = Validator::make($request->all(), $validatedData);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }*/

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student',
        ]);

        $cvPath = $request->file('cv_path')->store('cvs', 'public');

        Etudiant::create([
            'user_id' => $user->id,
            'nom_etude' => $request->nom_etude,
            'prenom_etud' => $request->prenom_etud,
            'tel_etud' => $request->tel_etud,
            'adress_etud' => $request->adress_etud,
            'ville_etud' => $request->ville_etud,
            'commune_etud' => $request->commune_etud,
            'date_naiss_etud' => $request->date_naiss_etud,
            'filiere_etud' => $request->filiere_etud,
            'niveau_formation_etud' => $request->niveau_formation_etud,
            'cv_path' => $cvPath,
        ]);

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        Auth::login($user);

        if(Auth::login($user)){
            $request->session()->regenerate();

            return redirect()->intended(route('cabinet-de-placement.index'));
        }

        return redirect()->route('cabinet-de-placement.index');

        return redirect()->route('cabinet-de-placement.index')->with('success', 'Étudiant créé avec succès.');
    }
}
