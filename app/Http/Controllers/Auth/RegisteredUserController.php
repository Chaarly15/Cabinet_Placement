<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

use App\Models\Employer;
use App\Models\ValidMail;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validator($request->all())->validate();

        $validMailSuperemployer = ValidMail::where('email', $request->email)->where('role', 'super_employer')->first();
        $validMailMediumemployer = ValidMail::where('email', $request->email)->where('role', 'medium_employer')->first();

        if ($validMailSuperemployer) {
            $role = 'super_employer';
        } elseif ($validMailMediumemployer) {
            $role = 'medium_employer';
        } else {
            return redirect()->back()->withErrors(['email' => 'Cet email n\'est pas autorisé à créer un compte employeur.']);
        }

        $user = User::create([
            //'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
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
            'role' => $role,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
