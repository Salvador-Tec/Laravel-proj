@extends('layouts.myapp')
@section('content')
    {{-- <div class="flex h-screen bg-gray-50 dark:bg-gray-900 w-10/12" > --}}
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl ">
        <div class="flex flex-col flex-1 w-full">
            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto grid mb-32 ">
                    

                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200 flex items-center justify-between">
    <span>Tableau de bord</span> 



<!-- Search Bar -->
<form action="{{ route('car.search') }}" method="POST" class="flex items-center gap-4">
    @csrf 
    <div class="flex items-center gap-2">
        <!-- Input pour la date -->
        <input type="date" id="search-date" name="date"
            class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-4 py-3 text-lg placeholder:text-sm"
            placeholder="Select a date (MM/DD/YYYY)">

        <!-- Input pour l'heure -->
        <input type="time" id="search-time" name="time"
            class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-4 py-3 text-lg placeholder:text-sm"
            placeholder="Select a time (HH:MM)">
    </div>

    <!-- Bouton de recherche -->
    <button type="submit" class="ml-2 p-2 bg-pr-400 rounded-full text-white hover:bg-pr-500">
        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" fill="currentColor">
            <path d="M505 442.7L405.3 343c28.4-35.3 45.7-80.3 45.7-129 0-114.9-93.1-208-208-208S35 99.1 35 214s93.1 208 208 208c48.7 0 93.7-17.3 129-45.7l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6 0-33.9zM81 214c0-73.4 59.6-133 133-133s133 59.6 133 133-59.6 133-133 133-133-59.6-133-133z" />
        </svg>
    </button>
</form>


                    </h2>

                    

                    <!-- Cards -->
                    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                        <!-- Card -->
                        <a href="{{ route('users') }}">
                            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs hover:bg-pr-200  ">
                                <div class="p-3 mr-4 bg-pr-400 rounded-full ">
                                    <svg style="fill: #fff" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                        </path>
                                    </svg>
                                </div>
                                
                                <div>
                                    <p class="text-lg font-medium text-pr-400 ">
                                        Total clients
                                    </p>
                                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                        {{ $clients + $admins }} (admins: {{ $admins }}) </p>
                                </div>
                            </div>
                        </a>

                        <!-- Card -->
                        <a href="{{ route('cars.index') }}">
                            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs  hover:bg-pr-200 ">
                                <div class="p-3 mr-4 bg-pr-400 rounded-full ">
                                    <svg style="fill: #fff" xmlns="http://www.w3.org/2000/svg" height="1em"
                                        viewBox="0 0 512 512">
                                        <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->

                                        <path
                                            d="M135.2 117.4L109.1 192H402.9l-26.1-74.6C372.3 104.6 360.2 96 346.6 96H165.4c-13.6 0-25.7 8.6-30.2 21.4zM39.6 196.8L74.8 96.3C88.3 57.8 124.6 32 165.4 32H346.6c40.8 0 77.1 25.8 90.6 64.3l35.2 100.5c23.2 9.6 39.6 32.5 39.6 59.2V400v48c0 17.7-14.3 32-32 32H448c-17.7 0-32-14.3-32-32V400H96v48c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32V400 256c0-26.7 16.4-49.6 39.6-59.2zM128 288a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm288 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-lg font-medium text-pr-400 ">
                                    Voitures disponibles
                                    </p>
                                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                        {{ $cars->where('status', 'Available')->count() }}
                                    </p>
                                </div>
                            </div>
                        </a>

                        <!-- Card -->
                        <a href="javascript:void(0);" onclick="scrollToReservatios();">
                            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs  hover:bg-pr-200 ">
                                <div class="p-3 mr-4 bg-pr-400 rounded-full ">
                                    <svg style="fill: #fff" xmlns="http://www.w3.org/2000/svg" height="1em"
                                        viewBox="0 0 512 512">
                                        <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->

                                        <path
                                            d="M184 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H96c-35.3 0-64 28.7-64 64v16 48V448c0 35.3 28.7 64 64 64H416c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H376V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H184V24zM80 192H432V448c0 8.8-7.2 16-16 16H96c-8.8 0-16-7.2-16-16V192zm176 40c-13.3 0-24 10.7-24 24v48H184c-13.3 0-24 10.7-24 24s10.7 24 24 24h48v48c0 13.3 10.7 24 24 24s24-10.7 24-24V352h48c13.3 0 24-10.7 24-24s-10.7-24-24-24H280V256c0-13.3-10.7-24-24-24z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-lg font-medium text-pr-400 ">
                                    Réservations actives
                                    </p>
                                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                        {{ $reservations->where('status', 'Active')->count() }}
                                    </p>
                                    
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="mt-12">
                        <div class="flex align-middle justify-center">
                            <hr class=" mt-8 h-0.5 w-1/2 bg-pr-500">
                            <p class="my-2 mx-8  p-2 font-car font-bold text-gray-600 text-lg ">RESERVATIONS</p>
                            <hr class=" mt-8 h-0.5 w-1/2 bg-pr-500">
                            <hr>
                        </div>

                    </div>

                    <!-- New Table -->
                    <div class="w-full overflow-hidden rounded-lg shadow-xs">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full whitespace-no-wrap overflow-scroll table-auto">
                                <thead>
                                    <tr
                                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                        <th class="px-4 py-3">Client</th>
                                        <th class="px-4 py-3 w-48">Voiture</th>
                                        <th class="px-4 py-3 w-24">Matricule</th>
                                        <th class="px-4 py-3 w-24">Type de boite</th>
                                        <th class="px-4 py-3 w-24">Début à</th>
                                        <th class="px-4 py-3 w-24">Fin à</th>
                                        <th class="px-4 py-3">Durée</th>
                                        <th class="px-4 py-3">Prix</th>
                                        <th class="px-4 py-3">Méthode de paiement</th>
                                        <th class="px-4 py-3" >Statut du paiement</th>
                                        <th class="px-4 py-3">Statut</th>
                                        <th class="px-4 py-3">Actions</th>
                                        <th class="px-4 py-3">Contrat</th>


                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">


                                    @forelse ($reservations as $reservation)
                                        <tr class="text-gray-700 dark:text-gray-400">
                                            

                                            <td class="px-4 py-3"> 
                                                <div class="flex items-center text-sm">
                                                    <div>
                                                        <p class="font-semibold">
                                                        <a href="{{ route('users', ['highlight' => $reservation->identity_number]) }}" 
                                                                class="text-black-500 hover:underline">
                                                            @if ($reservation->first_name && $reservation->last_name)
                                                                    {{ $reservation->first_name }} {{ $reservation->last_name }}
                                                                </a>
                                                            @else
                                                                Aucun client attribué
                                                            @endif
                                                        </p>
                                                        <p class="text-xs text-gray-600 dark:text-gray-400">
                                                            @if ($reservation->mobile_number)
                                                                {{ $reservation->mobile_number }}
                                                            @else
                                                                Aucun numéro de téléphone disponible
                                                            @endif
                                                        </p>
                                                        <p class="text-xs text-gray-600 dark:text-gray-400">
                                                            @if ($reservation->identity_number)
                                                                cin:{{ $reservation->identity_number }}
                                                            @else
                                                                Aucun identité disponible
                                                            @endif
                                                        </p>

                                                    </div>
                                                </div>
                                            </td>
                                            


                                            <td class="px-4 py-3 text-sm">
                                                <a href="{{ route('cars.index', ['highlight' => $reservation->car->id]) }}" class="text-black-500 hover:underline">
                                                {{ $reservation->car->brand }} {{ $reservation->car->model }}

                                            </td>

                                            <td class="px-4 py-3 text-sm"> <!-- Matricule -->
                                                {{ $reservation->car->matricule ?? 'Aucun matricule disponiblee' }}
                                            </td>
                                            <td>
                                            {{ $reservation->car->gearbox_type ?? 'Aucun type de boite disponiblee' }}


                                            </td>

                                            <td class="px-1 py-3  text-sm">
                                                {{ Carbon\Carbon::parse($reservation->start_date)->format('y-m-d') }}
                                                {{ Carbon\Carbon::parse($reservation->delivery_time)->format('H:i') }}
                                             </td>
                                            <td class="px-1 py-3  text-sm">
                                                {{ Carbon\Carbon::parse($reservation->end_date)->format('y-m-d') }}
                                                {{ Carbon\Carbon::parse($reservation->return_time)->format('H:i') }}
                                             </td>
                                            <td class=" text-xs">
                                                <p class="px-4 py-3 text-sm">
                                                    {{ Carbon\Carbon::parse($reservation->end_date)->diffInDays(Carbon\Carbon::parse($reservation->start_date)) }}
                                                    jours </p>
                                            </td>

                                            <td class="px-1 py-3 text-sm">
                                                {{ $reservation->car->price_per_day * $reservation->days }} DT
                                            </td>


                                            <td class="px-0 py-3 text-sm">
                                                @if ($reservation->payment_method == 'TPE')
                                                    <span class="p-1 text-white rounded-md bg-blue-500">{{ $reservation->payment_method }}</span>
                                                @elseif ($reservation->payment_method == 'Cheque')
                                                    <span class="p-1 text-white rounded-md bg-green-500">{{ $reservation->payment_method }}</span>
                                                @elseif ($reservation->payment_method == 'Espèce')
                                                    <span class="p-1 text-white rounded-md bg-yellow-500">{{ $reservation->payment_method }}</span>
                                                @elseif ($reservation->payment_method == 'Virement')
                                                    <span class="p-1 text-white rounded-md bg-purple-500">{{ $reservation->payment_method }}</span>
                                                @else
                                                    <span class="p-0 text-white rounded-md bg-gray-500">Aucune méthode</span>
                                                @endif
                                            </td>
                                            <td class="px-0 py-3 text-sm">
                                                @if ($reservation->payment_status == 'payed')
                                                    <span class="p-1 text-white rounded-md bg-green-500">Payé</span>
                                                @elseif ($reservation->payment_status === 'Partiellement payé')
                                                <span class="p-0.5 text-white rounded-md bg-green-500">{{ $reservation->amount_paid }}</span>
                                                <span class="p-0.5 text-white rounded-md bg-red-500">{{ number_format($reservation->total_price - $reservation->amount_paid, 2) }}</span>


                                                @elseif ($reservation->payment_status == 'non payé')
                                                    <span class="p-1 text-white rounded-md bg-red-500">Non payé</span>
                                                @endif
                                            </td>

                                            <td class="px-4 py-3 text-sm ">
                                                @if ($reservation->status == 'active')
                                                    <span class="p-1 text-white rounded-md bg-green-500 px-2">{{ $reservation->status }}</span>
                                                @elseif ($reservation->status == 'inactive')
                                                    <span class="p-1 text-white rounded-md bg-red-500">{{ $reservation->status }}</span>
                                                @endif
                                            </td>



                                            <td class="px-0 py-6 w-36 text-sm flex flex-col justify-center">

                                                <a class="p-1 mb-4 text-white bg-pr-500 hover:bg-pr-400 font-medium rounded text-center"
                                                    href="{{ route('editStatus', ['reservation' => $reservation->id]) }}">
                                                    <button>Modifier le statut </button>
                                                     <!-- Affichage du bouton de génération de PDF -->
                                                </a>

                                                <a class="p-1 mb-4 text-white bg-indigo-500 hover:bg-indigo-600 font-medium rounded text-center"
                                                    href="{{ route('editPayment', ['reservation' => $reservation->id]) }}">
                                                    <button>Modifier le paiement </button>
                                                </a>

                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                            @if ($reservation->status == 'active')
                                                <!-- Lien pour télécharger le PDF -->
                                                <a href="{{ route('reservation.generatePDF', $reservation->id) }}" 
                                                    id="generate-pdf-link" 
                                                    class="text-red-500 hover:text-red-700">
                                                    <i class="fas fa-file-pdf fa-3x"></i>
                                                </a>                                            
                                                @endif
                                            </td>

                                        </tr>
                                    @empty
                                    @endforelse


                                </tbody>
                            </table>
                        </div>
                        <div class="flex justify-center my-12 w-full">
                            {{ $reservations->links('pagination::tailwind') }}
                        </div>
                    </div>



                </div>
            </main>
        </div>
    </div>
    <script>
        function scrollToReservatios() {
            window.scrollTo({
                top: 300,
                behavior: 'smooth'
            });
        }

    </script>
@endsection