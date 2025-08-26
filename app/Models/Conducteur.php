<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conducteur extends Model
{

    use HasFactory;

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
        'driver_license_number', 
        // 'is_secondary_driver',
        'gallery' ,
        //'main_driver_id', // Champ pour identifier le conducteur principal


        'date_of_birth', // Ajout de la date de naissance
        'place_of_birth'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
