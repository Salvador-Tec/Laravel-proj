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
                <p><span class="font-medium">Date CIN:</span> 
                    @isset($client->identity_date)
                        {{ \Carbon\Carbon::parse($client->identity_date)->format('d/m/Y') }}
                    @else
                        Non renseignée
                    @endisset
                </p>
                <p><span class="font-medium">Permis de conduire:</span> {{ $client->driver_license_number ?? 'Non renseigné' }}</p>
                <p><span class="font-medium">Date permis:</span> 
                    @isset($client->license_date)
                        {{ \Carbon\Carbon::parse($client->license_date)->format('d/m/Y') }}
                    @else
                        Non renseignée
                    @endisset
                </p>
                <p><span class="font-medium">Adresse:</span> {{ $client->address ?? 'Non renseignée' }}</p>
                <p><span class="font-medium">Téléphone:</span> {{ $client->mobile_number ?? 'Non renseigné' }}</p>
            </div>
        </div>
    </div>

    <!-- Statistiques des réservations -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h3 class="text-xl font-semibold mb-4">Statistiques des Réservations</h3>
        <div class="flex flex-wrap items-center justify-between gap-4">
            <!-- Total Réservations -->
            <div class="flex items-center space-x-3 bg-blue-50 p-3 rounded-lg min-w-[180px]">
                <div class="bg-blue-100 p-2 rounded-full">
                    <i class="fas fa-calendar-alt text-blue-600"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-blue-800">Total réservations</p>
                    <p class="text-xl font-bold">{{ $allReservations->count() }}</p>
                </div>
            </div>

            <!-- Contrats Actifs -->
            <div class="flex items-center space-x-3 bg-green-50 p-3 rounded-lg min-w-[180px]">
                <div class="bg-green-100 p-2 rounded-full">
                    <i class="fas fa-check-circle text-green-600"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-green-800">Contrats actifs</p>
                    <p class="text-xl font-bold">{{ $allReservations->where('payment_status', 'payed')->count() }}</p>
                </div>
            </div>

            <!-- Montant Total -->
            <div class="flex items-center space-x-3 bg-purple-50 p-3 rounded-lg min-w-[180px]">
                <div class="bg-purple-100 p-2 rounded-full">
                    <i class="fas fa-coins text-purple-600"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-purple-800">Montant Total</p>
                    <p class="text-xl font-bold">{{ $allReservations->sum('total_price') }} DT</p>
                </div>
            </div>

           <!-- Montant Payé -->
        <!-- Montant Payé -->
<div class="flex items-center space-x-3 bg-orange-50 p-3 rounded-lg min-w-[180px]">
    <div class="bg-orange-100 p-2 rounded-full">
        <i class="fas fa-money-bill-wave text-green-600"></i> <!-- Icône en vert -->
    </div>
    <div>
        <p class="text-sm font-medium text-orange-800">Montant Payé</p>
        <p class="text-xl font-bold text-green-600">{{ $allReservations->sum('amount_paid') }} DT</p> <!-- Montant en vert -->
    </div>
</div>



            <!-- Montant Crédit -->
            <div class="flex items-center space-x-3 bg-red-50 p-3 rounded-lg min-w-[180px]">
                <div class="bg-red-100 p-2 rounded-full">
                    <i class="fas fa-exclamation-triangle text-red-600"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-red-800">Montant non payé</p>
                    <p class="text-xl font-bold text-red-600">
                        {{ $allReservations->sum('total_price') - $allReservations->sum('amount_paid') }} DT
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Historique des réservations -->
    @if($allReservations->count() > 0)
        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-xl font-semibold mb-4">Historique des Réservations</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2 px-4 border">Client</th>
                            <th class="py-2 px-4 border">Rôle</th>
                            <th class="py-2 px-4 border">Voiture</th>
                            <th class="py-2 px-4 border">Dates</th>
                            <th class="py-2 px-4 border">Heures</th>
                            <th class="py-2 px-4 border">Durée</th>
                            <th class="py-2 px-4 border">Prix/Jour</th>
                            <th class="py-2 px-4 border">Total</th>
                            <th class="py-2 px-4 border">Montant Payé</th>
                            <th class="py-2 px-4 border">Statut Paiement</th>
                            <th class="py-2 px-4 border">Méthode</th>
                            <th class="py-2 px-4 border">Statut</th>
                            <th class="py-2 px-4 border">Autre Conducteur</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allReservations as $reservation)
                        <tr>
                            <td class="py-2 px-4 border">
                                {{ $client->first_name }} {{ $client->last_name }}
                            </td>
                            <td class="py-2 px-4 border">
                                @if($reservation->identity_number == $client->identity_number)
                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">Principal</span>
                                @else
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Secondaire</span>
                                @endif
                            </td>
                            <td class="py-2 px-4 border">
                                {{ $reservation->car->brand ?? 'N/A' }} {{ $reservation->car->model ?? '' }}
                            </td>
                            <td class="py-2 px-4 border">
                                {{ \Carbon\Carbon::parse($reservation->start_date)->format('d/m/Y') }}<br>
                                {{ \Carbon\Carbon::parse($reservation->end_date)->format('d/m/Y') }}
                            </td>
                            <td class="py-2 px-4 border">
                                {{ \Carbon\Carbon::parse($reservation->delivery_time)->format('H:i') }}<br>
                                {{ \Carbon\Carbon::parse($reservation->return_time)->format('H:i') }}
                            </td>
                            <td class="py-2 px-4 border">{{ $reservation->days }} jours</td>
                            <td class="py-2 px-4 border">{{ $reservation->price_per_day }} DT</td>
                            <td class="py-2 px-4 border">{{ $reservation->total_price }} DT</td>
                            <td class="py-2 px-4 border">{{ $reservation->amount_paid ?? '0' }} DT</td>
                            <td class="py-2 px-4 border">
                                <span class="px-2 py-1 rounded-full text-xs 
                                    {{ $reservation->payment_status === 'payed' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $reservation->payment_status }}
                                </span>
                            </td>
                            <td class="py-2 px-4 border">{{ $reservation->payment_method }}</td>
                            <td class="py-2 px-4 border">{{ $reservation->status }}</td>
                            <td class="py-2 px-4 border">
                                @if($reservation->identity_number == $client->identity_number && $reservation->first_name_conducteur)
                                    {{ $reservation->first_name_conducteur }} {{ $reservation->last_name_conducteur }}
                                @elseif($reservation->identity_number != $client->identity_number)
                                    {{ $reservation->first_name }} {{ $reservation->last_name }}
                                @else
                                    Non
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="bg-white shadow-md rounded-lg p-6">
            <p class="text-gray-500">Aucune réservation trouvée pour ce client.</p>
        </div>
    @endif
</div>
@endsection