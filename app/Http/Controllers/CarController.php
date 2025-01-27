<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Reservation;
use Carbon\Carbon;


class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cars = Car::latest()->paginate(8);
        $highlight = $request->input('highlight'); // ID de la voiture à mettre en surbrillance

        return view('admin.cars', compact('cars', 'highlight'));

    }
    public function availableCars(Request $request)
{
    // Récupérer les dates et heures de la requête
    $startDate = $request->input('start_date');
    $startTime = $request->input('delivery_time');
    $endDate = $request->input('end_date');
    $endTime = $request->input('return_time');

    // Vérifier si les dates et heures sont valides
    if ($startDate && $endDate && $startTime && $endTime) {
        // Créer des objets Carbon pour la date et l'heure de début et de fin
        $startDateTime = Carbon::createFromFormat('Y-m-d H:i', "$startDate $startTime");
        $endDateTime = Carbon::createFromFormat('Y-m-d H:i', "$endDate $endTime");

        // Vérifier si la différence entre les deux dates et heures est inférieure à 2 jours
        $duration = $startDateTime->diffInDays($endDateTime);

        if ($duration < 2) {
            return redirect()->back()->with('error', 'La durée minimale de réservation est de 2 jours.');
        }
    } else {
        return redirect()->back()->with('error', 'Veuillez fournir des dates ou des marques valides.');
    }

    // Filtrer les voitures disponibles
    $availableCars = Car::whereDoesntHave('reservations', function ($query) use ($startDate, $endDate, $startTime, $endTime) {
        $query->where(function ($query) use ($startDate, $endDate) {
            // Vérification du chevauchement des dates
            $query->where('start_date', '<=', $endDate)
                  ->where('end_date', '>=', $startDate);
        })
        // Vérification des chevauchements d'heures dans la même journée
        ->orWhere(function ($query) use ($startDate, $startTime, $endTime) {
            // Vérifier si la réservation est pour la même journée
            $query->whereDate('start_date', '=', $startDate)
                  ->whereDate('end_date', '=', $startDate)
                  ->where(function ($query) use ($startTime, $endTime) {
                      // Vérification des chevauchements horaires sur la même journée
                      $query->whereRaw('TIME(delivery_time) < ?', [$endTime])
                            ->whereRaw('TIME(return_time) > ?', [$startTime]);
                  });
        });
    })->get();

    // Si aucune voiture n'est disponible, retourner avec un message flash
    if ($availableCars->isEmpty()) {
        return redirect()->route('cars.available')->with('popup_message', 'Aucune voiture disponible pour la période sélectionnée.');
    }

    // Retourner la vue avec les voitures disponibles
    return view('cars.available', compact('availableCars'));
}

    

    public function filterCars(Request $request)
    {
        // Validation des entrées
        $request->validate([
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'delivery_time' => 'nullable|string',
            'return_time' => 'nullable|string',
        ]);
    
        // Filtrage des voitures disponibles en fonction des dates
        $query = Car::query();
    
        if ($request->filled('brand')) {
            $query->where('brand', 'like', '%' . $request->brand . '%');
        }
        if ($request->filled('model')) {
            $query->where('model', 'like', '%' . $request->model . '%');
        }
        if ($request->filled('min_price')) {
            $query->where('price_per_day', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price_per_day', '<=', $request->max_price);
        }
        if ($request->filled(['start_date', 'delivery_time', 'end_date', 'return_time'])) {
            $startDateTime = Carbon::createFromFormat('Y-m-d H:i', $request->start_date . ' ' . $request->delivery_time);
            $endDateTime = Carbon::createFromFormat('Y-m-d H:i', $request->end_date . ' ' . $request->return_time);
    
            $query->whereDoesntHave('reservations', function ($subQuery) use ($startDateTime, $endDateTime) {
                $subQuery->where(function ($q) use ($startDateTime, $endDateTime) {
                    $q->whereRaw('? < CONCAT(end_date, " ", return_time)', [$startDateTime])
                      ->whereRaw('? > CONCAT(start_date, " ", delivery_time)', [$endDateTime]);
                });
            });
        }
    
        $cars = $query->paginate(9);
    
        if ($cars->isEmpty()) {
            // Si aucune voiture n'est disponible, afficher un message
            return redirect()->route('cars.available')->with('message', 'Aucune voiture disponible pour la période sélectionnée. Consultez nos autres options disponibles!');
        }
    
        return view('cars.filter_search_results', compact('cars'));
    }
    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.createCar');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Valider les données
    $request->validate([
        'brand' => 'required',
        'model' => 'required',
        'engine' => 'required',
        'quantity' => 'required|integer|min:1',
        'price_per_day' => 'required|numeric|min:0',
        'status' => 'required|in:available,unavailable',
        'reduce' => 'required|numeric|min:0|max:100',
        'stars' => 'required|integer|min:1|max:5',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240', // max 10MB
        'matricule' => 'required|unique:cars,matricule', // Matricule unique
        'gearbox_type' => 'required|in:automatique,manuelle', // Boîte de vitesses
    ]);

    // Vérifier si une voiture avec la même matricule existe
    $existingCar = Car::where('matricule', $request->matricule)->first();
    if ($existingCar) {
        return redirect()->back()
            ->withErrors(['matricule' => 'La voiture avec cette matricule est déjà enregistrée.'])
            ->withInput();
    }

    // Créer une nouvelle voiture
    $car = new Car;
    $car->brand = $request->brand;
    $car->model = $request->model;
    $car->engine = $request->engine;
    $car->quantity = $request->quantity;
    $car->price_per_day = $request->price_per_day;
    $car->status = $request->status;
    $car->reduce = $request->reduce;
    $car->stars = $request->stars;
    $car->matricule = $request->matricule;
    $car->gearbox_type = $request->gearbox_type;

    // Gestion de l'image
    if ($request->hasFile('image')) {
        // Obtenir le nom original du fichier
        $originalImageName = $request->file('image')->getClientOriginalName();
        
        // Stocker l'image dans le dossier public/images/cars avec son nom d'origine
        $path = $request->file('image')->storeAs('public/images/cars', $originalImageName);

        // Mettre à jour le chemin relatif de l'image dans la base de données
        $car->image = 'images/cars/' . $originalImageName;
    }

    // Sauvegarder la voiture
    $car->save();

    // Retourner à la page d'index avec un message de succès
    return redirect()->route('cars.index')->with('success', 'Voiture ajoutée avec succès.');
}


    /**
     * Display the specified resource.
     */
    /*public function show(Car $car)
    {
        //
    }*/

    public function show($id)
{
    // Récupérer la voiture par son ID
    $car = Car::findOrFail($id);

    // Passer la variable $car à la vue
    return view('reservation.create', compact('car'));
}



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        $car = Car::findOrFail($car->id);
        return view('admin.updateCar', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
{
    $request->validate([
        'brand' => 'required',
        'model' => 'required',
        'engine' => 'required',
        'quantity' => 'required',
        'price_per_day' => 'required',
        'status' => 'required',
        'reduce' => 'required',
        'stars' => 'required',
        'matricule' => 'required|unique:cars,matricule,' . $car->id,  // Validation pour matricule (excepté pour l'ID courant)
        'gearbox_type' => 'required|in:automatique,manuelle',  // Validation pour le type de boîte de vitesses
    ]);

    $car->brand = $request->brand;
    $car->model = $request->model;
    $car->engine = $request->engine;
    $car->quantity = $request->quantity;
    $car->price_per_day = $request->price_per_day;
    $car->status = $request->status;
    $car->reduce = $request->reduce;
    $car->stars = $request->stars;
    $car->matricule = $request->matricule;  // Ajout du matricule
    $car->gearbox_type = $request->gearbox_type;  // Ajout du type de boîte

    if ($request->hasFile('image')) {
        $filename = basename($car->image);
        Storage::disk('local')->delete('images/cars/' . $filename);
        
        $imageName = $request->brand . '-' . $request->model . '-' . $request->engine . '-' . Str::random(10) . '.' . $request->file('image')->extension();
        $image = $request->file('image');
        $path = $image->storeAs('images/cars', $imageName);
        $car->image = $path;
    }

    $car->save();

    return redirect()->route('cars.index');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $car = Car::findOrFail($car->id);
        
        // Check if the car has any active reservations
        $activeReservations = $car->reservations()->where('status', 'Active')->count();
        
        if ($activeReservations > 0) {
            // Prevent deletion and return with error message
            return redirect()->route('cars.index')->with('error', 'Cannot delete car with active reservations.');
        }
        
        // Delete inactive reservations
        $car->reservations()->where('status', '!=', 'Active')->delete();
        
        // if ($car->image) {
        //     // Get the filename from the image path
        //     $filename = basename($car->image);

        //     // Delete the image file from the storage
        //     Storage::disk('local')->delete('images/cars/' . $filename);
        // }
        
        $car->delete();

        return redirect()->route('cars.index')->with('success', 'Car deleted successfully.');
    }

    public function search(Request $request)
    {
        //dd($request->all());
        try {
            // Valider les données saisies
            $request->validate([
                'date' => 'required|date|after_or_equal:today', // Assurez-vous que la date n'est pas dans le passé
                'time' => 'required|date_format:H:i', // Valider le format de l'heure (HH:MM)
            ]);
    
            // Récupérer la date et l'heure choisies
            $date = $request->input('date');
            $time = $request->input('time');
            
            // Créer un objet Carbon combinant la date et l'heure
            $dateTime = Carbon::createFromFormat('Y-m-d H:i', "$date $time");
    
            // Rechercher les voitures qui ne sont pas réservées pour cette date et heure spécifiques
            $cars = Car::whereDoesntHave('reservations', function ($query) use ($dateTime) {
                $query->where(function ($query) use ($dateTime) {
                    // Vérifier si la réservation chevauche avec la date et l'heure choisies
                    $query->where('start_date', '<=', $dateTime)
                        ->where('end_date', '>=', $dateTime);
                })
                ->orWhere(function ($query) use ($dateTime) {
                    // Vérifier si la voiture est déjà réservée avec des horaires de livraison et de retour
                    $query->where('delivery_time', '<=', $dateTime)
                        ->where('return_time', '>=', $dateTime);
                })
                ->orWhere(function ($query) use ($dateTime) {
                    // Vérifier les réservations du même jour mais après l'heure de return_time
                    $query->whereDate('end_date', '=', $dateTime->toDateString())  // Le même jour
                        ->where('return_time', '>=', $dateTime->format('H:i')); // L'heure choisie est après return_time
                });
            })->get();

           
    
            // Retourner les résultats de la recherche à la vue
            return view('cars.search_results', [
                'cars' => $cars,
                'dateTime' => $dateTime,
            ]);
            
        } catch (\Exception $e) {
            // Enregistrer l'erreur dans le fichier de log
            dd($e->getMessage());
          

            // Retourner une vue d'erreur avec un message approprié
            return redirect()->route('cars.index')->with('error', 'An error occurred while processing your search. Please try again later.');
        }
    }

    


}
