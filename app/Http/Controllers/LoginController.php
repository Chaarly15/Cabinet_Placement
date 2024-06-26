<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            // Redirection basée sur le rôle de l'utilisateur
            $user = Auth::user();
            if ($user->role === 'student') {
                return redirect()->intended(route('cabinet-de-placement.index'))->with('success', 'Connexion réussie.');
            } elseif ($user->role === 'medium_employer' || $user->role === 'super_employer') {
                return redirect()->intended(route('dashboard'))->with('success', 'Connexion réussie.');
            }
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    public function logout(Request $request)
    {
        dd('Logout method reached');
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
