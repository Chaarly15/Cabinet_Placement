<?php

namespace App\Http\Controllers;

use App\Http\Resources\EtudiantsResource;
use App\Models\Etudiants;
use Illuminate\Http\Request;

class EtudiantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function allEtudiants()
    {
        $etudiants = Etudiants::all();
        // dd($etudiants->toArray());

        return   view('Etudiant', ['etudiants' => EtudiantsResource::collection($etudiants)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Etudiants $etudiants)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Etudiants $etudiants)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Etudiants $etudiants)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Etudiants $etudiants)
    {
        //
    }
}
