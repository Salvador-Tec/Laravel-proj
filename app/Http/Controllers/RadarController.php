<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Radar;

class RadarController extends Controller
{
    public function index(Request $request)
{
    $query = Radar::query();

    if ($request->filled('search_matricule')) {
        $query->whereHas('car', fn($q) => $q->where('matricule', 'like', '%' . $request->search_matricule . '%'));
    }

    if ($request->filled('search_marque')) {
        $query->whereHas('car', fn($q) => $q->where('marque', 'like', '%' . $request->search_marque . '%'));
    }

    if ($request->filled('search_modele')) {
        $query->where('modele', 'like', '%' . $request->search_modele . '%');
    }

    $radars = $query->with('car')->get();
    $cars = Car::all();

    return view('admin.radar', compact('radars', 'cars'));
}

public function update(Request $request, $id)
{
    $radar = Radar::findOrFail($id);
    
    $validatedData = $request->validate([
        'matricule' => 'nullable|string|max:255',
        'brand' => 'nullable|string|max:255',
        'model' => 'nullable|string|max:255',
        'date_infraction' => 'nullable|date',
        'date_traitement' => 'nullable|date',
        'numero_contrat' => 'nullable|string|max:255',
        'traite' => 'nullable|boolean',
    ]);

    // Mise à jour des champs du radar
    $radar->date_infraction = $validatedData['date_infraction'] ?? $radar->date_infraction;
    $radar->date_traitement = $validatedData['date_traitement'] ?? $radar->date_traitement;
    $radar->numero_contrat = $validatedData['numero_contrat'] ?? $radar->numero_contrat;
    $radar->traite = $validatedData['traite'] ?? false;
    $radar->save();

    // Mise à jour des champs du véhicule lié, s’il existe
    if ($radar->car) {
        $radar->car->matricule = $validatedData['matricule'] ?? $radar->car->matricule;
        $radar->car->brand = $validatedData['brand'] ?? $radar->car->brand;
        $radar->car->model = $validatedData['model'] ?? $radar->car->model;
        $radar->car->save();
    }

    return response()->json(['message' => 'Radar mis à jour avec succès.']);
}





public function showRadarForm()
{
    // Récupérer toutes les voitures
    $cars = Car::all();

    // Récupérer les radars (si besoin)
    $radars = Radar::with('car')->get();

    // Retourner la vue en passant les voitures et radars
    return view('cars.radar', compact('cars', 'radars'));
}



public function show(Car $car)
{
    $radars = $car->radars;
    $cars = Car::all(); // Ajouter cette ligne
    return view('cars.radar', compact('car', 'radars', 'cars'));
}


 public function create()
{
    $cars = \App\Models\Car::all(); // s'assurer qu'on récupère bien les voitures
    dd($cars); // Pour vérifier le contenu
    return view('cars.radar', compact('cars'));
}


    // Stocke un nouveau radar
   public function store(Request $request)
{
    $request->validate([
        'car_id' => 'required|exists:cars,id',
        'modele'=> 'required|string',
        'matricule' => 'required|string',
        'date_infraction' => 'required|date',
        'date_traitement' => 'nullable|date',
        'numero_contrat' => 'nullable|string|max:255',
        'traite' => 'nullable|boolean',
    ]);

    Radar::create([
    'car_id' => $request->car_id,
    'matricule' => $request->matricule,
    'modele' => $request->modele, // <- Ajouté
    'date_infraction' => $request->date_infraction,
    'date_traitement' => $request->date_traitement,
    'numero_contrat' => $request->numero_contrat,
    'traite' => $request->has('traite'),
]);


    return redirect()->back()->with('success', 'Radar ajouté avec succès.');
}

public function getCarsByDate(Request $request)
{
    $date = $request->query('date');
    
    $reservations = Reservation::where('start_date', '<=', $date)
                                ->where('end_date', '>=', $date)
                                ->with(['car', 'client'])
                                ->get();

    $cars = [];
    foreach ($reservations as $reservation) {
        $car = $reservation->car;
        $cars[] = [
            'id' => $car->id,
            'matricule' => $car->matricule,
            'brand' => $car->brand,
            'model' => $car->model,
            'client' => $reservation->client->first_name . ' ' . $reservation->client->last_name
        ];
    }

    return response()->json($cars);
}


    // Affiche la liste des radars pour une voiture donnée (page d'édition)
    public function edit($carId)
    {
        // Trouver la voiture par son ID
        $car = Car::find($carId);

        // Vérifier que la voiture existe
        if (!$car) {
            return redirect()->route('cars.index')->with('error', 'Voiture non trouvée.');
        }

        // Récupérer les radars liés à cette voiture
        $radars = Radar::where('car_id', $carId)->get();

        // Retourner la vue avec les données
        return view('radars.edit', compact('car', 'radars'));
    }

    // Met à jour plusieurs radars (méthode PUT sur route radars.updateMultiple)
    public function updateMultiple(Request $request)
    {
        $radarsData = $request->input('radars', []);

        foreach ($radarsData as $id => $radarData) {
            $radar = Radar::find($id);
            if ($radar) {
                $radar->date_infraction = $radarData['date_infraction'] ?? $radar->date_infraction;
                $radar->date_traitement = $radarData['date_traitement'] ?? $radar->date_traitement;
                $radar->numero_contrat = $radarData['numero_contrat'] ?? $radar->numero_contrat;
                $radar->traite = isset($radarData['traite']) ? 1 : 0;
                $radar->save();
            }
        }

        return redirect()->back()->with('success', 'Radars mis à jour avec succès.');
    }
}
