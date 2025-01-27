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
        'gallery' 

    ];
}
