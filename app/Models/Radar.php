<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Radar extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'matricule',
        'modele',
        'date_infraction',
        'date_traitement',
        'numero_contrat',
        'traite', // boolean
    ];

    protected $casts = [
        'traite' => 'boolean',
        'date_infraction' => 'date',
        'date_traitement' => 'date',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}