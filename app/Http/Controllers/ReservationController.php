<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\Car;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        
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
                return redirect()->route('cars')->with('error', 'Voiture introuvable.');
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
     
                     // Si une réservation existe pour ce client, afficher la page de création pré-remplie
                     if ($existingReservation) {
                         // Récupérer les dates depuis la session pour pré-remplir
                         $startRaw = session('start_date');
                         $endRaw = session('end_date');
                         $delivery_time = session('delivery_time');
                         $return_time = session('return_time');
                         $start_date = $startRaw ? Carbon::parse(str_replace('/', '-', $startRaw))->format('Y-m-d') : null;
                         $end_date = $endRaw ? Carbon::parse(str_replace('/', '-', $endRaw))->format('Y-m-d') : null;

                         return view('reservation.create', [
                             'car' => $car,
                             'identityNumber' => $identityNumber,
                             'reservedDates' => $reservedDates,
                             'start_date' => $start_date,
                             'end_date' => $end_date,
                             'delivery_time' => $delivery_time,
                             'return_time' => $return_time,
                             'client' => $client,
                             'existingReservation' => $existingReservation,
                         ]);
                     }
                                 } else {
                    // Si le client n'existe pas, continuer quand même vers le formulaire de création
                    // L'utilisateur pourra remplir toutes les infos.
                }
             }
     
                         // Récupérer les dates depuis la session pour pré-remplir le formulaire
            $startRaw = session('start_date');
            $endRaw = session('end_date');
            $delivery_time = session('delivery_time');
            $return_time = session('return_time');

            // Normaliser les dates au format YYYY-MM-DD pour l'affichage et JS
            $start_date = $startRaw ? Carbon::parse(str_replace('/', '-', $startRaw))->format('Y-m-d') : null;
            $end_date = $endRaw ? Carbon::parse(str_replace('/', '-', $endRaw))->format('Y-m-d') : null;

            // Retourner la vue avec les données nécessaires
            return view('reservation.create', compact('car', 'identityNumber', 'reservedDates', 'start_date', 'end_date', 'delivery_time', 'return_time'));
     
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
    try {
        // Vérifie que la voiture existe
        $car = Car::findOrFail($car_id);

        // Valide les données
        $validated = $request->validate([
            // Conducteur principal
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
            'identity_number' => 'required|string|max:255',
            'identity_date' => 'required|date',
            'driver_license_number' => 'required|string|max:255',
            'license_date' => 'required|date',
            'address' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:255',
            'gallery' => 'required|array|min:3',
            'gallery.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',

            // Dates de réservation
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'delivery_time' => 'required|date_format:H:i',
            'return_time' => 'required|date_format:H:i',

            // Conducteur secondaire (optionnels)
            'first_name_conducteur' => 'nullable|string|max:255',
            'last_name_conducteur' => 'nullable|string|max:255',
            'date_of_birth_conducteur' => 'nullable|date',
            'place_of_birth_conducteur' => 'nullable|string|max:255',
            'nationality_conducteur' => 'nullable|string|max:255',
            'identity_number_conducteur' => 'nullable|string|max:255',
            'identity_date_conducteur' => 'nullable|date',
            'driver_license_number_conducteur' => 'nullable|string|max:255',
            'license_date_conducteur' => 'nullable|date',
            'address_conducteur' => 'nullable|string|max:255',
            'mobile_number_conducteur' => 'nullable|string|max:255',
            'gallery_conducteur' => 'nullable|array',
            'gallery_conducteur.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',

            // Champs optionnels
            'numero_vol' => 'nullable|string|max:255',
            'avec_chauffeur' => 'nullable|boolean',
            'siege_bebe' => 'nullable|boolean',

            'garantie' => 'required|numeric|min:0',
            'code' => 'nullable|string|max:255',

        ]);
        

        // Vérifie les conflits de réservation
        $existingReservation = Reservation::where('car_id', $car->id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                      ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                      ->orWhere(function ($q) use ($request) {
                          $q->where('start_date', '<=', $request->end_date)
                            ->where('end_date', '>=', $request->start_date);
                      });
            })->exists();

        if ($existingReservation) {
            return back()->with('error', 'La voiture n\'est pas disponible pour les dates sélectionnées.');
        }

        // Calcul des jours et prix
        $startDate = Carbon::parse(str_replace('/', '-', $request->start_date));
        $endDate = Carbon::parse(str_replace('/', '-', $request->end_date));
        $days = max($startDate->diffInDays($endDate), 1); // min 1 jour
        $totalPrice = $days * $car->price_per_day;

        if ($request->boolean('avec_chauffeur')) {
            $totalPrice *= 1.15;
        }

        // Création de la réservation
        $reservation = new Reservation([
            'car_id' => $car->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'date_of_birth' => Carbon::parse(str_replace('/', '-', $request->date_of_birth))->format('Y-m-d'),
            'place_of_birth' => $request->place_of_birth,
            'nationality' => $request->nationality,
            'identity_number' => $request->identity_number,
            'identity_date' => Carbon::parse(str_replace('/', '-', $request->identity_date))->format('Y-m-d'),
            'driver_license_number' => $request->driver_license_number,
            'license_date' => Carbon::parse(str_replace('/', '-', $request->license_date))->format('Y-m-d'),
            'address' => $request->address,
            'mobile_number' => $request->mobile_number,
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'delivery_time' => $request->delivery_time,
            'return_time' => $request->return_time,
            'garantie' => $request->garantie,
            'days' => $days,
            'price_per_day' => $car->price_per_day,
            'total_price' => $totalPrice,
            'status' => 'active',
            'payment_method' => 'on_site',
            'payment_status' => 'pending',
            'numero_vol' => $request->numero_vol,
            'avec_chauffeur' => $request->boolean('avec_chauffeur'),
            'siege_bebe' => $request->boolean('siege_bebe'),
                'code' => $request->input('code'), // <-- ajout ici


        ]);

        // Gère les images du conducteur principal
        if ($request->hasFile('gallery')) {
            $paths = array_map(function ($file) {
                return $file->store('reservations/gallery', 'public');
            }, $request->file('gallery'));
            $reservation->gallery = json_encode($paths);
        }

        // Crée ou récupère le client principal
        Client::firstOrCreate(
            ['identity_number' => $request->identity_number],
            $request->only([
                'first_name', 'last_name', 'identity_number',
                'driver_license_number', 'address', 'nationality',
                'mobile_number', 'identity_date', 'license_date',
                'date_of_birth', 'place_of_birth',
            ]) + [
                'numero_vol' => $request->numero_vol,
                'avec_chauffeur' => $request->boolean('avec_chauffeur'),
                'siege_bebe' => $request->boolean('siege_bebe'),
            ]
        );

        // Gestion du conducteur secondaire si renseigné
        if ($request->filled('first_name_conducteur') && $request->filled('identity_number_conducteur')) {
            $clientSecondaire = Client::firstOrNew(['identity_number' => $request->identity_number_conducteur]);
            $clientSecondaire->fill([
                'first_name' => $request->first_name_conducteur,
                'last_name' => $request->last_name_conducteur,
                'driver_license_number' => $request->driver_license_number_conducteur,
                'address' => $request->address_conducteur,
                'nationality' => $request->nationality_conducteur,
                'mobile_number' => $request->mobile_number_conducteur,
                'identity_date' => $request->identity_date_conducteur,
                'license_date' => $request->license_date_conducteur,
                'date_of_birth' => $request->date_of_birth_conducteur,
                'place_of_birth' => $request->place_of_birth_conducteur,
            ]);

            // Images du conducteur secondaire
            if ($request->hasFile('gallery_conducteur')) {
                $paths = array_map(function ($file) {
                    return $file->store('reservations/gallery_conducteur', 'public');
                }, $request->file('gallery_conducteur'));
                $clientSecondaire->gallery = json_encode($paths);
                $reservation->gallery_conducteur = json_encode($paths);
            }

            $clientSecondaire->save();

            // Lier les données du conducteur secondaire à la réservation
            $reservation->fill([
                'first_name_conducteur' => $clientSecondaire->first_name,
                'last_name_conducteur' => $clientSecondaire->last_name,
                'identity_number_conducteur' => $clientSecondaire->identity_number,
                'driver_license_number_conducteur' => $clientSecondaire->driver_license_number,
                'address_conducteur' => $clientSecondaire->address,
                'nationality_conducteur' => $clientSecondaire->nationality,
                'mobile_number_conducteur' => $clientSecondaire->mobile_number,
                'identity_date_conducteur' => $clientSecondaire->identity_date,
                'license_date_conducteur' => $clientSecondaire->license_date,
                'date_of_birth_conducteur' => $clientSecondaire->date_of_birth,
                'place_of_birth_conducteur' => $clientSecondaire->place_of_birth,
            ]);
        }

                $reservation->save();
        
        return redirect()->route('home')
            ->with('success', 'Réservation créée avec succès ! Code : ' . $request->input('code'))
            ->with('success_reservation', [
                'car' => $car->brand . ' ' . $car->model,
                'start_date' => $startDate->format('Y-m-d'),
                'end_date' => $endDate->format('Y-m-d'),
                'total_price' => number_format($totalPrice, 2, '.', ''),
                'code' => $request->input('code'),
            ]);

    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
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



/*public function update(Request $request, $id)
    {
        // Récupérer la réservation à partir de son ID
        $reservation = Reservation::findOrFail($id);

        // Validation des données (si nécessaire)
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile_number' => 'required|numeric',
            // Ajoutez des validations pour d'autres champs
        ]);

        // Mise à jour de la réservation avec les nouvelles données
        $reservation->first_name = $request->input('first_name');
        $reservation->last_name = $request->input('last_name');
        $reservation->mobile_number = $request->input('mobile_number');
        $reservation->save();

        // Rediriger vers le tableau de bord avec un message de succès
        return redirect()->route('adminDashboard', ['id' => $reservation->id])
                         ->with('success', 'Réservation mise à jour avec succès.');
    }
*/
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
    // Trouver la réservation avec l'id donné
    $reservation = Reservation::findOrFail($id);
    


    // Charger la voiture associée (si la relation existe, par exemple : reservation->car)
    $car = $reservation->car; 

    // Charger le contenu HTML à partir de la vue Blade
    $html = mb_convert_encoding(view('pdf-reservation', compact('reservation','car'))->render(), 'HTML-ENTITIES', 'UTF-8');

    // Crée un fichier PDF à partir du contenu HTML
    $pdf = app('dompdf.wrapper');
    $pdf->setPaper('A4', 'portrait'); // Taille de la page
    $pdf->getDomPDF()->set_option('isHtml5ParserEnabled', true);
    $pdf->getDomPDF()->set_option('isPhpEnabled', true);
    $pdf->loadHTML($html);


    // Retourne le PDF pour téléchargement
    return $pdf->download('contrat_reservation_' . $reservation->id . '.pdf');
}


    /**
     * Display the specified resource.
     */
    public function show($id)
{
    $reservation = Reservation::findOrFail($id);

    return view('reservation.show', compact('reservation'));
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
    public function prolong(Request $request, $id)
{
    $reservation = Reservation::findOrFail($id);

    $reservation->start_date = $request->start_date;
    $reservation->delivery_time = $request->start_time; // heure début
    $reservation->end_date = $request->end_date;
    $reservation->return_time = $request->end_time; // heure fin
    $reservation->status = $request->status; // remet le statut initial
    $reservation->save();

    return response()->json(['success' => true]);
}


    public function toggleStatus(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $newStatus = strtolower(trim($request->input('status')));
    
        // Vérifier si le statut demandé est valide
        $statusFlow = ['pré-réservé', 'reserve', 'active', 'clôturé', 'prolongé'];
        if (!in_array($newStatus, $statusFlow)) {
            return response()->json([
                'success' => false,
                'message' => 'Statut invalide.',
            ]);
        }
    
        if ($reservation->status === 'clôturé') {
            return response()->json([
                'success' => false,
                'message' => 'La réservation est clôturée et ne peut plus être modifiée.',
            ]);
        }
        if ($newStatus === 'prolongé') {
            $newEndDate = $request->input('end_date');
            $newReturnTime = $request->input('return_time');
        
            if ($newEndDate && $newReturnTime) {
                $reservation->end_date = $newEndDate;
                $reservation->return_time = $newReturnTime;
            }
        }
        
    
        $reservation->status = $newStatus;
        $reservation->save();
    
        // Mettre à jour la voiture selon le statut
        $car = $reservation->car;
        $car->status = ($newStatus === 'active' || $newStatus === 'reserve') ? 'reserved' : 'available';
        $car->save();
    
        return response()->json([
            'success' => true,
            'newStatus' => $newStatus,
        ]);
    }
    
    

    /**
     * Update the specified resource in storage.
     */
    /*public function update(Request $request, Reservation $reservation)
    {
        //
    }*/

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $reservation = Reservation::find($id);
        if (!$reservation) {
            return response()->json(['success' => false, 'message' => 'Réservation introuvable.']);
        }
    
        $reservation->delete();
    
        return response()->json(['success' => true]);
    }
    public function getDriverData(Request $request)
{
    $cin = $request->query('cin');

    // Remplace ça par ta vraie logique (base de données ou autre)
    $driver = Driver::where('cin', $cin)->first();

    if ($driver) {
        return response()->json([
            'success' => true,
            'data' => $driver
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Conducteur non trouvé'
        ]);
    }
}
public function check(Request $request)
    {
        $cin = $request->query('cin');

        $driver = DB::table('conducteurs')->where('cin', $cin)->first();

        return response()->json($driver);
    }

     public function showForm(Request $request)
    {
        return view('formulaire', ['data' => null]);
    }

    // Traite le formulaire après avoir entré le CIN
    public function handleCIN(Request $request)
    {
        $cin = $request->input('cin');
        $reservation = Reservation::where('cin', $cin)->first();

        return view('formulaire', ['data' => $reservation]);
    }
    public function checkCin($cin)
    {
        try {
            $client = Client::where('identity_number', $cin)->first();
    
            if ($client) {
                return response()->json([
                    'success' => true,
                    'client' => $client
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Client non trouvé'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function update(Request $request, $id)
{
    // Validation des données
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'identity_number' => 'nullable|string|max:255',
        'mobile_number' => 'nullable|string|max:255',
        'first_name_conducteur' => 'nullable|string|max:255',
        'last_name_conducteur' => 'nullable|string|max:255',
        'identity_number_conducteur' => 'nullable|string|max:255',
        'mobile_number_conducteur' => 'nullable|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
        'payment_method' => 'required|string|max:255',
        'payment_status' => 'required|string|max:255',
        'status' => 'required|string|max:255',
        'gearbox_type' => 'required|string|in:Automatique,Manuelle', // Ajout de la validation
        'pickup_location' => 'required|string|max:255',
        'return_location' => 'required|string|max:255',
        'garantie' => 'required|numeric|min:0',
    ]);
     if (strtolower(trim($validated['status'])) === 'clôturé') {
        $validated['garantie'] = 0;
    }
    // Trouver la réservation
    $reservation = Reservation::findOrFail($id);
   

 
    // Mettre à jour les champs de la réservation
    $reservation->update($validated);

    // Mettre à jour le type de boîte de la voiture associée
    if ($reservation->car) {
        $reservation->car->update([
            'gearbox_type' => $validated['gearbox_type'],
            'pickup_location' => $validated['pickup_location'],
            'return_location' => $validated['return_location'],
        ]);
    }

     
    return redirect()->route('adminDashboard')->with('success', '');
}
    public function showClientDetails($reservationId)
    {
        // Récupère la réservation avec toutes les relations nécessaires
        $reservation = Reservation::with([
            'user', // Client principal
            'car',
            'secondDriver' // Second conducteur (si relation existe)
        ])->findOrFail($reservationId);
    
        // Récupère toutes les réservations du client principal
        $reservations = Reservation::where('user_id', $reservation->user_id)
                                  ->with('car')
                                  ->get();
    
        return view('admin.clientDetails', [
            'reservation' => $reservation,
            'user' => $reservation->user, // Client principal
            'reservations' => $reservations,
            'secondDriver' => $reservation->secondDriver ?? null // Second conducteur
        ]);
    }

 // Dans ReservationController.php

 /*public function updatePrice(Request $request, $id)
 {
     $validated = $request->validate([
         'price_type' => 'required|in:seasonal,estimated,summer',
         'price_per_day' => 'required|numeric|min:0',
         'days' => 'required|integer|min:1',
         'total_price' => 'required|numeric|min:0'
     ]);
 
     $reservation = Reservation::findOrFail($id);
 
     // Vérification du statut de paiement
     if ($reservation->payment_status === 'payed') {
         return response()->json([
             'success' => false,
             'message' => 'Impossible de modifier - réservation déjà payée'
         ], 403);
     }
 
     // Mise à jour des prix
     $reservation->update([
         'price_type' => $validated['price_type'],
         'price_per_day' => $validated['price_per_day'],
         'total_price' => $validated['total_price'],
         'days' => $validated['days']
     ]);
 
     return response()->json([
         'success' => true,
         'price_per_day' => $reservation->price_per_day,
         'total_price' => $reservation->total_price
     ]);
    }
    public function showContrat($id)
{
    $reservation = Reservation::find($id);

    // Vérifier si un conducteur supplémentaire existe et s'il a été ajouté récemment
    $secondDriverAdded = $reservation->second_driver && $reservation->second_driver_added_recently;

    return view('contrat', compact('reservation', 'secondDriverAdded'));
}*/
public function updateManualPrice(Request $request, $id)
{
    $validated = $request->validate([
        'manual_price' => 'required|numeric|min:0',
        'total_price' => 'required|numeric|min:0',
        'days' => 'required|integer|min:1'
    ]);

    $reservation = Reservation::findOrFail($id);

    // Vérification si la réservation est déjà payée
    if ($reservation->payment_status === 'payed') {
        return response()->json([
            'success' => false,
            'message' => 'Impossible de modifier une réservation déjà payée.'
        ], 403);
    }

    // Mise à jour de la réservation
    $reservation->update([
        'price_type' => 'manual',
        'price_per_day' => $validated['manual_price'],
        'total_price' => $validated['total_price'],
        'days' => $validated['days'],
        'manual_price' => true
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Prix manuel mis à jour avec succès.',
        'updatedReservation' => $reservation->fresh()
    ]);
}
public function updatePrice(Request $request, $reservationId)
{
    // Récupérer la réservation
    $reservation = Reservation::findOrFail($reservationId);

    // Mettre à jour le champ manual_price
    $reservation->manual_price = $request->manual_price;  // Mettre à jour manual_price
    $reservation->total_price = $request->total_price;  // Mettre à jour total_price
    $reservation->price_per_day = $request->price_per_day;  // Mettre à jour price_per_day
    $reservation->days = $request->days;  // Mettre à jour le nombre de jours si nécessaire

    // Sauvegarder les modifications
    $reservation->save();

    // Retourner une réponse JSON
    return response()->json(['success' => true]);
}
public function activeDepartures()
{
    $activeDepartures = Reservation::where('status', 'active')
        ->with('car')
        ->orderBy('start_date', 'asc')
        ->get();

    return view('admin.active_departures', ['activeDepartures' => $activeDepartures]);
}

public function verifierCode(Request $request)
{
    $code = $request->input('code');

    // Rechercher la réservation par code
    $reservation = Reservation::where('code', $code)->first();

    if ($reservation) {
        // Rediriger vers la page de détails de la réservation
        return redirect()->route('reservation.show', $reservation->id)
            ->with('success', 'Réservation trouvée.');
    } else {
        // Rediriger avec un message d'erreur si le code n'existe pas
        return back()->with('error', 'Aucune réservation trouvée pour ce code.');
    }
}

public function actives(Request $request)
{
    $query = \App\Models\Reservation::where('status', 'active');

    if ($request->filled('matricule')) {
        $query->whereHas('car', function ($q) use ($request) {
            $q->where('matricule', 'like', '%' . $request->matricule . '%');
        });
    }

    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereDate('start_date', $request->start_date)
              ->whereDate('end_date', $request->end_date);
    } else {
        if ($request->filled('start_date')) {
            $query->whereDate('start_date', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('end_date', $request->end_date);
        }
    }
    $activeDepartures = $query->with('car')->orderBy('start_date', 'asc')->get();

    return view('admin.active_departures', ['activeDepartures' => $activeDepartures]);
}

public function thankyou(Reservation $reservation)
{
	return view('thankyou', compact('reservation'));
}


}
