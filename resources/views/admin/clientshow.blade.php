@extends('layouts.myapp')

@section('content')
<div class="container mx-auto mt-8">
    <h2 class="text-2xl font-bold mb-6">Détails du Client</h2>

    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Informations personnelles -->
            <div>
                <h3 class="text-xl font-semibold mb-4">Informations Personnelles</h3>
                <p><span class="font-medium">Nom:</span> {{ $client->last_name ?? 'Non renseigné' }}</p>
                <p><span class="font-medium">Prénom:</span> {{ $client->first_name ?? 'Non renseigné' }}</p>
                <p><span class="font-medium">Date de Naissance:</span> 
                    @isset($client->date_of_birth)
                        {{ \Carbon\Carbon::parse($client->date_of_birth)->format('d/m/Y') }}
                    @else
                        Non renseignée
                    @endisset
                </p>
                <p><span class="font-medium">Lieu de Naissance:</span> {{ $client->place_of_birth ?? 'Non renseigné' }}</p>
                <p><span class="font-medium">Nationalité:</span> {{ $client->nationality ?? 'Non renseignée' }}</p>
            </div>

            <!-- Informations d'identification -->
            <div>
                <h3 class="text-xl font-semibold mb-4">Identité</h3>
                <p><span class="font-medium">CIN:</span> {{ $client->identity_number ?? 'Non renseigné' }}</p>
                <p><span class="font-medium">Permis de conduire:</span> {{ $client->driver_license_number ?? 'Non renseigné' }}</p>
                <p><span class="font-medium">Adresse:</span> {{ $client->address ?? 'Non renseignée' }}</p>
                <p><span class="font-medium">Téléphone:</span> {{ $client->mobile_number ?? 'Non renseigné' }}</p>
            </div>
        </div>
    </div>

    <!-- Statistiques des réservations -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h3 class="text-xl font-semibold mb-4">Statistiques des Réservations</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-blue-50 p-4 rounded-lg">
                <p class="text-lg font-medium text-blue-800">Total Réservations</p>
                <p class="text-3xl font-bold">{{ $client->reservations->count() }}</p>
            </div>
            <div class="bg-green-50 p-4 rounded-lg">
                <p class="text-lg font-medium text-green-800">Contrats Payés</p>
                <p class="text-3xl font-bold">{{ $client->reservations->where('payment_status', 'Partiellement payé')->count() }}</p>
            </div>
            <div class="bg-yellow-50 p-4 rounded-lg">
                <p class="text-lg font-medium text-yellow-800">Taux de Conversion</p>
                <p class="text-3xl font-bold">
                    @if($client->reservations->count() > 0)
                        {{ round(($client->reservations->where('payment_status', 'Partiellement payé')->count() / $client->reservations->count()) * 100) }}%
                    @else
                        0%
                    @endif
                </p>
            </div>
        </div>
    </div>

    <!-- Historique des réservations -->
    @if($client->reservations->count() > 0)
        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-xl font-semibold mb-4">Historique des Réservations</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2 px-4 border">Voiture</th>
                            <th class="py-2 px-4 border">Dates</th>
                            <th class="py-2 px-4 border">Prix</th>
                            <th class="py-2 px-4 border">Statut Paiement</th>
                            <th class="py-2 px-4 border">Statut Réservation</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($client->reservations as $reservation)
                        <tr>
                            <td class="py-2 px-4 border">{{ $reservation->car->brand ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border">
                                {{ \Carbon\Carbon::parse($reservation->start_date)->format('d/m/Y') }} - 
                                {{ \Carbon\Carbon::parse($reservation->end_date)->format('d/m/Y') }}
                            </td>
                            <td class="py-2 px-4 border">{{ $reservation->total_price }} €</td>
                            <td class="py-2 px-4 border">
                                <span class="px-2 py-1 rounded-full text-xs 
                                    {{ $reservation->payment_status === 'payed' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $reservation->payment_status }}
                                </span>
                            </td>
                            <td class="py-2 px-4 border">{{ $reservation->status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection