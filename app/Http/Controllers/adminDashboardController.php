<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;  // Import du modèle Client
use App\Models\Car;
use App\Models\Reservation;
use Carbon\Carbon;

class adminDashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */

public function reservationsImpayees()
{
    $reservations = Reservation::whereIn('payment_status', ['non payé'])->orderBy('created_at', 'desc')->get();

    return view('admin.reservations_impayees', compact('reservations'));
}



    public function __invoke(Request $request)
{       $filter = $request->query('filter');

    // Compter uniquement les clients
    $clients = Client::where('identity_number', '!=', '0000')->count();
    $activeCount = Reservation::active()->count();
    $reservations = Reservation::whereIn('payment_status', ['non payé'])->get();
     if ($filter === 'non-paye') {
        // On filtre uniquement les réservations non payées
        $reservations = Reservation::where('payment_status', 'non payé')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    } else {
        // Sinon on affiche toutes les réservations paginées
        $reservations = Reservation::orderBy('created_at', 'desc')->paginate(10);
    }




    // Autres données
    $cars = Car::all();
    $reservations = Reservation::orderBy('created_at', 'desc')->paginate(10);
    $avatars = Client::all();

    return view('admin.adminDashboard', compact('clients', 'cars', 'reservations', 'avatars'));
}

    public function afficherFormulaire($id)
{
    $reservation = Reservation::findOrFail($id);
    return view('admin.formulaire', compact('reservation'));
}
public function index()
{
    // logiques nécessaires pour afficher les données du dashboard
    return view('adminDashboard');
}
public function update(Request $request, $id)
{
    // Validation des données
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'car_brand' => 'required|string|max:255',
        //'car_matricule' => 'required|string|max:255',
        'gearbox_type' => 'required|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'payment_method' => 'nullable|string|max:255',
        'payment_status' => 'required|string',
        'status' => 'required|string',
    ]);

    // Récupérer la réservation
    $reservation = Reservation::findOrFail($id);

    // Mettre à jour les informations
    $reservation->first_name = $request->input('first_name');
    $reservation->last_name = $request->input('last_name');
    $reservation->car->brand = $request->input('car_brand');
    //$reservation->car->matricule = $request->input('car_matricule');
    $reservation->car->gearbox_type = $request->input('gearbox_type');
    $reservation->start_date = $request->input('start_date');
    $reservation->end_date = $request->input('end_date');
    $reservation->payment_method = $request->input('payment_method');
    $reservation->payment_status = $request->input('payment_status');
    $reservation->status = $request->input('status');

    // Sauvegarder les modifications
    $reservation->save();
    $reservation->car->save(); // Assurez-vous de sauvegarder aussi les modifications liées à la voiture.

    // Redirection vers le tableau de bord avec un message de succès
    return redirect()->route('admin.formulaire', ['id' => $id])
    ->with('success', 'Réservation mise à jour avec succès');
}

public function formulaire(Request $request, $id)
{
    $reservation = Reservation::findOrFail($id);

    if ($request->isMethod('post')) {
        $reservation->update($request->all());

        return back()->with('success', 'Réservation mise à jour avec succès.');
    }

    return view('admin.formulaire', compact('reservation'));
}
public function showContrat($id)
{
    // Récupérer la réservation avec ses relations
    $reservation = Reservation::with('car')->findOrFail($id);

    // Retourner la vue avec les détails de la réservation
    return view('admin.contrat', compact('reservation'));
}
public function activeDepartures()
{
    $activeDepartures = Reservation::with('car')
        ->where('status', 'active')
        ->get();

    return view('admin.active_departures', compact('activeDepartures'));
}





}
