<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntretienController extends Controller
{
    //
  public function store(Request $request)
    {
        // Valider les données du formulaire
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',  // Assure-toi que la table 'cars' existe dans la base de données
            'date' => 'required|date',
            'type' => 'required|string|max:255',
        ]);

        // Créer l'entretien
        Entretien::create($validated);

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Entretien ajouté avec succès.');
    }

     public function create(Car $car)
    {
        // Récupérer les informations nécessaires pour l'entretien
        return view('entretiens.create', compact('car'));
    }

    // Dans EntretienController.php
public function update(Request $request, Entretien $entretien)
{
    // Logique de mise à jour
}

public function destroy(Entretien $entretien)
{
    // Logique de suppression
}
}
