<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\Car;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
 




     public function create($car_id)
     {
         try {
             // Récupérer les données de la voiture à partir de la base de données
             $car = Car::find($car_id);
             
             // Si la voiture n'est pas trouvée, rediriger vers un autre formulaire
             if (!$car) {
                 return redirect()->route('reservation.create', ['car_id' => 1]); // Exemple : redirige vers une voiture par défaut (id=1)
             }
     
             // Récupérer le numéro d'identité depuis la session (si existant)
             $identityNumber = session('identity_number', null);
             $reservedDates = Reservation::pluck('start_date', 'end_date')->toArray();
     
             // Vérifier si identity_number existe dans la table clients
             if ($identityNumber) {
                 $client = Client::where('identity_number', $identityNumber)->first();
                 
                 // Si le client existe, vérifier s'il a déjà une réservation
                 if ($client) {
                     $existingReservation = Reservation::where('identity_number', $identityNumber)->first();
     
                     // Si une réservation existe pour ce client, rediriger vers l'édition de réservation
                     if ($existingReservation) {
                         return view('reservation.edit', [
                             'reservation' => $existingReservation,
                             'car' => $car,
                             'reservedDates' => $reservedDates,
                         ]);
                     }
                 } else {
                     // Si le client n'existe pas dans la table clients, retourner une erreur ou rediriger
                     return redirect()->route('reservation.create', ['car_id' => $car_id])
                         ->with('error', 'Le numéro d\'identité est invalide ou n\'existe pas.');
                 }
             }
     
             // Retourner la vue avec les données nécessaires
             return view('reservation.create', compact('car', 'identityNumber', 'reservedDates'));
     
         } catch (\Exception $e) {
             // Gérer l'exception (affichage d'un message d'erreur générique)
             return redirect()->route('home')->with('error', 'Une erreur est survenue. Veuillez réessayer plus tard.');
         }
     }
     
     
    /*************/
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $car_id)
{
    //dd($request);
    try {
        
        // Vérifier que la voiture existe
        $car = Car::findOrFail($car_id);

        // Validation des champs
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'delivery_time' => 'required|date_format:H:i',
            'return_time' => 'required|date_format:H:i',
            'nationality' => 'required|string|max:255',
            'identity_number' => 'required|string|max:255',
            'driver_license_number' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:255',
            'identity_date' => 'required|date',  
            'license_date' => 'required|date',
            'gallery' => 'nullable|array|min:3', 
            'gallery.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120', 
        ]);

        $identityNumber = $request->input('identity_number');
        $client = Client::where('identity_number', $identityNumber)->first();
        if (!$client) {
            // Appeler une fonction pour ajouter un client
            $client = $this->addClient($request);
        }
    

// Les autres champs de la réservation
$startDate = new \Carbon\Carbon($request->input('start_date'));
$endDate = new \Carbon\Carbon($request->input('end_date'));
$deliveryTime = \Carbon\Carbon::createFromFormat('H:i', $request->input('delivery_time'));
$returnTime = \Carbon\Carbon::createFromFormat('H:i', $request->input('return_time'));

// Vérification des conflits avec les réservations existantes
/*$reservations = Reservation::where('car_id', $car->id)
->where(function ($query) use ($startDate, $endDate) {
    $query->where('start_date', '<=', $endDate)
          ->where('end_date', '>=', $startDate);
})
->get();*/

// Vérification des dates et heures
if ($startDate->equalTo($endDate) && $deliveryTime->gt($returnTime)) {
    return redirect()->route('reservations.create', ['car_id' => $car_id])
                     ->with('error', 'L\'heure de retour doit être après l\'heure de livraison pour la même journée.');
}

$existingReservation = Reservation::where('car_id', $car->id)
    ->where(function ($query) use ($startDate, $endDate, $deliveryTime, $returnTime) {
        $query
            ->where(function ($query) use ($startDate, $endDate, $deliveryTime, $returnTime) {
                // Vérification des chevauchements sur plusieurs jours
                $query->where('start_date', '<=', $endDate)
                      ->where('end_date', '>=', $startDate);
            })
            ->orWhere(function ($query) use ($startDate, $deliveryTime, $returnTime) {
                // Vérification si la réservation est pour le même jour (start_date == end_date)
                $query->whereDate('start_date', '=', $startDate->toDateString())
                      ->whereDate('end_date', '=', $startDate->toDateString())
                      ->where(function ($query) use ($deliveryTime, $returnTime) {
                          // Vérification des chevauchements d'heures sur une journée
                          $query->whereRaw('TIME(delivery_time) < ?', [$returnTime->format('H:i')])
                                ->whereRaw('TIME(return_time) > ?', [$deliveryTime->format('H:i')]);
                      });
            });
    })
    ->exists();


if ($existingReservation) {
    return redirect()->route('cars')->with('error', 'Aucune voiture disponible pour la période sélectionnée.');
}

        // Calcul de la durée et du prix total
        $days = $startDate->diffInDays($endDate);
     $pricePerDay = $car->price_per_day;
        $totalPrice = $days * $pricePerDay;

        // Créer une nouvelle réservation
        $reservation = new Reservation();
        // Assigner les autres données de la réservation
        $reservation->car_id = $car->id;
        $reservation->first_name = $request->input('first_name');
        $reservation->last_name = $request->input('last_name');
        $reservation->start_date = $startDate->toDateString();
        $reservation->end_date = $endDate->toDateString();
        $reservation->delivery_time = $deliveryTime->format('H:i');
        $reservation->return_time = $returnTime->format('H:i');
        $reservation->nationality = $request->input('nationality');
        $reservation->identity_number = $request->input('identity_number');
        $reservation->driver_license_number = $request->input('driver_license_number');
        $reservation->address = $request->input('address');
        $reservation->mobile_number = $request->input('mobile_number');
        $reservation->days = $days;
        $reservation->price_per_day = $pricePerDay;
        $reservation->total_price = $totalPrice;
        $reservation->status = 'canceled';
        $reservation->payment_method = 'on_site';
        $reservation->payment_status = 'non payé';
        $reservation->identity_date = $request->input('identity_date');
        $reservation->license_date = $request->input('license_date'); 

        // Vérifie si les fichiers ont été envoyés
        if ($request->hasFile('gallery')) {
            $uploadedImages = [];
            foreach ($request->file('gallery') as $file) {
                // Vérifier si le fichier est valide avant de le stocker
                if ($file->isValid()) {
                    $path = $file->store('reservations/gallery', 'public');
                    $uploadedImages[] = $path;
                }
            }
            // Sauvegarde les chemins des images en tant que JSON
            $reservation->gallery = json_encode($uploadedImages);
        }

        // Enregistrer la réservation dans la base de données
        $reservation->save();

        return redirect()->route('home')->with('success', 'Réservation créée avec succès.');
    } catch (\Exception $e) {
        // Afficher l'erreur pour déboguer
        dd($e->getMessage());
    }
}

public function getReservedDates(Request $request)
{
    $carId = $request->query('car_id');

    // Récupérer les réservations pour la voiture donnée
    $reservations = Reservation::where('car_id', $carId)
        ->select('start_date', 'end_date')
        ->get();

    $reservedDates = [];

    // Générer toutes les dates entre start_date et end_date pour chaque réservation
    foreach ($reservations as $reservation) {
        $period = new \DatePeriod(
            new \DateTime($reservation->start_date),
            new \DateInterval('P1D'),
            (new \DateTime($reservation->end_date))->modify('+1 day')
        );

        foreach ($period as $date) {
            $reservedDates[] = $date->format('Y-m-d');
        }
    }

    return response()->json($reservedDates);
}


private function addClient($request)
{
    $client = new Client();
    $client->first_name = $request->input('first_name');
    $client->last_name = $request->input('last_name');
    $client->identity_number = $request->input('identity_number');
    $client->driver_license_number = $request->input('driver_license_number');
    $client->address = $request->input('address');
    $client->nationality = $request->input('nationality');
    $client->mobile_number = $request->input('mobile_number');
    $client->identity_date = $request->input('identity_date');
    $client->license_date = $request->input('license_date');

    if ($request->hasFile('gallery')) {
        $uploadedImages = [];
        foreach ($request->file('gallery') as $file) {
            // Vérifier si le fichier est valide avant de le stocker
            if ($file->isValid()) {
                // Enregistrer l'image dans le dossier public/images/clients avec son nom original
                $filename = $file->getClientOriginalName();
                $file->move(public_path('images/clients'), $filename);
                $uploadedImages[] = 'images/clients/' . $filename; // Ajouter le chemin relatif
            }
        }
        // Sauvegarde les chemins des images en tant que JSON
        $client->gallery = json_encode($uploadedImages);
    }

    $client->save();
    return $client;
}



public function checkAvailability(Request $request)
{
    $carId = $request->input('car_id');
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');
    $deliveryTime = $request->input('delivery_time');
    $returnTime = $request->input('return_time');

    // Récupérer toutes les réservations existantes pour la voiture
    $reservations = Reservation::where('car_id', $carId)
        ->orderBy('start_date')
        ->get();

    foreach ($reservations as $reservation) {
        // Convertir les dates et heures en objets DateTime
        $existingStart = new \DateTime($reservation->start_date . ' ' . $reservation->delivery_time);
        $existingEnd = new \DateTime($reservation->end_date . ' ' . $reservation->return_time);
        $newStart = new \DateTime($startDate . ' ' . $deliveryTime);
        $newEnd = new \DateTime($endDate . ' ' . $returnTime);

        // Vérifier si la nouvelle réservation chevauche une réservation existante
        if ($newStart < $existingEnd && $newEnd > $existingStart) {
            return response()->json([
                'available' => false,
                'next_available_datetime' => $existingEnd->format('Y-m-d H:i:s'),
            ]);
        }
    }

    // Si aucun conflit n'a été trouvé
    return response()->json(['available' => true]);
}

public function generatePDF($id)
{
    $reservation = Reservation::findOrFail($id);

    // Charger le contenu HTML à partir de la vue Blade
    $html = view('pdf-reservation', compact('reservation'))->render();

    // Crée un fichier PDF à partir du contenu HTML
    $pdf = app('dompdf.wrapper');
    $pdf->loadHTML($html);
    
    // Retourne le PDF pour téléchargement
    return $pdf->download('contrat_reservation_' . $reservation->id . '.pdf');
}


    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    // Edit and Update Payment status
    public function editPayment(Reservation $reservation)
    {
        $reservation = Reservation::find($reservation->id);
        return view('admin.updatePayment', compact('reservation'));
    }

    public function updatePayment(Request $request, $reservationId)
    {
        // Validation des données
        $request->validate([
            'payment_method' => 'required|string', // Méthode de paiement obligatoire
            'payment_status' => 'required|string',
            'amount_paid' => 'required|numeric|min:0',  // Validation pour amount_paid
        ]);
    
        // Récupération de la réservation
        $reservation = Reservation::findOrFail($reservationId);
    
        // Vérification du statut du paiement
        if ($reservation->payment_status == 'payed') {
            return redirect()->route('adminDashboard')->with('error', 'Le paiement est déjà entièrement effectué.');
        }
    
        // Ajout du montant payé à la valeur précédente
        $reservation->amount_paid += $request->input('amount_paid'); // Cumul du montant payé
    
        // Mise à jour du statut de paiement en fonction du montant payé
        if ($reservation->amount_paid >= $reservation->total_price) {
            $reservation->payment_status = 'payed';
        } elseif ($reservation->amount_paid > 0) {
            $reservation->payment_status = 'Partiellement payé';
        } else {
            $reservation->payment_status = 'not_paid';
        }
    
        // Mise à jour des informations de paiement
        $reservation->payment_method = $request->input('payment_method');
        
        // Enregistrement des modifications
        $reservation->save();
    
        // Redirection avec message de succès
        return redirect()->route('adminDashboard')->with('success', 'Paiement mis à jour avec succès.');
    }
    
    

    // Edit and Update Reservation Status
    public function editStatus(Reservation $reservation)
    {
        $reservation = Reservation::find($reservation->id);
        return view('admin.updateStatus', compact('reservation'));
    }

    public function updateStatus(Reservation $reservation, Request $request)
    {
        $reservation = Reservation::find($reservation->id);
        $reservation->status = $request->status;
        $car = $reservation->car;
        if($request->status == 'inactive' ){
            $car->status = 'available';
            $car->save();
        }
        $reservation->save();
        return redirect()->route('adminDashboard');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}

