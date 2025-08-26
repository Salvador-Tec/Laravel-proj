<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VisiteTechniqueController extends Controller
{
    //

    public function store(Request $request)
    {
        // Valider les données du formulaire
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',  // Assurez-vous que la table 'cars' existe dans la base de données
            'next_check' => 'required|date',
        ]);

        // Créer la visite technique
        VisiteTechnique::create($validated);

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Visite technique ajoutée avec succès.');
    }

    public function create(Car $car)
    {
        // Logique pour afficher la vue de création d'une visite technique
        return view('visites-techniques.create', compact('car'));
    }
}