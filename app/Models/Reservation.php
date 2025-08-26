<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservation extends Model
{
    use HasFactory;

    // Nom de la table (si nécessaire)
    protected $table = 'reservations';

    //protected $dates = ['start_date', 'end_date']; // Assurez-vous que ces champs sont des dates

    protected $fillable = [
        'first_name', 
        'last_name', 
        'nationality', 
        'identity_number', 
        'driver_license_number', 
        'address', 
        'mobile_number', 
        'gallery', 
        //'reservation_dates', 
        'delivery_time', 
        'return_time',
        'user_id', 
        'car_id', 
        'start_date', 
        'end_date', 
        'days', 
        'price_per_day', 
        'total_price', 
        'status', 
        'payment_method', 
        'second_driver_id',
        'payment_status',
        'amount_paid',
        'identity_date',
        'license_date',
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
    'manual_price',
     'garantie',
    // ✅ Ajout des nouveaux attributs
    'numero_vol',
    'avec_chauffeur',
    'siege_bebe',
     'code', // <-- ajout ici

    



    ];

    // Si vous utilisez des dates comme delivery_time, return_time, vous pouvez définir ces attributs comme des objets Carbon.
    protected $dates = [ 
        'delivery_time',
        'return_time',
        'start_date',
        'end_date',
    ];

    // Convertir la colonne gallery en tableau pour faciliter la gestion des images (stockées sous forme de JSON)
    protected $casts = [
        'gallery' => 'array',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    // app/Models/Reservation.php
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Méthode pour obtenir les images de la galerie et générer les liens
    public function getGalleryLinksAttribute()
    {
        // Si la galerie contient des images, générer les liens
        if ($this->gallery && count($this->gallery) > 0) {
            return array_map(function ($image) {
                return asset('storage/' . $image); // Lien vers le dossier storage
            }, $this->gallery);
        }

        return [];
    }

    public function secondDriver()
    {
        return $this->belongsTo(Client::class, 'second_driver_id');
    }
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
    public function showCarReservations($carId)
{
    // Récupérer les informations de la voiture
    $car = Car::find($carId);

    // Récupérer les réservations actives pour cette voiture
    $activeReservations = Reservation::where('car_id', $car->id)
                                      ->where('status', 'active')
                                      ->get();

    // Passer les réservations actives à la vue
    return view('admin.cars', compact('car', 'activeReservations'));
}

    
}
