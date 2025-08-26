<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CallendrierController extends Controller
{

    public function showCalendrier()
{
    $cars = Car::with('reservations')->get(); // Charge les voitures avec leurs réservations
    return view('admin.calendrier', compact('cars'));
}



}