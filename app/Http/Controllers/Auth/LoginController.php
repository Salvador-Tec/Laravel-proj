<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Car;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    protected function redirectTo()
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            return RouteServiceProvider::ADMIN;
        }
        return RouteServiceProvider::HOME;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function enterCin($car_id){
        //$car_id = $request->input('car_id');
        //dd($car_id);
        return view('auth.login', ['car_id' => $car_id]);
        
    }

    public function login(Request $request, $car_id = null)
    {
        try {
            // Validation du champ CIN
            $request->validate([
                'identity_number' => 'required|string|max:255',
            ]);
    
            // Vérification de car_id dans l'URL
            $car_id = $car_id ?? $request->input('car_id'); 
    
            // Vérification si car_id est présent
            if (!$car_id) {
                return back()->with('error', 'car_id est manquant.');
            }
    
            // Récupérer la voiture par car_id
            $car = Car::find($car_id); 
    
            if (!$car) {
                return back()->with('error', 'La voiture spécifiée est introuvable.');
            }
    
            // Récupérer le numéro d'identité
            $identityNumber = $request->input('identity_number');
            
            // Stocker le numéro d'identité dans la session
            session(['identity_number' => $identityNumber]);
    
            // Récupérer les dates de début et de fin (elles peuvent être envoyées via la requête ou la session)
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
            $delivery_time = $request->input('delivery_time');
            $return_time = $request->input('return_time');
            
            // Stocker les dates dans la session pour y accéder dans la vue de création
            session([
                'start_date' => $start_date,
                'end_date' => $end_date,
                'delivery_time' => $delivery_time,
                'return_time' => $return_time,
            ]);
    
            // Recherche d'une réservation existante avec le CIN
            $client = Client::where('identity_number', $identityNumber)->first();
            $reservation = Reservation::where('identity_number', $identityNumber)->first();
    
            // Quel que soit le cas (existant ou non), aller vers le formulaire de création pré-rempli
            return redirect()->route('reservations.create', ['car_id' => $car->id]);
        } catch (\Exception $e) {
            return back()->withError('Une erreur est survenue. Veuillez réessayer plus tard.')->withInput();
        }
    }


    

}

