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
    public function showCalendar($carId)
{
    $car = Car::findOrFail($carId);
    return view('admin.calendrier', compact('car'));
}

    public function indexCardi(Request $request)
{
    $cars = Car::latest()->paginate(8);
    $highlight = $request->input('highlight'); // Optionnel si tu l'utilises dans cardi.blade.php

    return view('admin.cardi', compact('cars', 'highlight'));
}


    public function availableCars(Request $request)
{
    // Récupérer les dates et heures de la requête (attendues au format Y-m-d et H:i)
    $startDate = $request->input('start_date');
    $startTime = $request->input('delivery_time');
    $endDate = $request->input('end_date');
    $endTime = $request->input('return_time');
    $gearbox = $request->input('gearbox_type');
    $pickupLocation = $request->input('pickup_location');
    $returnLocation = $request->input('return_location');

    if (!($startDate && $endDate && $startTime && $endTime)) {
        return redirect()->back()->with('error', 'Veuillez fournir les dates et heures de départ et de retour.');
    }

    // Supporte formats 'Y-m-d' et 'd-m-Y' (datepicker home utilise dd-mm-yyyy)
    $startDateRaw = str_replace('/', '-', $startDate);
    $endDateRaw = str_replace('/', '-', $endDate);
    $startDateTime = null;
    $endDateTime = null;
    try {
        // Essai 1: d-m-Y
        $startDateTime = Carbon::createFromFormat('d-m-Y H:i', "$startDateRaw $startTime");
        $endDateTime   = Carbon::createFromFormat('d-m-Y H:i', "$endDateRaw $endTime");
    } catch (\Exception $e1) {
        try {
            // Essai 2: Y-m-d
            $startDateTime = Carbon::createFromFormat('Y-m-d H:i', "$startDateRaw $startTime");
            $endDateTime   = Carbon::createFromFormat('Y-m-d H:i', "$endDateRaw $endTime");
        } catch (\Exception $e2) {
            return redirect()->back()->with('error', 'Format de date/heure invalide.');
        }
    }

    if ($endDateTime <= $startDateTime) {
        return redirect()->back()->with('error', 'La date de retour doit être après la date de départ.');
    }

    // Filtrer les voitures SANS réservation qui chevauche l’intervalle demandé
    $availableCars = Car::whereDoesntHave('reservations', function ($query) use ($startDateTime, $endDateTime) {
        $query->whereIn('status', ['active', 'reserve'])
              ->where(function ($q) use ($startDateTime, $endDateTime) {
                  // Overlap si: existing_start < new_end AND existing_end > new_start
                  $q->whereRaw('CONCAT(start_date, " ", delivery_time) < ?', [$endDateTime->format('Y-m-d H:i:s')])
                    ->whereRaw('CONCAT(end_date, " ", return_time) > ?', [$startDateTime->format('Y-m-d H:i:s')]);
              });
    })
    ->when($gearbox, function ($query, $gearbox) {
        return $query->whereIn('gearbox_type', $gearbox);
    })
    ->when($pickupLocation, function ($query, $pickupLocation) {
        return $query->where('pickup_location', 'like', '%' . $pickupLocation . '%');
    })
    ->when($returnLocation, function ($query, $returnLocation) {
        return $query->where('return_location', 'like', '%' . $returnLocation . '%');
    })
    ->get();

    if ($availableCars->isEmpty()) {
        return view('cars.available', compact('availableCars'))
            ->with('error', 'Aucune voiture disponible pour la période sélectionnée.');
    }

    return view('cars.available', compact('availableCars'));
}

public function viewCar($id)
{
    $car = Car::findOrFail($id);
    return view('admin.voiture', compact('car'));
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
            'gearbox_type' => 'nullable|array',
            'gearbox_type.*' => 'in:Automatique,manuelle',
            'pickup_location' => 'nullable|string|max:255', // Ajout de la validation pour pickup_location
        'return_location' => 'nullable|string|max:255', // Ajout de la validation pour return_location
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
        if ($request->filled('gearbox_type')) {
            $query->whereIn('gearbox_type', $request->gearbox_type);
        }
        if ($request->filled('pickup_location')) {
            $query->where('pickup_location', 'like', '%' . $request->pickup_location . '%');
        }
        if ($request->filled('return_location')) {
            $query->where('return_location', 'like', '%' . $request->return_location . '%');
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
        $societes = Societe::all();
    return view('admin.createCar', compact('societes'));
    }

   /**
 * Store a newly created resource in storage.
 */
public function store(Request $request)
{
    // 1) Validation et récupération des données validées
    $validated = $request->validate([
        'brand'                 => 'required|string|max:255',
        'model'                 => 'required|string|max:255',
        'engine'                => 'required|string|max:255',
        'quantity'              => 'required|integer|min:1',
        'seasonal_price'        => 'required|numeric|min:0',
        'price_per_day'         => 'required|numeric|min:0',
        'summer_price'          => 'required|numeric|min:0',
        'reduce'                => 'required|numeric|min:0|max:100',
        'stars'                 => 'required|integer|between:1,5',
        'matricule'             => 'required|string|max:255',
        'gearbox_type'          => 'required|string|in:manuelle,automatique',
        'image'                 => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        'status'                => 'required|in:available,unavailable',
        'pickup_location'       => 'required|string|max:255',
        'return_location'       => 'required|string|max:255',
        'numero_serie'          => 'required|string|max:255',
        'date_dpme'             => 'required|date',
        'date_dde'              => 'required|date',
        'date_echeance_leasing' => 'required|date',
        'etat_echeance_leasing' => 'required|string|max:255',
        'reglement'             => 'required|string|max:255',
        'nom_societe'           => 'required|string|max:255',
    ]);

    // 2) Prépare la variable $imagePath (null si pas d'upload)
    $imagePath = null;

    // 3) Si un fichier 'image' est présent, on le stocke et on récupère le chemin
    if ($request->hasFile('image')) {
        $file     = $request->file('image');
        $filename = Str::slug($validated['brand'].'-'.$validated['model'])
                    .'-'.time().'.'.$file->getClientOriginalExtension();
        // stocke dans storage/app/public/car_images
        $imagePath = $file->storeAs('car_images', $filename, 'public');
    }

    // 4) Instancie et remplit le modèle Car
    $car = new Car([
        'brand'                 => $validated['brand'],
        'model'                 => $validated['model'],
        'engine'                => $validated['engine'],
        'quantity'              => $validated['quantity'],
        'seasonal_price'        => $validated['seasonal_price'],
        'price_per_day'         => $validated['price_per_day'],
        'summer_price'          => $validated['summer_price'],
        'reduce'                => $validated['reduce'],
        'stars'                 => $validated['stars'],
        'matricule'             => $validated['matricule'],
        'gearbox_type'          => $validated['gearbox_type'],
        'status'                => $validated['status'],
        'pickup_location'       => $validated['pickup_location'],
        'return_location'       => $validated['return_location'],
        'numero_serie'          => $validated['numero_serie'],
        'date_dpme'             => $validated['date_dpme'],
        'date_dde'              => $validated['date_dde'],
        'date_echeance_leasing' => $validated['date_echeance_leasing'],
        'etat_echeance_leasing' => $validated['etat_echeance_leasing'],
        'reglement'             => $validated['reglement'],
        'nom_societe'           => $validated['nom_societe'],
        // on stocke ici le chemin (ou null)
        'image'                 => $imagePath,
    ]);
    
    // 5) Sauvegarde en base
    $car->save();

    return redirect()->route('cars.index')
                     ->with('success', 'La voiture a été ajoutée avec succès.');
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


        $societes = Societe::all();
return view('admin.updateCar', compact('car', 'societes'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $car = Car::findOrFail($id);
      
        $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'engine' => 'required',
            'quantity' => 'required',
            'price_per_day' => 'required',
            'reduce' => 'required',
            'stars' => 'required',
            'matricule' => 'required|unique:cars,matricule,' . $car->id,
            'gearbox_type' => 'required|in:automatique,manuelle',
            'pickup_location' => 'nullable|string|max:255',
        'return_location' => 'nullable|string|max:255',
            'nom_societe' => 'required|string|max:255',

          
  
          
        ]);
    
        $car->update([
            'brand' => $request->brand,
            'model' => $request->model,
            'engine' => $request->engine,
            'quantity' => $request->quantity,
            'price_per_day' => $request->price_per_day,
            'reduce' => $request->reduce,
            'stars' => $request->stars,
            'matricule' => $request->matricule,
            'gearbox_type' => $request->gearbox_type,
            'pickup_location' => $request->pickup_location,
        'return_location' => $request->return_location,
        'nom_societe' => $request->nom_societe,
        'status' => $request->status,
        

        ]);
       //dd($request->all());
    
        // 1. Suppression de l'image si demandé
        if ($request->input('delete_image') == '1') {
            if ($car->image) {
                Storage::disk('public')->delete($car->image);
                $car->image = null;
                $car->save();
            }
        }

        // 2. Upload d'une nouvelle image si présente
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($car->image) {
                Storage::disk('public')->delete($car->image);
            }
            $file = $request->file('image');
            $filename = Str::slug($request->brand . '-' . $request->model) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $imagePath = $file->storeAs('car_images', $filename, 'public');
            $car->image = $imagePath;
            $car->save();
        }
    
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
    try {
        // Valider les données saisies
        $request->validate([
            'date' => 'required|date|after_or_equal:today', // La date ne doit pas être dans le passé
            'time' => 'required|date_format:H:i', // Format de l'heure de départ (HH:MM)
            'return_date' => 'required|date|after_or_equal:' . $request->input('date'), // La date de retour doit être après la date de départ
            'return_time' => 'required|date_format:H:i', // Format de l'heure de retour (HH:MM)
            'gearbox_type' => 'nullable|array',
            'gearbox_type.*' => 'in:manuelle,Automatique',
            'pickup_location' => 'nullable|string', // Lieu de prise en charge
            'return_location' => 'nullable|string', // Lieu de restitution
        ]);

        // Récupérer la date et l'heure choisies
        $date = $request->input('date');
        $time = $request->input('time');
        $returnDate = $request->input('return_date');
        $returnTime = $request->input('return_time');
        
        // Créer des objets Carbon combinant la date et l'heure de départ et de retour
        $startDateTime = Carbon::createFromFormat('Y-m-d H:i', "$date $time");
        $endDateTime = Carbon::createFromFormat('Y-m-d H:i', "$returnDate $returnTime");
        $gearbox = $request->input('gearbox_type'); // array ['manuelle', 'automatique'] ou null
        $pickupLocation = $request->input('pickup_location'); // Lieu de prise en charge
        $returnLocation = $request->input('return_location'); // Lieu de restitution


        $cars = Car::whereDoesntHave('reservations', function ($query) use ($startDateTime, $endDateTime) {
            $query->where(function ($query) use ($startDateTime, $endDateTime) {
                // Vérifier si la réservation chevauche avec la période choisie
                $query->whereDate('start_date', '=', $startDateTime->toDateString()) // Vérifier que la date de début est le même jour
                    ->whereTime('start_date', '<=', $endDateTime->toTimeString()) // Vérifier que l'heure de début est avant l'heure de fin
                    ->whereTime('end_date', '>=', $startDateTime->toTimeString()); // Vérifier que l'heure de fin est après l'heure de début
            })
            // Vérifier que la réservation est ACTIVE (exclure uniquement les réservations actives)
            ->where('status', 'active'); 
        })
        ->when($gearbox, function ($query, $gearbox) {
            return $query->whereIn('gearbox_type', $gearbox);
        })
        ->when($pickupLocation, function ($query, $pickupLocation) {
            return $query->where('pickup_location', 'like', '%' . $pickupLocation . '%');
        })
        ->when($returnLocation, function ($query, $returnLocation) {
            return $query->where('return_location', 'like', '%' . $returnLocation . '%');
        })
        ->get();

        // Retourner les résultats de la recherche à la vue
        return view('cars.search_results', [
            'cars' => $cars,
            'startDateTime' => $startDateTime,
            'endDateTime' => $endDateTime,
        ]);
        
    } catch (\Exception $e) {
        // Enregistrer l'erreur dans le fichier de log
        \Log::error('Erreur dans la recherche de voiture: ' . $e->getMessage());

        // Retourner une vue d'erreur avec un message approprié
        return redirect()->route('cars.index')->with('error', 'Une erreur s\'est produite lors du traitement de votre recherche. Veuillez réessayer plus tard.');
    }
}


    public function filterByMatricule(Request $request)
    {
        // Récupérer la valeur du matricule depuis la requête
        $matricule = $request->input('matricule');
        
        // Initialiser la variable pour le surlignage
        $highlight = null;
    
        // Vérifier si une recherche est effectuée
        if ($matricule) {
            // Rechercher les voitures correspondant au matricule
            $cars = Car::where('matricule', 'LIKE', '%' . $matricule . '%')->paginate(10);
    
            // Si une seule voiture correspond, définir l'ID pour le surlignage
            if ($cars->count() === 1) {
                $highlight = $cars->first()->id;
            }
        } else {
            // Si aucun matricule n'est fourni, retourner toutes les voitures
            $cars = Car::paginate(10);
        }
    
        // Retourner la vue 'admin.cars'
        return view('admin.cars', [
            'cars' => $cars,
            'highlight' => $highlight,
        ]);
    }
    

    

    public function getActiveReservationsForCalendar($carId)
    {
        $reservations = Reservation::where('car_id', $carId)
            ->where('status', 'active')
            ->get(['start_date', 'end_date', 'id']);
    
        $calendarEvents = $reservations->map(function ($reservation) {
            return [
                'id' => $reservation->id,
                'title' => 'Réservation active',
                'start' => $reservation->start_date,
                'end' => $reservation->end_date,
                'color' => '#ff0000', // rouge pour indiquer actif
            ];
        });
    
        return response()->json($calendarEvents);
    }
    public function showCarReservations($carId)
{
    // Récupérer la voiture
    $car = Car::find($carId);

    // Vérifier si la voiture existe
    if (!$car) {
        return redirect()->back()->with('error', 'Car not found');
    }

    // Récupérer les réservations actives pour cette voiture
    $activeReservations = Reservation::where('car_id', $car->id)
                                      ->where('status', 'active')
                                      ->get();

    // Passer la voiture et les réservations actives à la vue
    return view('admin.cars', compact('car', 'activeReservations'));
}
public function displayCarDetails(Car $car)
{
    $car->load(['assurances', 'visitesTechniques', 'entretiens']);
    return view('admin.details', compact('car'));
}
public function Radar($id)
{
    // Récupère la voiture avec ses radars (relation 'radars')
    $car = Car::with('radars')->findOrFail($id);

    // Récupère les radars de cette voiture
    $radars = $car->radars;

    // Passe les données à la vue
    return view('admin.radar', compact('car', 'radars'));
}
public function getReservedCars(Request $request)
    {
        $request->validate([
            'date' => 'required|date'
        ]);

        $date = Carbon::parse($request->date);

        // Récupérer les réservations actives pour cette date
        $reservations = Reservation::where('status', 'active')
            ->whereDate('start_date', '<=', $date)
            ->whereDate('end_date', '>=', $date)
            ->get();

        // Récupérer les IDs des voitures réservées
        $reservedCarIds = $reservations->pluck('car_id')->unique()->toArray();

        // Récupérer les voitures réservées avec leurs informations
        $reservedCars = Car::whereIn('id', $reservedCarIds)
            ->get(['id', 'matricule', 'brand', 'model']);

        return response()->json($reservedCars);
    }

public function editCar(Request $request, $id)
{
    // Validation des champs du formulaire
    $validated = $request->validate([
        // Infos générales voiture
        'marque' => 'required|string|max:255',
        'modele' => 'required|string|max:255',
        'matricule' => 'required|string|max:255',
        'boite' => 'required|string|in:manuelle,automatique',
        'moteur' => 'nullable|string|max:255',
        'prix' => 'required|numeric|min:0',
        'pickup_location' => 'nullable|string|max:255',
        'return_location' => 'nullable|string|max:255',
        'quantite' => 'required|integer|min:0',

        // Assurance
        'nom_assurance' => 'nullable|string|max:255',
        'date_debut_assurance' => 'nullable|date',
        'date_fin_assurance' => 'nullable|date',
        'montant_assurance' => 'nullable|numeric|min:0',
        'nb_jours' => 'nullable|integer|min:0',

        // Entretien
        'kilometrage' => 'nullable|integer|min:0',
        'type_entretien' => 'nullable|string|max:255',
        'date_entretien' => 'nullable|date',
        'remarque' => 'nullable|string|max:1000',
        'date_prochain_entretien' => 'nullable|date',
        'kilometrage_prochain_entretien' => 'nullable|integer|min:0',

        // Visite Technique
        'date_visite' => 'nullable|date',
        'kilometrage' => 'nullable|integer|min:0',
        'date_prochain_visite' => 'nullable|date',
        'remarque' => 'nullable|string|max:1000',
    ]);

    // Récupération du véhicule
    $car = Car::findOrFail($id);

    // Mise à jour des informations générales
    $car->update([
        'brand' => $validated['marque'],
        'model' => $validated['modele'],
        'matricule' => $validated['matricule'],
        'gearbox_type' => $validated['boite'],
        'engine' => $validated['moteur'] ?? null,
        'price_per_day' => $validated['prix'],
        'pickup_location' => $validated['pickup_location'] ?? null,
        'return_location' => $validated['return_location'] ?? null,
        'quantity' => $validated['quantite'],
    ]);

    // Mise à jour ou création des informations d'assurance
    $car->assurances()->updateOrCreate(
        ['car_id' => $car->id],
        [
            'nom' => $validated['nom_assurance'] ?? null,
            'date_debut' => $validated['date_debut_assurance'] ?? null,
            'date_fin' => $validated['date_fin_assurance'] ?? null,
            'montant' => $validated['montant_assurance'] ?? null,
            'jours_restants' => $validated['nb_jours'] ?? null,
        ]
    );

    // Mise à jour ou création des informations d'entretien
    $car->entretiens()->updateOrCreate(
        ['car_id' => $car->id],
        [
            'kilometrage' => $validated['kilometrage'] ?? null,
            'type_entretien' => $validated['type_entretien'] ?? null,
            'date_entretien' => $validated['date_entretien'] ?? null,
            'remarque' => $validated['remarque'] ?? null,
            'date_prochain_entretien' => $validated['date_prochain_entretien'] ?? null,
            'kilometrage_prochain_entretien' => $validated['kilometrage_prochain_entretien'] ?? null,
        ]
    );

    // Mise à jour ou création des informations de visite technique
    $car->visitesTechniques()->updateOrCreate(
        ['car_id' => $car->id],
        [
            'date_visite' => $validated['date_visite'] ?? null,
            'kilometrage' => $validated['kilometrage'] ?? null,
            'date_prochain_visite' => $validated['date_prochain_visite'] ?? null,
            'remarque' => $validated['remarque'] ?? null,
        ]
    );

    // Redirection avec un message de succès
    return redirect()->route('cars.index')->with('success', 'Véhicule mis à jour avec succès.');
}

}       