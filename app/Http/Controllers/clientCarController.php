<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class clientCarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::where('status', '=', 'available')->paginate(9);
        return view('cars.cars', compact('cars'));
    }
    public function cardi(Request $request)
{
    $cars = Car::latest()->paginate(8);
    $highlight = $request->input('highlight'); // ID de la voiture à mettre en surbrillance

    return view('admin.cardi', compact('cars', 'highlight'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
