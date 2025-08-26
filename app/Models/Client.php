<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    // Déclarez les colonnes autorisées pour l'insertion en masse
    protected $fillable = [
        'first_name',
        'last_name',
        'identity_number',
        'driver_license_number',
        'address',
        'nationality',
        'mobile_number',
        'identity_date',
        'license_date',
         //'is_secondary_driver',
        'gallery' ,
        //'main_driver_id', // Champ pour identifier le conducteur principal


        'date_of_birth', // Ajout de la date de naissance
        'place_of_birth',
        'first_name_conducteur',
        'last_name_conducteur',
        'identity_number_conducteur',
        'driver_license_number_conducteur',
        'address_conducteur',
        'nationality_conducteur',
        'mobile_number_conducteur',
        'identity_date_conducteur',
        'license_date_conducteur',
        'date_of_birth_conducteur',
        'place_of_birth_conducteur',
        'gallery_conducteur',
        'is_blocked',

    ];
   
    public function dashboard()
    {
        $clients = Client::all();
        return view('admin.dashboard', compact('clients'));

    }
   

    
    

        public function getClientWithReservationAndContractCounts()
        {
            $data = $this->only($this->fillable);
            
            $data['reservations_count'] = $this->reservations()->count();
            $data['contracts_count'] = $this->reservations()
                                           ->where('payment_status', 'payed')
                                           ->count();
            $data['reservations'] = $this->reservations()->with('car')->get();
            
            return $data;
        }
    

        public function reservationss()
{
    return $this->hasMany(Reservation::class, 'user_id'); // Ou 'client_id' selon votre schéma
}
        public function reservations()
        {
            return $this->hasMany(Reservation::class, 'identity_number', 'identity_number');
        }   
    
    
      
    }

    

