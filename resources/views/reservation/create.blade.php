
@extends('layouts.myapp')
@section('create_reservation')
    <div class="mx-auto max-w-screen-x2 ">
        <div class="flex justify-between md:flex-row flex-col ">
            @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
            {{-- -------------------------------------------- left -------------------------------------------- --}}
            <div class="md:w-2/3  md:border-r border-gray-800 p-2 mt-8 ">

                <h2 class=" ms-4 max-w-full font-car md:text-6xl text-4xl mt-24">{{ $car->brand }} {{ $car->model }}
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
                            {{-- Date de naissance --}}
                                <div class="sm:col-span-3">
                                    <label for="date_of_birth" class="block text-sm font-medium leading-6 text-gray-900">Date de naissance</label>
                                    <div class="mt-2">
                                        <input type="date" name="date_of_birth" id="date_of_birth"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                                    </div>
                                    @error('date_of_birth')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- Champ pour Code --}}
                                    <div class="sm:col-span-3">
                                 <label for="code" class="block text-sm font-medium leading-6 text-gray-900">Code De Réservation</label>
                                 <div class="mt-2">
                                 <input type="text" name="code" id="code" readonly
                                    class="bg-gray-100 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6">
                                    </div>
                                </div>
                                <script>
    function generateCode() {
        const firstName = document.getElementById('first_name').value.trim().toLowerCase();
        const lastName = document.getElementById('last_name').value.trim().toLowerCase();
        const dob = document.getElementById('date_of_birth').value;

        if (firstName && lastName && dob) {
            const nomPart = firstName.substring(0, 3); // ex: "ach"
            const prenomPart = lastName.substring(0, 4); // ex: "beny"
            const datePart = dob.split('-').reverse().join('').substring(0, 6); // ex: "280698"

            const code = nomPart + prenomPart + datePart;
            document.getElementById('code').value = code;
        }
    }

    document.getElementById('first_name').addEventListener('input', generateCode);
    document.getElementById('last_name').addEventListener('input', generateCode);
    document.getElementById('date_of_birth').addEventListener('input', generateCode);
</script>



                                {{-- Lieu de naissance --}}
                                <div class="sm:col-span-3">
                                    <label for="place_of_birth" class="block text-sm font-medium leading-6 text-gray-900">Lieu de naissance</label>
                                    <div class="mt-2">
                                        <input type="text" name="place_of_birth" id="place_of_birth"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                                    </div>
                                    @error('place_of_birth')
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
                             {{-- garanite --}}
                            <div class="sm:col-span-3">
                                <label for="garantie" class="block text-sm font-medium leading-6 text-gray-900">Garantie</label>
                                <div class="mt-2">
                                    <input type="text" name="garantie" id="garantie"
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
        <div class="flex items-center space-x-4">
                <label for="second_driver_toggle" class="text-sm text-gray-700 font-medium">
                    Ajouter un 2ᵉ conducteur ?
                </label>
                <!-- Switch -->
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="second_driver_toggle" class="sr-only peer">
                    <!-- Barre verte -->
                    <div class="w-12 h-6 bg-green-300 rounded-full peer-checked:bg-green-600 transition-colors duration-300"></div>
                    <!-- Rond blanc animé -->
                    <div class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow-md transition-all duration-300 peer-checked:translate-x-6"></div>
                </label>
        </div>
        <script>
              document.addEventListener('DOMContentLoaded', function() {
                const toggle = document.getElementById('second_driver_toggle');
                const form = document.getElementById('second-driver-form');
                console.log('Toggle element:', toggle);
                console.log('Form element:', form);
                
                if (toggle && form) {
                    toggle.addEventListener('change', function() {
                        console.log('Toggle changed, checked:', toggle.checked);
                        if (toggle.checked) {
                            form.style.display = 'block';
                            console.log('Form should be visible now');
                        } else {
                            form.style.display = 'none';
                            // Optionally clear fields if needed
                            const driverForm = document.getElementById('driver-form');
                            if (driverForm) driverForm.innerHTML = '';
                            const cinInput = document.getElementById('second_driver_cin');
                            if (cinInput) cinInput.value = '';
                            console.log('Form hidden and cleared');
                        }
                    });
                    // Hide by default
                    form.style.display = 'none';
                    console.log('Form hidden by default');
                } else {
                    console.error('Toggle or form element not found');
                }
            });
        </script>
      <script src="https://cdn.tailwindcss.com"></script>
      
    
    
<!-- Formulaire du 2ème conducteur caché initialement -->
<div id="second-driver-form" style="display: none;">
    

    <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg">
        <div class="flex-1">
            <label for="second_driver_cin" class="block text-sm font-medium text-gray-700 mb-2">CIN du 2ème conducteur</label>
            <input type="text" id="second_driver_cin" name="second_driver_cin" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                   placeholder="Entrez le numéro CIN">
        </div>
        <div class="flex-shrink-0">
            <button type="button" 
                    class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-6 rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2" 
                    onclick="showForm()">
                OK
            </button>
        </div>
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
    const form = document.querySelector('form');

    // Inputs à valider
    const fields = [
        'first_name',
        'last_name',
        'date_of_birth',
        'place_of_birth',
        'nationality',
        'identity_number',
        'identity_date',
        'driver_license_number',
        'license_date',
        'address',
        'mobile_number'
    ];

    galleryInput.addEventListener('change', function () {
        previewDiv.innerHTML = "";

        if (galleryInput.files.length < 3) {
            alert("Vous devez sélectionner au moins 3 images.");
            galleryInput.value = "";
            return;
        }

        Array.from(galleryInput.files).forEach(file => {
            const fileReader = new FileReader();

            fileReader.onload = function(event) {
                const imgElement = document.createElement('img');
                imgElement.src = event.target.result;
                imgElement.className = "max-w-xs max-h-32 mx-auto mb-2";
                previewDiv.appendChild(imgElement);
            };

            fileReader.readAsDataURL(file);
        });
    });

    form.addEventListener('submit', function (e) {
        let errors = [];

        if (galleryInput.files.length < 3) {
            errors.push("Vous devez sélectionner au moins 3 images.");
        }

        fields.forEach(id => {
            const input = document.getElementById(id);
            if (!input || input.value.trim() === '') {
                let label = id.replace(/_/g, ' ');
                label = label.charAt(0).toUpperCase() + label.slice(1);
                errors.push(`Le champ ${label} est obligatoire.`);
            }
        });

        if (errors.length > 0) {
            e.preventDefault();
            alert(errors.join('\n'));
        }
    });
</script>


                            {{-- Date Inputs --}}
                            
                            <input type="hidden" name="start_date" id="start_date" value="{{ $start_date ?? request('start_date') }}">
                    <input type="hidden" name="delivery_time"  id="delivery_time" value="{{ $delivery_time ?? request('delivery_time') }}">
                    <input type="hidden" name="end_date" id="end_date" value="{{ $end_date ?? request('end_date') }}">
                    <input type="hidden" name="return_time" id="return_time" value="{{ $return_time ?? request('return_time') }}">                   
</div>
<div id="additionalDrivers" class="mt-6"></div>
<div class="pt-6">

<!-- Bouton pour afficher/masquer le formulaire du 2ème conducteur -->

        <div id="driver-form" class="mt-4"></div>
        
<div id="additionalForm" class="hidden"></div>
        <div class="border border-gray-300 rounded-md p-4 mb-4 bg-gray-50">

        <div id="additionalForm" class="grid grid-cols-1 md:grid-cols-2 gap-4" style="display:none;">
           
            <div class="p-6 bg-white rounded-lg shadow-md">
            
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
  
                    
                    
                </div>
            </div>
        </div>
    </div>
    </div>
</div>


                        </div  class="pt-6" >
                        <script>
function showForm() {
  const cin = document.getElementById('second_driver_cin').value.trim();
  
  if (!cin) {
    alert('Veuillez entrer un numéro CIN');
    return;
  }

  fetch(`/check-cin/${cin}`)
    .then(response => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.json();
    })
    .then(data => {
      console.log('Response from server:', data);
      let formHtml = '';

      if (data.success) {
        const client = data.client;

        // Vérifier si des images sont disponibles dans le champ gallery
        let imagesHtml = '';
        if (client.gallery) {
          try {
            const gallery = JSON.parse(client.gallery);
            if (gallery && gallery.length > 0) {
              imagesHtml = `
                <div class="flex flex-col">
                  <label class="mb-1 font-medium text-green-600">Images de la carte d'identité et permis de conduire</label>
                  <div class="flex space-x-4">
                    ${gallery.map(image => `<img src="${image}" alt="Image" class="w-20 h-20 object-cover border rounded-md" />`).join('')}
                  </div>
                </div>
              `;
            }
          } catch (e) {
            console.log('Erreur parsing gallery:', e);
          }
        }

        formHtml = `
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6 bg-gray-100 rounded-xl shadow-md text-gray-800">
            <div class="flex flex-col">
              <label class="mb-1 font-medium text-green-600">Nom</label>
              <input type="text" name="last_name_conducteur" value="${client.last_name || ''}" class="bg-white text-gray-800 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-300" />
            </div>

            <div class="flex flex-col">
              <label class="mb-1 font-medium text-green-600">Prénom</label>
              <input type="text" name="first_name_conducteur" value="${client.first_name || ''}" class="bg-white text-gray-800 border border-gray-300 rounded px-3 py-2" />
            </div>

            <div class="flex flex-col">
              <label class="mb-1 font-medium text-green-600">Date de naissance</label>
              <input type="text"name="date_of_birth_conducteur" value="${client.date_of_birth || ''}" class="bg-white text-gray-800 border border-gray-300 rounded px-3 py-2" />
            </div>

            <div class="flex flex-col">
              <label class="mb-1 font-medium text-green-600">Lieu de naissance</label>
              <input type="text" name="place_of_birth_conducteur" value="${client.place_of_birth || ''}" class="bg-white text-gray-800 border border-gray-300 rounded px-3 py-2" />
            </div>

            <div class="flex flex-col">
              <label class="mb-1 font-medium text-green-600">Nationalité</label>
              <input type="text" name="nationality_condcuteur" value="${client.nationality || ''}" class="bg-white text-gray-800 border border-gray-300 rounded px-3 py-2" />
            </div>

            <div class="flex flex-col">
              <label class="mb-1 font-medium text-green-600">Num carte d'identité</label>
              <input type="text" name="identity_number_conducteur" value="${client.identity_number || ''}" class="bg-white text-gray-800 border border-gray-300 rounded px-3 py-2" />
            </div>

            <div class="flex flex-col">
              <label class="mb-1 font-medium text-green-600">Date d'identité</label>
              <input type="text" name="identity_date_conducteur" value="${client.identity_date || ''}" class="bg-white text-gray-800 border border-gray-300 rounded px-3 py-2" />
            </div>

            <div class="flex flex-col">
              <label class="mb-1 font-medium text-green-600">Numéro de permis</label>
              <input type="text" name="driver_license_number_conducteur" value="${client.driver_license_number || ''}" class="bg-white text-gray-800 border border-gray-300 rounded px-3 py-2" />
            </div>

            <div class="flex flex-col">
              <label class="mb-1 font-medium text-green-600">Date de permis</label>
              <input type="text" name="license_date_conducteur" value="${client.license_date || ''}" class="bg-white text-gray-800 border border-gray-300 rounded px-3 py-2" />
            </div>

            <div class="flex flex-col md:col-span-2">
              <label class="mb-1 font-medium text-green-600">Adresse</label>
              <input type="text" name="address_conducteur" value="${client.address || ''}" class="bg-white text-gray-800 border border-gray-300 rounded px-3 py-2" />
            </div>

            
        
        `;
      } else {
        formHtml = `
          <div class="p-6 bg-gray-100 rounded-xl shadow-md text-gray-800 space-y-4">
    <p class="text-lg font-semibold">Aucun client trouvé. Veuillez remplir manuellement :</p>
    <br>
     
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <label class="block mb-1 text-green-600 font-medium">Nom</label>
            <input type="text" name="last_name_conducteur" required>

        
      </div>
      <div>
        <label class="block mb-1 text-green-600 font-medium">Prénom</label>
            <input type="text" name="first_name_conducteur" required>

      </div>
      <div>
        <label class="block mb-1 text-green-600 font-medium">Date de naissance</label>
            <input type="date" name="date_of_birth_conducteur">

      </div>
      <div>
        <label class="block mb-1 text-green-600 font-medium">Lieu de naissance</label>
            <input type="text" name="place_of_birth_conducteur">

      </div>
      <div>
        <label class="block mb-1 text-green-600 font-medium">Nationalité</label>
            <input type="text" name="nationality_conducteur">

      </div>
      <div>
        <label class="block mb-1 text-green-600 font-medium">Numéro de carte d'identité</label>
            <input type="text"value="${cin}" name="identity_number_conducteur">

      </div>
     <div>
        <label class="block mb-1 text-green-600 font-medium">Date d'identité</label>
            <input type="date" name="identity_date_conducteur">

      </div>
      <div>
        <label class="block mb-1 text-green-600 font-medium">Numéro de permis</label>
            <input type="text" name="driver_license_number_conducteur" required>

      </div>
      <div>
        <label class="block mb-1 text-green-600 font-medium">Date de permis</label>
            <input type="date" name="license_date_conducteur">

      </div>
      <div>
        <label class="block mb-1 text-green-600 font-medium">Adresse</label>
            <input type="text" name="address_conducteur">

      </div>
<div>
  <label class="block mb-1 text-green-600 font-medium">Téléphone</label>
      <input type="text" name="mobile_number_conducteur">

</div>

<div class="md:col-span-2">
  <label for="gallery" class="block text-sm font-medium leading-6 text-gray-900">Télécharger carte d'identité et permis de conduire (recto et verso)</label>
  <div class="mt-2">
    <input 
      type="file" 
      name="gallery_conducteur[]" 
      id="gallery_conducteur" 
      accept="image/*" 
      multiple
      class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
    <small class="text-gray-500">Vous pouvez sélectionner le passeport.</small>
  </div>
</div>

    </div>
  </div>
        `;
      }

      const driverForm = document.getElementById('driver-form');
      if (driverForm) {
        driverForm.innerHTML = formHtml;
        console.log('Form updated successfully');
      } else {
        console.error('driver-form element not found');
      }
      document.getElementById('additionalForm').classList.add('hidden');
    })
    .catch(error => {
      console.error("Erreur lors de la requête :", error);
      alert('Erreur lors de la vérification du CIN. Veuillez réessayer.');
    });
}

function testShowForm() {
    console.log('Test function called');
    const driverForm = document.getElementById('driver-form');
    if (driverForm) {
        const testFormHtml = `
            <div class="p-6 bg-gray-100 rounded-xl shadow-md text-gray-800 space-y-4">
                <p class="text-lg font-semibold">Test Form - Client trouvé :</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-1 text-green-600 font-medium">Nom</label>
                        <input type="text" name="last_name_conducteur" value="Test Nom" class="w-full bg-white border border-gray-300 rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="block mb-1 text-green-600 font-medium">Prénom</label>
                        <input type="text" name="first_name_conducteur" value="Test Prénom" class="w-full bg-white border border-gray-300 rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="block mb-1 text-green-600 font-medium">CIN</label>
                        <input type="text" name="identity_number_conducteur" value="12345678" class="w-full bg-white border border-gray-300 rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="block mb-1 text-green-600 font-medium">Permis</label>
                        <input type="text" name="driver_license_number_conducteur" value="ABC123" class="w-full bg-white border border-gray-300 rounded px-3 py-2">
                    </div>
                </div>
            </div>
        `;
        driverForm.innerHTML = testFormHtml;
        console.log('Test form loaded successfully');
    } else {
        console.error('driver-form element not found in test');
    }
}
</script>
<script>
    function toggleSecondDriverForm() {
      document.getElementById("second-driver-form").style.display = "block";
      document.getElementById("toggle-form").style.display = "none";
    }
    
    function hideSecondDriverForm() {
      document.getElementById("second-driver-form").style.display = "none";
      document.getElementById("toggle-form").style.display = "inline-flex";
      document.getElementById("driver-form").innerHTML = ""; // Réinitialise le contenu du formulaire
      document.getElementById("second_driver_cin").value = ""; // Vide le champ CIN
    }
    </script>



                        {{-- Submit Button --}}
                        <div class="pt-6">
                            <button type="submit"
                                class="inline-flex justify-center rounded-md border border-transparent bg-red-600 py-2 px-4 text-sm font-medium text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-pr-400 focus:ring-offset-2">
                                Reserver
                            </button>
                        </div>
                       


                  
                </div>
            </div>

            {{-- -------------------------------------------- right -------------------------------------------- --}}

            <div class="md:w-1/3 flex flex-col justify-start items-center">
                <div class="relative mx-3 mt-36 flex h-[250px] w-3/4   overflow-hidden rounded-xl shadow-lg">
                    <img loading="lazy" class="h-full w-full object-cover" src="{{ asset('storage/' . $car->image) }}" alt="product image" />
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


                 <!-- Afficher la durée estimée -->
                 @php
                 $start_date = $start_date ?? session('start_date');
                 $end_date = $end_date ?? session('end_date');
                 $days = null;
                 if ($start_date && $end_date) {
                     $start = \Carbon\Carbon::parse($start_date);
                     $end = \Carbon\Carbon::parse($end_date);
                     $days = $start->diffInDays($end);
                 }
             @endphp

             <div class="w-full mt-8 ms-8">
                 <p class="font-car text-gray-600 text-lg ms-2">
                     Durée estimée :
                    <span id="duration" class="mx-2 font-car text-md font-medium text-gray-700 border border-pr-400 p-2 rounded-md">
                        {{ $days ?? '--' }} jours
                    </span>
                 </p>
             </div>

              
              
                
                <!-- Affichage des trois prix -->
                <div class="w-full mt-8 ms-8">
                    <!-- Prix Standard -->
                    <div class="mb-6"> <!-- Ajout de mb-6 pour espacement important en bas -->
                        <p class="font-car text-gray-600 text-lg ms-2">Prix estimé:
                            <span class="mx-2 font-car text-md font-medium text-gray-700 border border-pr-400 p-2 rounded-md">
                                @php
                                    // Calculer le prix total estimé
                                    $totalPrice = $days ? $car->price_per_day * $days : 0;
                                @endphp
                                <span id="total-price" data-price-display>{{ number_format($totalPrice, 2, '.', '') }} DT</span>
                 
                                @if($car->reduce > 0)
                                    @php
                                        // Calculer le prix avec la réduction
                                        $priceWithDiscount = intval(($car->price_per_day * 100) / (100 - $car->reduce)) * $days;
                                    @endphp
                                    <span class="text-sm text-red-500 line-through ml-2">
                                        {{ $priceWithDiscount }} DT
                                    </span>
                                @endif
                            </span>
                        </p>
                    </div>
                    
                
                    <!-- Prix Saisonnier -->
@if($car->seasonal_price)
<div class="mb-6"> <!-- Même espacement -->
    <p class="font-car text-gray-600 text-lg ms-2">Prix Saisonnier:
        <span class="mx-2 font-car text-md font-medium text-gray-700 border border-pr-400 p-2 rounded-md">
            @php
                // Calculer le prix saisonnier total
                $seasonalPrice = $days ? $car->seasonal_price * $days : 0;
            @endphp
            {{ $seasonalPrice }} DT
        </span>
    </p>
</div>
@endif

                
                    <!-- Prix Estival -->
@if($car->summer_price)
<div class="mb-6"> <!-- Même espacement -->
    <p class="font-car text-gray-600 text-lg ms-2">Prix d'été:
        <span class="mx-2 font-car text-md font-medium text-gray-700 border border-pr-400 p-2 rounded-md">
            @php
                // Calculer le prix estival total
                $summerPrice = $days ? $car->summer_price * $days : 0;
            @endphp
            {{ $summerPrice }} DT
        </span>
    </p>
</div>
@endif
        
<div class="space-y-5 mt-6">
    <!-- Options supplémentaires -->
    <div class="space-y-5 mt-6">
        <!-- Boutons Oui/Non -->
        <div class="flex items-center justify-between bg-white p-4 rounded shadow">
            <div class="flex items-center">
              <svg class="w-5 h-5 text-indigo-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                      d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                      clip-rule="evenodd" />
              </svg>
              <h5 class="text-lg font-medium text-gray-700">Options supplémentaires</h5>
            </div>
        
            <!-- ✅ Switch animé -->
            <label class="relative inline-flex items-center cursor-pointer">
              <input type="checkbox" id="options_toggle" class="sr-only peer"
                     onchange="toggleOptions(this.checked)">
              <div class="w-12 h-6 bg-green-300 peer-checked:bg-green-600 rounded-full transition-colors duration-300"></div>
              <div
                class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow-md transition-all duration-300 peer-checked:translate-x-6">
              </div>
            </label>
          </div>
        <script>
            function toggleOptions(state) {
              console.log("Options supplémentaires activées :", state);
            }
          </script>
          <script src="https://cdn.tailwindcss.com"></script>
        <div id="options-supplementaires" class="space-y-5 mt-4">    

    <!-- Option Chauffeur - CORRIGÉ -->
    <label class="flex items-start gap-4 p-3 hover:bg-gray-50 rounded-lg transition cursor-pointer border border-gray-200">
        <input type="hidden" name="avec_chauffeur" value="0"> <!-- Champ caché indispensable -->
        <input type="checkbox" id="chauffeur" name="avec_chauffeur" value="1"
               class="mt-1 w-5 h-5 text-indigo-500 border-gray-300 rounded focus:ring-indigo-400"
               @if(old('avec_chauffeur')) checked @endif>
        <div class="flex items-center gap-4">
            <div class="p-2 bg-indigo-100 text-indigo-600 rounded-lg">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M3 11v8a1 1 0 001 1h1a1 1 0 001-1v-1h12v1a1 1 0 001 1h1a1 1 0 001-1v-8l-2-5H5l-2 5zm4 4a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm10 0a1.5 1.5 0 110-3 1.5 1.5 0 010 3z" />
                </svg>
            </div>
            <div>
                <p class="font-medium text-gray-800">Service avec chauffeur</p>
                <p class="text-sm text-gray-500">+15% du tarif de base</p>
            </div>
        </div>
    </label>

    <!-- Option Siège bébé - CORRIGÉ -->
    <label class="flex items-start gap-4 p-3 hover:bg-gray-50 rounded-lg transition cursor-pointer border border-gray-200">
        <input type="hidden" name="siege_bebe" value="0"> <!-- Champ caché indispensable -->
        <input type="checkbox" id="siegeBebe" name="siege_bebe" value="1"
               class="mt-1 w-5 h-5 text-yellow-500 border-gray-300 rounded focus:ring-yellow-400"
               @if(old('siege_bebe')) checked @endif>
        <div class="flex items-center gap-4">
            <div class="p-2 bg-yellow-100 text-yellow-600 rounded-lg">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 2a3 3 0 100 6 3 3 0 000-6zM5 8a5 5 0 0110 0v1a5 5 0 01-10 0V8zm1 4.5a1.5 1.5 0 100 3 1.5 1.5 0 010 3zm8 0a1.5 1.5 0 100 3 1.5 1.5 0 010-3z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div>
                <p class="font-medium text-gray-800">Siège bébé</p>
                <p class="text-sm text-gray-500">Gratuit (sur demande)</p>
            </div>
        </div>
    </label>

    <!-- Option Numéro de vol - CORRIGÉ -->
    <div class="flex items-start gap-4 p-3 hover:bg-gray-50 rounded-lg transition border border-gray-200">
        <div class="p-2 bg-blue-100 text-blue-600 rounded-lg mt-1">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path d="M2.94 2.94a1.5 1.5 0 012.12 0l12 12a1.5 1.5 0 01-2.12 2.12l-4.95-4.95-1.42 4.24a1 1 0 01-1.88.06L6.1 13.9 3.64 16.36a1.5 1.5 0 11-2.12-2.12L4.1 11.9l-1.42-1.42a1 1 0 01.06-1.88l4.24-1.42-4.95-4.95a1.5 1.5 0 010-2.12z"/>
            </svg>
        </div>
        <div class="flex-1">
            <label for="vol" class="block font-medium text-gray-800">Numéro de vol</label>
            <input type="text" id="vol" name="numero_vol"
                   placeholder="Ex: TU1234"
                   value="{{ old('numero_vol') }}"
                   class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500">
        </div>
    
    </div>
</div>
</div>
<script>
    function toggleOptions(show) {
        const section = document.getElementById('options-supplementaires');
        section.style.display = show ? 'block' : 'none';
    }

    // Facultatif : Masquer les options au chargement de la page
    window.addEventListener('DOMContentLoaded', function() {
        toggleOptions(false); // Masquer par défaut
    });
</script>

  </form>



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
    document.getElementById('addDriverBtn').addEventListener('click', function () {
        const container = document.getElementById('additionalDrivers');
        const template = document.getElementById('driverTemplate');
        const clone = template.content.cloneNode(true);
        container.appendChild(clone);
    });
</script>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');
        const durationEl = document.getElementById('duration');
        const totalPriceEl = document.getElementById('total-price');
        const pricePerDay = {{ $car->price_per_day }};

        function daysBetween(start, end) {
            const msPerDay = 1000 * 60 * 60 * 24;
            const diff = Math.ceil((end - start) / msPerDay);
            return Math.max(1, diff); // minimum 1 jour
        }

        function updateDurationAndPrice() {
            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);

            if (isNaN(startDate) || isNaN(endDate)) {
                if (durationEl) durationEl.textContent = '-- jours';
                if (totalPriceEl) totalPriceEl.textContent = '-- DT';
                return;
            }

            if (startDate <= endDate) {
                const durationDays = daysBetween(startDate, endDate);
                const totalPrice = durationDays * pricePerDay;
                if (durationEl) durationEl.textContent = `${durationDays} jours`;
                if (totalPriceEl) totalPriceEl.textContent = `${totalPrice.toFixed(2)} DT`;
            } else {
                if (durationEl) durationEl.textContent = '-- jours';
                if (totalPriceEl) totalPriceEl.textContent = '-- DT';
            }
        }

        // Initial calc and listeners
        updateDurationAndPrice();
        startDateInput.addEventListener('change', updateDurationAndPrice);
        endDateInput.addEventListener('change', updateDurationAndPrice);
    });
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const chauffeurCheckbox = document.getElementById('chauffeur');
    const totalPriceEl = document.getElementById('total-price');
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');
    const pricePerDay = {{ $car->price_per_day }};

    function daysBetween(start, end) {
        const msPerDay = 1000 * 60 * 60 * 24;
        const diff = Math.ceil((end - start) / msPerDay);
        return Math.max(1, diff);
    }

    function currentBasePrice() {
        const startDate = new Date(startDateInput.value);
        const endDate = new Date(endDateInput.value);
        if (isNaN(startDate) || isNaN(endDate)) return null;
        const durationDays = daysBetween(startDate, endDate);
        return durationDays * pricePerDay;
    }

    if (chauffeurCheckbox && totalPriceEl) {
        chauffeurCheckbox.addEventListener('change', function() {
            const base = currentBasePrice();
            if (base === null) return;
            const isChecked = this.checked;
            const newPrice = isChecked ? base * 1.15 : base;
            totalPriceEl.textContent = newPrice.toFixed(2) + ' DT';

            // Mettre à jour le prix barré si réduction
            const discountElement = document.querySelector('.line-through');
            if (discountElement) {
                const durationDays = currentBasePrice() / pricePerDay;
                const originalDiscount = {{ intval(($car->price_per_day * 100) / (100 - $car->reduce)) }} * durationDays;
                discountElement.textContent = (isChecked ? originalDiscount * 1.15 : originalDiscount).toFixed(2) + ' DT';
            }
        });
    }
});
</script>
<script>
    // Sélectionner les éléments
    const toggleButton = document.getElementById('toggle-form');
    const secondDriverForm = document.getElementById('second-driver-form');

    // Ajouter un écouteur d'événements pour le bouton
    toggleButton.addEventListener('click', function() {
        // Vérifier si le formulaire est actuellement visible ou non
        if (secondDriverForm.style.display === "none" || secondDriverForm.style.display === "") {
            // Si le formulaire est caché, l'afficher
            secondDriverForm.style.display = "block";
        } else {
            // Si le formulaire est déjà visible, le cacher
            secondDriverForm.style.display = "none";
        }
    });
</script>

<script>
    document.getElementById('checkCinBtn').addEventListener('click', function() {
        let cin = document.getElementById('cin').value;
    
        fetch(`/check-cin/${cin}`)
            .then(response => response.json())
            .then(data => {
                let container = document.getElementById('formContainer');
    
                if (data.success) {
                    container.innerHTML = `
                        <p>Nom: ${data.client.name}</p>
                        <p>CIN: ${data.client.identity_number}</p>
                        <!-- Ajoute ici d'autres champs -->
                    `;
                } else {
                    container.innerHTML = `
                        <p>Aucun client trouvé. Remplir manuellement le formulaire :</p>
                        <input type="text" placeholder="Nom">
                        <input type="text" placeholder="Prénom">
                        <!-- Etc -->
                    `;
                }
            })
            .catch(error => {
                console.error("Erreur lors de la requête :", error);
            });
    });
    </script>
    
    <script>
        if (client.second_driver && client.second_driver.last_name) {
    // Ajoutez le champ du second conducteur uniquement si son nom existe
    formHtml += `
        <div class="p-6 bg-gray-100 rounded-xl shadow-md text-gray-800 space-y-4">
          <p class="text-lg font-semibold">Second conducteur :</p>
          <br>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block mb-1 text-green-600 font-medium">Nom du second conducteur</label>
              <input type="text" class="w-full bg-white border border-gray-300 rounded px-3 py-2 text-gray-800" value="${client.second_driver.last_name || ''}" />
            </div>
            <div>
              <label class="block mb-1 text-green-600 font-medium">Prénom du second conducteur</label>
              <input type="text" class="w-full bg-white border border-gray-300 rounded px-3 py-2 text-gray-800" value="${client.second_driver.first_name || ''}" />
            </div>
            <!-- Ajoutez plus de champs pour le second conducteur si nécessaire -->
          </div>
        </div>
    `;
} else {
    console.log("Le second conducteur est soit inexistant, soit avec des données invalides.");
}
        </script>
   
@endsection