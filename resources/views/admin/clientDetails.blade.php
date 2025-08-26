@extends('layouts.myapp')
@section('content')
  <div class="mx-auto max-w-screen-xl">
    <h1 class="text-2xl font-bold mb-6">
      Fiche client : {{ $user->first_name }} {{ $user->last_name }}
    </h1>

    {{-- Détails du client --}}
    <div class="bg-white rounded-md p-6 mb-8 flex md:flex-row flex-col">
      <div class="md:w-1/4 flex justify-center">
        <img src="{{ $user->avatar }}" class="w-32 h-32 object-cover rounded-full" alt="Avatar">
      </div>
      <div class="md:w-3/4 mt-4 md:mt-0 md:pl-6">
        <p><strong>Email :</strong> {{ $user->email }}</p>
        <p><strong>Téléphone :</strong> {{ $user->mobile_number }}</p>
        <p><strong>Adresse :</strong> {{ $user->address }}</p>
        {{-- … autres champs client … --}}
      </div>
    </div>

    {{-- Toutes ses réservations --}}
    <div class="bg-white rounded-md p-6">
      <h2 class="text-xl font-semibold mb-4">Réservations de {{ $user->first_name }}</h2>
      @foreach ($user->reservations as $reservation)
        <div class="mb-6 border p-4 rounded">
          <p><strong>#{{ $reservation->id }}</strong> — {{ $reservation->car->brand }}
            {{ $reservation->car->model }}</p>
          <p>Du {{ $reservation->start_date->format('d/m/Y') }} au
             {{ $reservation->end_date->format('d/m/Y') }} — Statut : {{ $reservation->status }}</p>
          <p>Prix total : {{ number_format($reservation->total_price, 2) }} $</p>
        </div>
      @endforeach
    </div>

    <a href="{{ route('adminDashboard') }}"
       class="inline-block mt-4 px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
      ← Retour au tableau
    </a>
  </div>
@endsection
