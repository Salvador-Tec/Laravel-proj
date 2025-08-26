<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entretien extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'kilometrage',
        'type_entretien',
        'date_entretien',
        'date_visite',
        'jours_restants',
        'remarque',
        'date_prochain_entretien',
        'kilometrage_prochain_entretien',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}