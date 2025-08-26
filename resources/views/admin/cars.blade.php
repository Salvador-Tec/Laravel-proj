@extends('admin.noname')

@section('content')
    <div class="my-20 flex flex-col justify-center items-center mx-auto max-w-screen-xl">

        <!-- Conteneur pour aligner le bouton à gauche et la barre de recherche à droite -->
        <div class="w-full flex justify-between items-center mb-6">
<div class="flex items-center space-x-6">
  <!-- Bouton Ajouter nouvelle voiture -->
 <a href="{{ route('cars.create') }}">
    <button style="background-color: #4F46E5; color: white; padding: 8px; border-radius: 6px; box-shadow: 0 2px 6px rgba(0,0,0,0.2);" 
            onmouseover="this.style.backgroundColor='#4338CA'; this.style.cursor='pointer';"
            onmouseout="this.style.backgroundColor='#4F46E5';">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" width="32" height="32" style="display:inline; margin-right:8px;">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        Ajouter nouvelle voiture
    </button>
</a>


  <!-- Bouton Voir le radar -->
 <a href="{{ route('cars.radar') }}"
   role="button"
   style="display: inline-flex; align-items: center; padding: 8px 16px; background-color: #4F46E5; border-radius: 6px; color: white; text-decoration: none; transition: background-color 0.2s;"
   title="Voir le radar"
   onmouseover="this.style.backgroundColor='#4338CA'; this.style.cursor='pointer';"
   onmouseout="this.style.backgroundColor='#4F46E5';"
>
    <svg xmlns="http://www.w3.org/2000/svg" 
         height="1em" 
         viewBox="0 0 512 512" 
         fill="currentColor"
         style="margin-right: 8px;">
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
                        placeholder="Entrez matricule  voiture" value="{{ request()->input('matricule') }}">
                </div>

                <!-- Bouton de recherche -->
              <button type="submit" 
    style="margin-left: 0.5rem; padding: 0.75rem; background-color: #4F46E5; border-radius: 9999px; color: white; border: none; cursor: pointer; transition: background-color 0.2s;"
    onmouseover="this.style.backgroundColor='#4338CA';" 
    onmouseout="this.style.backgroundColor='#4F46E5';">
    <svg xmlns="http://www.w3.org/2000/svg" 
         height="1em" 
         viewBox="0 0 512 512" 
         fill="currentColor">
        <path d="M505 442.7L405.3 343c28.4-35.3 45.7-80.3 45.7-129 0-114.9-93.1-208-208-208S35 99.1 35 214s93.1 208 208 208c48.7 0 93.7-17.3 129-45.7l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6 0-33.9zM81 214c0-73.4 59.6-133 133-133s133 59.6 133 133-59.6 133-133 133-133-59.6-133-133z"/>
    </svg>
</button>


            </form>
        </div>

        <!-- Tableau des voitures -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full">
            <div class="card">
    <h5 class="card-header">Liste des Voitures</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead class="table-light">
                <tr>
                    <th>Image</th>
                    <th>Marque</th>
                    <th>Modèle</th>
                    <th>Société</th>
                    <th>Matricule</th>
                    <th>Départ</th>
                    <th>Retour</th>
                    <th>Type Boite</th>
                    <th>Moteur</th>
                    <th>Prix/j</th>
                    <th>Quantité</th>
                    <th>Réservé</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($cars as $car)
                    <tr>
                        <td>
                            <div class="p-0.5 rounded border border-primary">
                                <img loading="lazy" src="{{ asset('storage/' . $car->image) }}" alt="car image" style="width: 60px; height: auto;">
                            </div>
                        </td>
                        <td><span class="fw-medium">{{ $car->brand }}</span></td>
                        <td>{{ $car->model }}</td>
                        <td>{{ $car->nom_societe }}</td>
                        <td>{{ $car->matricule }}</td>
                        <td>{{ $car->pickup_location }}</td>
                        <td>{{ $car->return_location }}</td>
                        <td>{{ $car->gearbox_type }}</td>
                        <td>{{ $car->engine }}</td>
                        <td>{{ $car->price_per_day }}</td>
                        <td>{{ $car->quantity }}</td>
                         @php
    //Supposons que la voiture a une relation "reservations" et que tu veux récupérer la réservation active
    $activeReservation = $car->reservations->where('status', 'active')->first();
@endphp

                        <td>
                            @if($car->status == 'unavailable')
                                <span class="badge bg-label-success me-1">Oui</span>
                            @else
                                <span class="badge bg-label-danger me-1">Non</span>
                            @endif
                        </td>
                        
                        <td>
                            
                          
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="icon-base ti tabler-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('cars.edit', ['car' => $car->id]) }}">
                                        <i class="icon-base ti tabler-pencil me-1"></i> Modifier
                                    </a>
                                    <form action="{{ route('cars.destroy', ['car' => $car->id]) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette voiture ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="dropdown-item" type="submit">
                                            <i class="icon-base ti tabler-trash me-1"></i> Supprimer
                                        </button>
                                    </form>
                                      @php
            $activeReservation = $car->reservations->where('status', 'active')->first();
        @endphp

        <!-- Calendrier dans le dropdown -->
      <a href="{{ route('admin.calendrier', ['car' => $car->id]) }}" class="dropdown-item d-flex align-items-center">
    <span class="p-2 bg-label-secondary rounded-circle d-inline-flex justify-content-center align-items-center me-2" style="width: 32px; height: 32px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v1H0V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM0 4h16v9a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2 2v1h2V6H2zm3 0v1h2V6H5zm3 0v1h2V6H8zm3 0v1h2V6h-2zM2 8v1h2V8H2zm3 0v1h2V8H5zm3 0v1h2V8H8zm3 0v1h2V8h-2zM2 10v1h2v-1H2zm3 0v1h2v-1H5zm3 0v1h2v-1H8zm3 0v1h2v-1h-2z"/>
        </svg>
    </span>
    Calendrier
</a>





                                    

                                   <div class="relative">
   
   

                                    <a class="dropdown-item" href="{{ route('admin.voiture', ['id' => $car->id]) }}">
                                        <i class="icon-base ti tabler-eye me-1"></i> Voir voiture
                                    </a>
                                    <form action="{{ route('cars.details', $car->id) }}" method="GET">
                                        @csrf
                                        <button class="dropdown-item" type="submit">
                                            <i class="icon-base ti tabler-info-circle me-1"></i> Détails
                                        </button>
                                    </form>
                                </div>
                            </div>
                        

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

        </div>
        <link href="https://unpkg.com/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet">

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


        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const highlightedRow = document.querySelector('tr.bg-yellow-100');
                if (highlightedRow) {
                    highlightedRow.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            });
        </script>
        <script>
  function toggleActionsMenu(id) {
    const menu = document.getElementById(`actionsMenu-${id}`);
    const btn = document.getElementById(`actionMenuBtn-${id}`);
    const isHidden = menu.classList.contains('hidden');

    if (isHidden) {
      menu.classList.remove('hidden');
      btn.setAttribute('aria-expanded', 'true');
    } else {
      menu.classList.add('hidden');
      btn.setAttribute('aria-expanded', 'false');
    }
  }

  // Fermer le menu si clic en dehors
  document.addEventListener('click', function(event) {
    document.querySelectorAll('[id^="actionsMenu-"]').forEach(menu => {
      const btnId = menu.id.replace('actionsMenu', 'actionMenuBtn');
      const btn = document.getElementById(btnId);
      if (!menu.contains(event.target) && !btn.contains(event.target)) {
        menu.classList.add('hidden');
        btn.setAttribute('aria-expanded', 'false');
      }
    });
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
<script>
    // Initialisation Flatpickr pour chaque voiture
    document.addEventListener('DOMContentLoaded', function () {
        @foreach ($cars as $car)
            flatpickr("#datepicker-{{ $car->id }}", {
                disable: [
                    {
                        from: "{{ $car->reservations->where('status', 'active')->first()?->start_date }}",
                        to: "{{ $car->reservations->where('status', 'active')->first()?->end_date }}"
                    }
                ],
                onDayCreate: function(dObj, dStr, fp, dayElem) {
                    const startDateStr = "{{ $car->reservations->where('status', 'active')->first()?->start_date }}";
                    const endDateStr = "{{ $car->reservations->where('status', 'active')->first()?->end_date }}";

                    if (!startDateStr || !endDateStr) return;

                    const startDate = new Date(startDateStr);
                    const endDate = new Date(endDateStr);
                    const date = new Date(dayElem.dateObj);

                    if (date >= startDate && date <= endDate) {
                        dayElem.style.backgroundColor = '#f87171';
                        dayElem.style.color = 'white';
                        dayElem.style.borderRadius = '50%';
                        dayElem.style.cursor = 'not-allowed';
                        dayElem.setAttribute('title', `Réservé du ${startDateStr} au ${endDateStr}`);
                    }
                }
            });
        @endforeach
    });

    // Afficher/Masquer le calendrier spécifique
    function toggleDatepicker(id) {
        const datepicker = document.getElementById(`datepicker-${id}`);
        // Toggle affichage
        datepicker.classList.toggle('hidden');
    }

    // Fermer si clic en dehors
    document.addEventListener('click', function(event) {
        @foreach ($cars as $car)
            const datepicker{{ $car->id }} = document.getElementById('datepicker-{{ $car->id }}');
            const trigger{{ $car->id }} = datepicker{{ $car->id }}.previousElementSibling;

            if (!datepicker{{ $car->id }}.contains(event.target) && !trigger{{ $car->id }}.contains(event.target)) {
                datepicker{{ $car->id }}.classList.add('hidden');
            }
        @endforeach
    });
</script>



@endsection