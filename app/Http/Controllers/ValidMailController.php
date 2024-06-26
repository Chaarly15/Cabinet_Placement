<?php

namespace App\Http\Controllers;

use App\Models\ValidMail;
use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidMailController extends Controller
{
    public function index()
    {
        $validMails = ValidMail::where('employer_id', Auth::user()->employer->id)->get();
        return view('valid_mail.index', compact('validMails'));
    }

    public function create()
    {
        return view('valid_mail.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:valid_mail,email',
            'role' => 'required|in:medium_employer,super_employer',
        ]);

        ValidMail::create([
            'employer_id' => Auth::user()->employer->id,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->route('valid_mail.index')->with('success', 'Email autorisé ajouté avec succès.');
    }

    public function destroy(ValidMail $validMail)
    {
        $validMail->delete();
        return redirect()->route('valid_mail.index')->with('success', 'Email autorisé supprimé avec succès.');
    }
}
