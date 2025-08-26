@extends('admin.noname')

@section('content')

@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Aucune voiture disponible.',
            text: '{{ session('error') }}',
            showConfirmButton: false, 
            timer: 3000

        });
    </script>
@endif
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Vérifier si le message popup est défini
        @if(session('popup_message'))
            Swal.fire({
                title: 'Désolé !',
                text: "{{ session('popup_message') }}",
                icon: 'warning',
                confirmButtonText: 'OK'
            });
        @endif
    </script>

         <!-- Formulaire de recherche avec deux dates et deux heures -->
         <div class="bg-gray-200 mx-auto max-w-screen-2xl mt-10 p-6 rounded-md shadow-xl">
    <form action="{{route('cars.available')}}" method="GET">
        <!-- Section des filtres -->
        <div class="flex justify-center md:flex-row flex-col md:gap-28 gap-4">
            <!-- Champs des dates et heures -->
            <div class="flex justify-evenly md:flex-row flex-col md:gap-16 gap-2">
                <div>
                    <label for="pickup_location" class="block text-sm text-gray-700">Départ</label>
                    <select name="pickup_location" id="pickup_location"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6"

                        required>
                        <option value="">-- un lieu -- </option>
                        <option value="Tunis">Tunis</option>
                        <option value="Sfax">Sfax</option>
                        <option value="Sousse">Sousse</option>
                        <option value="Djerba">Djerba</option>
                        <option value="Tunis">Gasserine</option>
                        <option value="Sfax">Nabeul</option>
                        <option value="Sousse">Mahdia</option>
                        <option value="Djerba">Gabes</option>
                        <!-- Ajoute d'autres lieux si nécessaire -->
                    </select>
                </div>
                
                <div>
                    <label for="return_location" class="block text-sm text-gray-700">Restitution</label>
                    <select name="return_location" id="return_location"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6"
                        required>
                        <option value="">-- un lieu -- </option>
                        <option value="Tunis">Tunis</option>
                        <option value="Sfax">Sfax</option>
                        <option value="Sousse">Sousse</option>
                        <option value="Djerba">Djerba</option>
                        <option value="Tunis">Gasserine</option>
                        <option value="Sfax">Nabeul</option>
                        <option value="Sousse">Mahdia</option>
                        <option value="Djerba">Gabes</option>
                        <!-- Ajoute d'autres lieux si nécessaire -->
                    </select>
                </div>
                <!-- Champ Date de début -->
                <div>
                    <label for="start_date" class="block text-sm text-gray-700">Date Début</label>
                    <input type="date" name="start_date" id="start_date" 
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6"
                        required>
                </div>
                <!-- Champ Heure de début -->
                <div>
                    <label for="delivery_time" class="block text-sm text-gray-700">Heure Début</label>
                    <input 
                        type="time" 
                        id="delivery-time" 
                        name="delivery_time" 
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6"
                        required
                        onchange="syncReturnTime()">
                </div>
                <!-- Champ Date de fin -->
                <div>
                    <label for="end_date" class="block text-sm text-gray-700">Date Fin</label>
                    <input type="date" name="end_date" id="end_date" 
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6"
                        required>
                </div>
                <!-- Champ Heure de fin -->
                <div>
                    <label for="return_time" class="block text-sm text-gray-700">Heure Fin</label>
                    <input 
                        type="time" 
                        id="return-time" 
                        name="return_time" 
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6"
                        required
                        readonly>
                </div>
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Type Boîte</label>
                    <div class="flex gap-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="gearbox_type[]" value="manuelle" class="form-checkbox text-pr-400">
                            <span class="ml-2 text-gray-700">Manuelle</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="gearbox_type[]" value="Automatique" class="form-checkbox text-pr-400">
                            <span class="ml-2 text-gray-700">Automatique</span>
                        </label>
                    </div>
                </div>

            </div>
            <button class="bg-pr-400 rounded-md text-white p-2 w-25 font-medium hover:bg-pr-500" type="submit" placeholder="brand"> Rechercher</button>

        </div>
    </div>


<script>
                                    function syncReturnTime() {
                                    // Synchroniser le temps de retour avec celui de la livraison
                                        var deliveryTime = document.getElementById('delivery-time').value;
                                        document.getElementById('return-time').value = deliveryTime;
                                    }
                                </script>

<div class="grid md:grid-cols-3 md:ps-4 justify-center p-2 gap-4 items-center mx-auto max-w-screen-xl">
    @foreach ($cars as $car)
        <div
            class="relative md:m-10 flex w-full max-w-xs flex-col overflow-hidden rounded-lg border border-gray-100 bg-white shadow-md">
            <a class="relative mx-3 mt-3 flex h-60 overflow-hidden rounded-xl">
                <img loading="lazy" class="object-cover" src="{{ asset('storage/' . $car->image) }}" alt="product image" />
                <span
                    class="absolute top-0 left-0 m-2 rounded-full bg-pr-400 px-2 text-center text-sm font-medium text-white">
                    {{ $car->reduce }} % de réduction
                </span>
            </a>
            <div class="mt-4 px-5 pb-5">
                <div>
                    <h5 class="font-bold text-xl tracking-tight text-slate-900">
                        {{ $car->brand }} {{ $car->model }} {{ $car->engine }}
                    </h5>
                </div>
                <p class="mt-2 text-sm text-gray-700">
                    <strong>Type de boîte :</strong> {{ $car->gearbox_type }}
                </p>
                <div class="mt-2 mb-5 flex items-center justify-between">
                    <p>
                        <span class="text-3xl font-bold text-slate-900">{{ $car->price_per_day }}DT/jour</span>
                        <span
                            class="text-sm text-slate-900 line-through">{{ intval(($car->price_per_day * 100) / (100 - $car->reduce)) }}DT
                        </span>
                    </p>
                    <div class="flex items-center">
                        @for ($i = 0; $i < $car->stars; $i++)
                            <svg aria-hidden="true" class="h-5 w-5 text-pr-300" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                        @endfor
                        <span
                            class="mr-2 ml-3 rounded bg-pr-300 px-2.5 py-0.5 text-xs font-semibold">{{ $car->stars }}.0</span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
    <div class="flex justify-center mb-12 w-full">
        {{ $cars->links('pagination::tailwind') }}
    </div>
@endsection