<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    /**
     * Les attributs pouvant être remplis en masse.
     *
     * @var array
     */
    protected $fillable = [
        'brand',
        'model',
        'engine',
        'quantity',
        'price_per_day',
        'reduce_percent',
        'stars',
        'matricule',
        'gearbox_type',
        'cover_photo',
        'status',
    ];

    /**
     * Relation avec les réservations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Les attributs qui devraient être castés.
     *
     * @var array
     */
    protected $casts = [
        'reduce_percent' => 'float',
        'price_per_day' => 'float',
        'stars' => 'integer',
        'status' => 'boolean',
    ];
}
