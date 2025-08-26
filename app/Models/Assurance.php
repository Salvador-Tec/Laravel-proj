<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assurance extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'marque',
        'model',
        'nom',              // nom de l'assurance
        'date_debut',       // date début de l'assurance
        'date_fin',         // date fin de l'assurance
        'montant',          // montant de l'assurance
        'jours_restants',   // jours restants de validité
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}