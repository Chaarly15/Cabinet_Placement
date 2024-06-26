<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Employer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'] ?? 'medium_employer', // Rôle par défaut
        ]);

        if ($user->role === 'medium_employer' || $user->role === 'super_employer') {
            Employer::create([
                'user_id' => $user->id,
                'nom' => $data['nom'],
                'prenom' => $data['prenom'],
                'tel' => $data['tel'],
                'adresse' => $data['adresse'],
                'ville' => $data['ville'],
                'commune' => $data['commune'],
                'poste' => $data['poste'],
                'entreprise' => $data['entreprise'],
                'role' => $user->role,
            ]);
        }

        return $user;
    }

    public function showSuperEmployerRegisterForm()
    {
        return view('auth.register-super-employer');
    }

    public function createSuperEmployer(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = User::create([
            //'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'super_employer',
        ]);

        Employer::create([
            'user_id' => $user->id,
            'nom' => $request->name,
            'prenom' => $request->prenom,
            'tel_empl' => $request->tel_empl,
            'adress_empl' => $request->adress_empl,
            //'ville' => $request->ville,
            //'commune' => $request->commune,
            //'poste' => $request->poste,
            //'entreprise' => $request->entreprise,
            'role' => 'super_employer',
        ]);

        return redirect()->route('dashboard')->with('success', 'Compte super_employer créé avec succès.');
    }

}
