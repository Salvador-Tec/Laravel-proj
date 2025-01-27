@extends('layouts.myapp')
@section('content')
    <div class="mx-auto max-w-screen-xl bg-white rounded-md p-6 m-8">
        <div class="flex justify-between md:flex-row flex-col">
            {{-- -------------------------------------------- left -------------------------------------------- --}}
            <div class="md:w-2/3  md:border-r border-gray-800 p-2">

                <h2 class=" ms-4 max-w-full font-car md:text-6xl text-4xl">{{ $car->brand }} {{ $car->model }}
                    {{ $car->engine }}
                </h2>

                <div class="flex items-end mt-8 ms-4">
                    <h3 class="font-car text-gray-500 text-2xl">Prix:</h3>
                    <p>
                        <span
                            class=" text-3xl font-bold text-pr-400 ms-3 me-1 border border-pr-400 p-2 rounded-md">{{ $car->price_per_day }}
                            DT</span>
                        <span
                            class="text-lg font-medium text-red-500 line-through">{{ intval(($car->price_per_day * 100) / (100 - $car->reduce)) }}
                            DT</span>
                    </p>
                </div>

                <div class="flex items-center justify-around mt-10 me-10">
                    <div class="w-1/5 md:w-1/3 h-[0.25px] bg-gray-500 "> </div>
                    <p>Informations sur la commande</p>
                    <div class="w-1/5 md:w-1/3 h-[0.25px] bg-gray-500 "> </div>

                </div>

                <div class="px-6 md:me-8">
                    <form action="{{ route('reservation.store', ['car_id' => $car->id]) }}" method="POST" enctype='multipart/form-data'>

                        @csrf
                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                            {{-- Champ pour Nom --}}
                            <div class="sm:col-span-3">
                                <label for="first_name" class="block text-sm font-medium leading-6 text-gray-900">Nom</label>
                                <div class="mt-2">
                                    <input type="text" name="first_name" id="first_name"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                                </div>
                                @error('first_name')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Champ pour Prénom --}}
                            <div class="sm:col-span-3">
                                <label for="last_name" class="block text-sm font-medium leading-6 text-gray-900">Prénom</label>
                                <div class="mt-2">
                                    <input type="text" name="last_name" id="last_name"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                                </div>
                                @error('last_name')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Champ pour Nationalité --}}
                            <div class="sm:col-span-full">
                                <label for="nationality" class="block text-sm font-medium leading-6 text-gray-900">Nationalité</label>
                                <div class="mt-2">
                                    <input type="text" name="nationality" id="nationality" value="{{ old('nationality') }}"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                                </div>
                                @error('nationality')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Identity Card Number --}}
                            <div class="sm:col-span-3">
                                <label for="identity_number" class="block text-sm font-medium leading-6 text-gray-900">Numéro de carte d'identité</label>
                                <div class="mt-2">
                                    <input type="text" name="identity_number" id="identity_number" value="{{ old('identity_number', $identityNumber) }}"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6" required>
                                </div>
                                @error('identity_number')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Date d'identité' --}}
                            <div class="sm:col-span-3">
                                <label for="identity_date" class="block text-sm font-medium leading-6 text-gray-900">Date d'identité</label>
                                <div class="mt-2">
                                    <input type="date" name="identity_date" id="identity_date"
                                        value=""
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                                </div>
                            </div>


                            {{-- Driver's License Number --}}
                            <div class="sm:col-span-3">
                                <label for="driver_license_number" class="block text-sm font-medium leading-6 text-gray-900">Numéro de permis de conduire</label>
                                <div class="mt-2">
                                    <input type="text" name="driver_license_number" id="driver_license_number"
                                        value="{{ old('driver_license_number') }}"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                                </div>
                                @error('driver_license_number')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                           {{-- Date de permis --}}
                            <div class="sm:col-span-3">
                                <label for="license_date" class="block text-sm font-medium leading-6 text-gray-900">Date de permis</label>
                                <div class="mt-2">
                                    <input type="date" name="license_date" id="license_date"
                                        value=""
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                                </div>
                            </div>


                            {{-- Address --}}
                            <div class="sm:col-span-6">
                                <label for="address" class="block text-sm font-medium leading-6 text-gray-900">Adresse</label>
                                <div class="mt-2">
                                    <input type="text" name="address" id="address" value="{{ old('address') }}"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                                </div>
                                @error('address')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Mobile Number --}}
                            <div class="sm:col-span-full">
                                <label for="mobile_number" class="block text-sm font-medium leading-6 text-gray-900">Numéro de téléphone</label>
                                <div class="mt-2">
                                    <input type="text" name="mobile_number" id="mobile_number" value="{{ old('mobile_number') }}"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                                </div>
                                @error('mobile_number')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- File Upload for ID Card and Driver License --}}
                            <div class="sm:col-span-full">
    <label for="gallery" class="block text-sm font-medium leading-6 text-gray-900">Télécharger carte d'identité et permis de conduire (recto et verso)
    </label>
    <div class="mt-2">
        <input 
            type="file" 
            name="gallery[]" 
            id="gallery" 
            accept="image/*" 
            multiple
            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
        <small class="text-gray-500">Vous pouvez sélectionner le passeport.</small>
    </div>
    <div id="preview" class="mt-4 grid grid-cols-4 gap-4"></div>
    @error('gallery')
        <span class="text-red-500">{{ $message }}</span>
    @enderror
</div>
<style>
    #preview {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        justify-content: center;
    }

    #preview img {
        width: 150px; /* Largeur de chaque image */
        height: 150px; /* Hauteur de chaque image */
        object-fit: cover; /* Pour que l'image occupe toute la zone sans déformer */
        border-radius: 8px; /* Coins arrondis pour chaque image */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Ombre légère autour des images */
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out; /* Effet de survol */
    }

    #preview img:hover {
        transform: scale(1.05); /* Agrandissement léger au survol */
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); /* Ombre plus forte au survol */
    }
</style>

<script>
    const galleryInput = document.getElementById('gallery');
    const previewDiv = document.getElementById('preview');
    const form = document.querySelector('form'); // Assurez-vous que votre formulaire a bien une balise <form>

    // Validation à la sélection des fichiers
    galleryInput.addEventListener('change', function () {
        // Vide le contenu précédent de l'aperçu
        previewDiv.innerHTML = "";

        if (galleryInput.files.length < 3) {
            alert("Vous devez sélectionner au moins 3 images.");
            galleryInput.value = ""; // Vide l'input de fichiers pour forcer l'utilisateur à sélectionner de nouveau les images
            return;
        }

        // Affiche les images sélectionnées
        Array.from(galleryInput.files).forEach(file => {
            const fileReader = new FileReader();

            fileReader.onload = function(event) {
                // Crée un élément <img> pour afficher l'image
                const imgElement = document.createElement('img');
                imgElement.src = event.target.result;
                imgElement.className = "max-w-xs max-h-32 mx-auto mb-2"; // Vous pouvez ajuster ces classes pour redimensionner et styliser l'image
                previewDiv.appendChild(imgElement);
            };

            fileReader.readAsDataURL(file); // Lit le fichier et génère une URL de données (Data URL)
        });
    });

    // Validation lors de la soumission du formulaire
    form.addEventListener('submit', function (e) {
        if (galleryInput.files.length < 3) {
            e.preventDefault(); // Empêche la soumission du formulaire si moins de 3 fichiers sont sélectionnés
            alert("Vous devez sélectionner au moins 3 images.");
        }
    });
</script>

                            {{-- Date Inputs --}}
                            
                            <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" style="display: none;" >
                    <input type="time" name="delivery_time"  id="delivery_time" value="{{ request('delivery_time') }}"  style="display: none;" >
                    <input type="date" name="end_date" id="end_date"value="{{ request('end_date') }}"style="display: none;" >
                    <input type="time" name="return_time" id="return_time" value="{{ request('return_time') }}" style="display: none;" >                   
</div>
                        {{-- Submit Button --}}
                        <div class="pt-6">
                            <button type="submit"
                                class="inline-flex justify-center rounded-md border border-transparent bg-pr-400 py-2 px-4 text-sm font-medium text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-pr-400 focus:ring-offset-2">
                                Reserver
                            </button>
                        </div>

                    </form>
                </div>
            </div>

            {{-- -------------------------------------------- right -------------------------------------------- --}}

            <div class="md:w-1/3 flex flex-col justify-start items-center">
                <div class="relative mx-3 mt-3 flex h-[200px] w-3/4   overflow-hidden rounded-xl shadow-lg">
                    <img loading="lazy" class="h-full w-full object-cover" src="{{ $car->image }}" alt="product image" />
                    <span
                        class="absolute w-36 h-8 py-1 top-0 left-0 m-2 rounded-full bg-pr-400 px-2 text-center text-sm font-medium text-white">{{ $car->reduce }}
                        % de réduction</span>
                </div>
                <p class=" ms-4 max-w-full font-car text-xl mt-3 md:block hidden">{{ $car->brand }} {{ $car->model }}
                    {{ $car->engine }}
                </p>
                <div class="mt-3 ms-4 md:block hidden">
                    <div class="flex items-center">
                        @for ($i = 0; $i < $car->stars; $i++)
                            <svg aria-hidden="true" class="h-4 w-4 text-pr-300" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                        @endfor
                        <span
                            class="mr-2 ml-3 rounded bg-pr-300 px-2.5 py-0.5 text-sm font-semibold">{{ $car->stars }}.0</span>
                    </div>
                </div>


                <div class=" w-full   mt-8 ms-8">
                    <p id="duration" class="font-car text-gray-600 text-lg ms-2">Durée estimée: <span
                            class="mx-2 font-car text-md font-medium text-gray-700 border border-pr-400 p-2 rounded-md "> --
                            jours</span>
                    </p>
                </div>

                <div class=" w-full   mt-8 ms-8">
                    <p id="total-price" class="font-car text-gray-600 text-lg ms-2">Prix estimé: <span
                            class="mx-2 font-car text-md font-medium text-gray-700 border border-pr-400 p-2 rounded-md "> --
                            DT</span>
                    </p>
                </div>
             
            </div>
        </div>

        @if (session('error'))
        <script>
            // Vérifie si un message d'erreur est présent dans la session
            const Toast = Swal.mixin({
                toast: true, // Le toast apparaîtra sous forme de pop-up
                position: "top-end", // Position de l'alerte dans le coin supérieur droit
                showConfirmButton: false, // Pas de bouton de confirmation
                timer: 3000, // Le toast disparaît après 3 secondes
                timerProgressBar: true, // Affiche la barre de progression
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer; // Arrêter la minuterie si l'utilisateur survole l'alerte
                    toast.onmouseleave = Swal.resumeTimer; // Relancer la minuterie si l'utilisateur quitte l'alerte
                }
            });
    
            // Affiche le toast avec l'icône d'erreur et le message d'erreur
            Toast.fire({
                icon: "error", // Icône d'erreur
                title: "{{ session('error') }}" // Message d'erreur récupéré de la session
            });
        </script>
    @endif


    </div>
    

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');

        function updateDurationAndPrice() {
            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);

            if (isNaN(startDate) || isNaN(endDate)) {
                document.getElementById('duration').textContent = 'Estimated Duration: --';
                document.getElementById('total-price').textContent = 'Estimated Price: --';
                return;
            }

            if (startDate <= endDate) {
                const duration = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24));
                const pricePerDay = {{ $car->price_per_day }};
                const totalPrice = duration * pricePerDay;

                document.getElementById('duration').textContent = `Estimated Duration: ${duration} days`;
                document.getElementById('total-price').textContent = `Estimated Price: ${totalPrice} $`;
            } else {
                document.getElementById('duration').textContent = 'Estimated Duration: --';
                document.getElementById('total-price').textContent = 'Estimated Price: --';
            }
        }

        // Call the function initially to calculate based on pre-selected values
        updateDurationAndPrice();

        // Add event listeners for changes
        startDateInput.addEventListener('change', updateDurationAndPrice);
        endDateInput.addEventListener('change', updateDurationAndPrice);
    });
</script>



@endsection