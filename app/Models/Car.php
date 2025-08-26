<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'engine',
        'quantity',
        'price_per_day',
        'seasonal_price',  // Ajouté
        'summer_price',   // Ajouté
        'reduce',
        'stars',
        'matricule',
        'gearbox_type',
        'pickup_location',
        'return_location',
        'cover_photo',
        'status',
         'numero_serie',              // Ajouté
        'date_dpme',                 // Ajouté
        'date_dde',                  // Ajouté
        'date_echeance_leasing',    // Ajouté
        'etat_echeance_leasing',    // Ajouté
        'reglement',                // Ajouté
        'nom_societe',              // Ajouté
        'image',
    ];

    protected $casts = [
        'reduce_percent' => 'float',
        'price_per_day' => 'float',
        'seasonal_price' => 'float',  // Ajouté
        'summer_price' => 'float',    // Ajouté
        'stars' => 'integer',
        'status' => 'string',
         'date_dpme' => 'date',               // Ajouté
        'date_dde' => 'date',                // Ajouté
        'date_echeance_leasing' => 'date',   // Ajouté
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // Méthode utilitaire pour obtenir le prix selon le type
    public function getPriceByType($type)
    {
        return match($type) {
            'seasonal' => $this->seasonal_price,
            'estimated' => $this->estimated_price,
            'summer' => $this->summer_price,
            default => $this->price_per_day,
        };
    }

    public function isActive()
    {
        return $this->status === true;
    }

    // Récupérer les réservations actives avec leurs dates de début et fin
    public function activeReservations()
    {
        return $this->reservations()
                    ->where('status', 'active')  // Vérifie que la réservation est active
                    ->get(['start_date', 'end_date']);
    }
    
    public function entretiens()
    {
        return $this->hasMany(Entretien::class);
    }
    
    public function assurances()
    {
        return $this->hasMany(Assurance::class);
    }
    
    public function visitesTechniques()
    {
        return $this->hasMany(VisiteTechnique::class);
    }
    public function radars()
    {
        return $this->hasMany(Radar::class);
    }
    public function societe()
{
    return $this->belongsTo(Societe::class);
}

}