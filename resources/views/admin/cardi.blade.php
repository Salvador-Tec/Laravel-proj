@extends('admin.noname')

@section('content')
<div class="my-20 flex flex-col justify-center items-center mx-auto max-w-screen-xl">

        <!-- Conteneur pour aligner le bouton à gauche et la barre de recherche à droite -->
        <div class="w-full flex justify-between items-center mb-6">
<div class="flex items-center space-x-6">
  <!-- Bouton Ajouter nouvelle voiture -->
  <a href="{{ route('cars.create') }}">
    <button class="bg-pr-400 p-2 text-white drop-shadow-lg hover:bg-pr-600 hover:cursor-pointer rounded-md flex items-center">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
          stroke="currentColor" class="w-8 h-8 inline mr-2">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      Ajouter nouvelle voiture
    </button>
  </a>

  <!-- Bouton Voir le radar -->
  <a href="{{ route('cars.radar') }}"
     role="button"
     class="inline-flex items-center px-4 py-2 bg-pr-400 rounded-md text-white hover:bg-pr-500 transition-colors duration-200"
     title="Voir le radar">
      <svg xmlns="http://www.w3.org/2000/svg" 
           height="1em" 
           viewBox="0 0 512 512" 
           fill="currentColor"
           class="mr-2">
          <path d="M256 8C119.034 8 8 119.033 8 256s111.034 248 248 248 248-111.033 248-248S392.966 8 256 8zm0 448c-110.532 0-200-89.467-200-200S145.468 56 256 56s200 89.467 200 200-89.468 200-200 200zm84.686-175.314C326.43 264.429 293.712 256 256 256v-64c66.274 0 120 53.726 120 120h-35.314z"/>
      </svg>
      Voir le radar
  </a>
</div>

            <!-- Barre de recherche à droite -->
            <form action="{{ route('cars.filter') }}" method="GET" class="flex items-center gap-4">
                @csrf
                <div class="flex items-center gap-2">
                    <!-- Input pour le CIN -->
                    <input type="text" id="matricule" name="matricule" 
                        class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-4 py-3 text-lg placeholder:text-sm"
                        placeholder="Entrez la matricule du voiture" value="{{ request()->input('matricule') }}">
                </div>

                <!-- Bouton de recherche -->
                <button type="submit" class="ml-2 p-3 bg-pr-400 rounded-full text-white hover:bg-pr-500">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" fill="currentColor">
                        <path d="M505 442.7L405.3 343c28.4-35.3 45.7-80.3 45.7-129 0-114.9-93.1-208-208-208S35 99.1 35 214s93.1 208 208 208c48.7 0 93.7-17.3 129-45.7l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6 0-33.9zM81 214c0-73.4 59.6-133 133-133s133 59.6 133 133-59.6 133-133 133-133-59.6-133-133z" />
                    </svg>
                </button>
            </form>
        </div>

        <!-- Tableau des voitures -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mx-2">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Image
                        </th>
                        <th scope="col" class="px-6 py-3">
                        Marque
                        </th>
                        <th scope="col" class="px-6 py-3">
                        Modèle
                        </th>
                        <th scope="col" class="px-6 py-3">
                        société
                        </th>
                        
                        <th scope="col" class="px-6 py-3">
                            Matricule
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Départ
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Retour
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Type Boite
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Moteur
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Prix/j
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Quantité
                        </th>
                        
                        <th scope="col" class="px-6 py-3">
                            réservé
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cars as $car)
                        <tr id="car-{{ $car->id }}" class="{{ $highlight == $car->id ? 'bg-yellow-100' : '' }} bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="w-4 p-4">
                                <div class="p-0.5 rounded-md border-2 border-pr-400 ">
                                    <img loading="lazy" src="{{ asset($car->image) }}" alt="car image">
                                </div>
                            </td>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $car->brand }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $car->model }}
                            </td>
                             <td class="px-6 py-4">
                                {{ $car->nom_societe }}
                            </td>
                           

                            <td class="px-6 py-4">
                                {{ $car->matricule }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $car->pickup_location }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $car->return_location }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $car->gearbox_type }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $car->engine }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $car->price_per_day }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $car->quantity }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $car->status }}
                            </td>
                            <td class="flex my-4 py-3 px-6 space-x-3 items-center">
                                <!-- Bouton Edit -->
                                <a href="{{ route('cars.edit', ['car' => $car->id]) }}" class="p-3 bg-pr-400 rounded-full text-white hover:bg-pr-500" title="Modifier">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" fill="currentColor">
                                        <path d="M362.7 19.3c25.8-25.8 67.6-25.8 93.4 0l36.6 36.6c25.8 25.8 25.8 67.6 0 93.4L184.6 457.3c-4.6 4.6-10.4 8-16.7 9.7l-112 32c-17 4.9-32.7-10.8-27.8-27.8l32-112c1.8-6.3 5.1-12.1 9.7-16.7L362.7 19.3z"/>
                                    </svg>
                                </a>
                            
                                <!-- Bouton Remove -->
                                <form action="{{ route('cars.destroy', ['car' => $car->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-3 bg-pr-400 rounded-full text-white hover:bg-pr-500" title="Supprimer">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512" fill="currentColor">
                                            <path d="M135.2 17.7L121.6 0H64C46.3 0 32 14.3 32 32V64H0V96H448V64H416V32c0-17.7-14.3-32-32-32H326.4L312.8 17.7C308.4 10.3 300.3 0 291.5 0H156.5C147.7 0 139.6 10.3 135.2 17.7zM64 128V432c0 26.5 21.5 48 48 48H336c26.5 0 48-21.5 48-48V128H64zm96 64h32v192H160V192zm96 0h32v192H256V192z"/>
                                        </svg>
                                    </button>
                                </form>
                            
                                <!-- Bouton Date avec DatePicker -->
                                @php
    // Supposons que la voiture a une relation "reservations" et que tu veux récupérer la réservation active
    $activeReservation = $car->reservations->where('status', 'active')->first();
@endphp

<div class="relative">
   
    <!-- Icône de calendrier -->
    <input 
    type="date" 
    id="datepicker-{{ $car->id }}" 
    class="datepicker opacity-0 absolute left-0 top-0 w-full h-full"
    placeholder="Sélectionner une date"
/>

<!-- Icône calendrier cliquable stylisée comme un bouton -->
<div onclick="openDatepicker()" 
    class="cursor-pointer p-3 bg-pr-400 rounded-full text-white hover:bg-pr-500 inline-flex items-center justify-center">
    <svg xmlns="http://www.w3.org/2000/svg" 
        class="h-5 w-5" 
        fill="currentColor" 
        viewBox="0 0 448 512">
        <path d="M152 64V32c0-17.7-14.3-32-32-32s-32 14.3-32 32V64H64C28.7 64 0 92.7 0 128V448c0 35.3 
        28.7 64 64 64H384c35.3 0 64-28.7 64-64V128c0-35.3-28.7-64-64-64H360V32c0-17.7-14.3-32-32-32s-32 
        14.3-32 32V64H152zM64 160H384V448H64V160z"/>
    </svg>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        flatpickr("#datepicker-{{ $car->id }}", {
            disable: [
                {
                    from: "{{ $activeReservation?->start_date }}",
                    to: "{{ $activeReservation?->end_date }}"
                }
            ],
            onDayCreate: function(dObj, dStr, fp, dayElem) {
                const startDateStr = "{{ $activeReservation?->start_date }}";
                const endDateStr = "{{ $activeReservation?->end_date }}";

                if (!startDateStr || !endDateStr) return;

                const startDate = new Date(startDateStr);
                const endDate = new Date(endDateStr);
                const date = new Date(dayElem.dateObj);

                if (date >= startDate && date <= endDate) {
                    dayElem.style.backgroundColor = '#f87171'; // rouge clair
                    dayElem.style.color = 'white';
                    dayElem.style.borderRadius = '50%';
                    dayElem.style.cursor = 'not-allowed';
                    dayElem.setAttribute('title', `Réservé du ${startDateStr} au ${endDateStr}`);
                }
            }
        });
    });
</script>




</div>
                        <a href="{{ route('cars.details', $car->id) }}" 
   class="p-3 bg-pr-400 rounded-full text-white hover:bg-pr-500 transition-colors duration-200"
   title="Voir les détails techniques">
    <svg xmlns="http://www.w3.org/2000/svg" 
         height="1em" 
         viewBox="0 0 448 512" 
         fill="currentColor"
         class="hover:scale-110 transition-transform">
        <path d="M432 256c0 13.3-10.7 24-24 24H272v136c0 13.3-10.7 24-24 24s-24-10.7-24-24V280H88c-13.3 0-24-10.7-24-24s10.7-24 24-24h136V96c0-13.3 10.7-24 24-24s24 10.7 24 24v112h136c13.3 0 24 10.7 24 24z"/>
    </svg>
</a>
<a href="{{ route('admin.voiture', ['id' => $car->id]) }}"  
    class="cursor-pointer p-3 bg-pr-400 rounded-full text-white hover:bg-pr-500 inline-flex items-center justify-center">
     <svg xmlns="http://www.w3.org/2000/svg" 
          class="h-5 w-5" 
          fill="currentColor" 
          viewBox="0 0 576 512">
         <path d="M572.52 241.4C518.38 135.75 407.77 64 288 
         64S57.62 135.75 3.48 241.4a32.07 32.07 0 0 0 0 
         29.2C57.62 376.25 168.23 448 288 448s230.38-71.75 
         284.52-177.4a32.07 32.07 0 0 0 0-29.2zM288 
         400c-61.76 0-112-50.24-112-112s50.24-112 
         112-112 112 50.24 112 112-50.24 112-112 
         112zm0-176a64 64 0 1 0 64 64 64.07 64.07 0 0 0-64-64z"/>
     </svg>
 </a>

 <!-- Icône Radar -->

                            </td>
                            
                            
                            
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const highlightedRow = document.querySelector('tr.bg-yellow-100');
                if (highlightedRow) {
                    highlightedRow.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            });
        </script>

        <style>
            .bg-yellow-100 {
                background-color: #fefcbf; /* Couleur jaune pâle */
            }
        </style>

        <!-- Affichage du message de succès avec SweetAlert -->
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: '{{ session('error') }}',
                    showConfirmButton: false,
                    timer: 3500
                });
            </script>
        @endif
    </div>
    <div class="flex justify-center mb-12 w-full">
        {{ $cars->links('pagination::tailwind') }}
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


@endsection
