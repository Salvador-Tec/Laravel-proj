<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssuranceController extends Controller
{
    //

    // Ajouter une nouvelle assurance
    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'expiration_date' => 'required|date',
            'type' => 'required|string|max:255',
            'numero_police' => 'required|string|max:255',
        ]);

        Assurance::create($validated);

        return redirect()->back()->with('success', 'Assurance ajoutée avec succès.');
    }

     public function create(Car $car)
    {
        // Récupérer les informations nécessaires pour créer une assurance
        return view('assurances.create', compact('car'));
    }

    // app/Http/Controllers/AssuranceController.php
public function update(Request $request, Assurance $assurance)
{
    // Logique de mise à jour
}


}