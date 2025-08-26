<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisiteTechnique extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'jours_restants',
        'date_visite',
        'kilometrage',
        'date_prochain_visite',
        'remarque',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}