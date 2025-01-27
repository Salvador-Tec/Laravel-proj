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
    public function __invoke(Request $request)
    {
        // Remplacer User par Client pour récupérer les clients et les admins
        $clients = Client::where('identity_number', 'client')->count();  // Comptage des clients
        $admins = Client::where('identity_number', 'admin')->count();    // Comptage des administrateurs
        
        // Récupération des voitures
        $cars = Car::all();
        
        // Récupération des réservations avec pagination
        //$reservations = Reservation::paginate(8);
        
        $reservations = Reservation::orderBy('created_at' , 'desc')->paginate(10);
        
        
        // Récupération des avatars des clients



        $avatars = Client::all();  // Utilisation de Client pour récupérer les avatars des clients

        // Retourner la vue avec les données
        return view('admin.adminDashboard', compact('clients', 'avatars', 'admins', 'cars', 'reservations'));
    }
}
