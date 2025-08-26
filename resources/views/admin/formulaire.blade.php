@extends('admin.noname')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <!-- Colonne de gauche - Informations Client -->
        <div class="col-xl-4 col-lg-5 order-1 order-md-0">
            <!-- Carte Client -->
            <div class="card mb-6">
                <div class="card-body pt-12">
                    <div class="user-avatar-section">
                        <div class="d-flex align-items-center flex-column">
                            <img class="img-fluid rounded mb-4" 
                                 src="{{ asset('img/avatars/1.png') }}" 
                                 height="120" width="120" 
                                 alt="User avatar" />
                            <div class="user-info text-center">
                                <h5>{{ $reservation->last_name }} {{ $reservation->first_name }}</h5>
                                <span class="badge bg-label-secondary">Client</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="info-container">
                        <h5 class="pb-4 border-bottom mb-4">Détails du Client</h5>
                        <ul class="list-unstyled mb-6">
                            <li class="mb-2">
                                <span class="h6">Nom:</span>
                                <input type="text" name="last_name" value="{{ $reservation->last_name }}" 
                                       class="form-control">
                            </li>
                            <li class="mb-2">
                                <span class="h6">Prénom:</span>
                                <input type="text" name="first_name" value="{{ $reservation->first_name }}" 
                                       class="form-control">
                            </li>
                            <li class="mb-2">
                                <span class="h6">Date de naissance:</span>
                                <input type="date" name="date_of_birth" value="{{ $reservation->date_of_birth }}" 
                                       class="form-control">
                            </li>
                            <li class="mb-2">
                                <span class="h6">Lieu de naissance:</span>
                                <input type="text" name="place_of_birth" value="{{ $reservation->place_of_birth }}" 
                                       class="form-control">
                            </li>
                            <li class="mb-2">
                                <span class="h6">Nationalité:</span>
                                <input type="text" name="nationality" value="{{ $reservation->nationality }}" 
                                       class="form-control">
                            </li>
                            <li class="mb-2">
                                <span class="h6">CIN:</span>
                                <input type="text" name="identity_number" value="{{ $reservation->identity_number }}" 
                                       class="form-control">
                            </li>
                            <li class="mb-2">
                                <span class="h6">Date CIN:</span>
                                <input type="date" name="identity_date" value="{{ $reservation->identity_date }}" 
                                       class="form-control">
                            </li>
                            <li class="mb-2">
                                <span class="h6">Permis:</span>
                                <input type="text" name="driver_license_number" value="{{ $reservation->driver_license_number }}" 
                                       class="form-control">
                            </li>
                            <li class="mb-2">
                                <span class="h6">Date permis:</span>
                                <input type="text" name="license_date" value="{{ $reservation->license_date }}" 
                                       class="form-control">
                            </li>
                            <li class="mb-2">
                                <span class="h6">Garantie:</span>
                                <input type="text" name="garantie" value="{{ $reservation->garantie }}" 
                                       class="form-control">
                            </li>
                            <li class="mb-2">
                                <span class="h6">Adresse:</span>
                                <input type="text" name="address" value="{{ $reservation->address }}" 
                                       class="form-control">
                            </li>
                            <li class="mb-2">
                                <span class="h6">Téléphone:</span>
                                <input type="text" name="mobile_number" value="{{ $reservation->mobile_number }}" 
                                       class="form-control">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Carte Véhicule -->
            <div class="card mb-6 border border-2 border-primary rounded primary-shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <span class="badge bg-label-primary">Véhicule</span>
                        <div class="text-center">
                            <h5 class="mb-0 text-primary">{{ $reservation->car->brand }}</h5>
                            <small class="text-muted">{{ $reservation->car->model }}</small>
                        </div>
                    </div>
                    
                    <div class="text-center my-4">
                        @if(file_exists(public_path('images/capv.png')))
                            <img src="{{ asset('images/v.png') }}" 
                                 class="img-fluid rounded" 
                                 alt="Image du véhicule">
                        @else
                            <div class="text-center text-gray-500 py-4">
                                <i class="fas fa-car text-4xl mb-2"></i>
                                <p>Image du véhicule non disponible</p>
                            </div>
                        @endif
                    </div>
                    
                    <ul class="list-unstyled g-2 my-6">
                        <li class="mb-2 d-flex align-items-center">
                            <i class="icon-base ti tabler-circle-filled icon-10px text-secondary me-2"></i>
                            <span>Matricule: {{ $reservation->car->matricule }}</span>
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <i class="icon-base ti tabler-circle-filled icon-10px text-secondary me-2"></i>
                            <span>Type: {{ $reservation->car->gearbox_type }}</span>
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <i class="icon-base ti tabler-circle-filled icon-10px text-secondary me-2"></i>
                            <span>Prix/jour: {{ $reservation->car->price_per_day }} DT</span>
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <i class="icon-base ti tabler-circle-filled icon-10px text-secondary me-2"></i>
                            <span>Lieu de départ: {{ $reservation->car->pickup_location }}</span>
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <i class="icon-base ti tabler-circle-filled icon-10px text-secondary me-2"></i>
                            <span>Lieu de retour: {{ $reservation->car->return_location }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Colonne de droite - Détails Réservation -->
        <div class="col-xl-8 col-lg-7 order-0 order-md-1">
            <!-- En-tête du contrat -->
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">SIGMA PRIME</h1>
                <h2 class="text-xl text-primary font-semibold">RENT-A-CAR</h2>
                <div class="text-center my-6">
                    <h3 class="text-xl font-semibold text-primary border-b border-primary pb-2 inline-block px-8">
                        CONTRAT DE LOCATION
                    </h3>
                </div>
                <div class="border-b border-gray-200 pt-4"></div>
            </div>
            
            <!-- Formulaire de réservation -->
            <form id="reservationForm" action="{{ route('admin.update', $reservation->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <!-- Période de Location -->
                <div class="card mb-6">
                    <div class="card-header d-flex align-items-center gap-4">
                        <div class="p-3 bg-primary bg-opacity-10 rounded-xl">
                            <i class="icon-base ti tabler-calendar text-primary text-xl"></i>
                        </div>
                        <h5 class="card-title mb-0 text-gray-800 uppercase tracking-wide">PÉRIODE DE LOCATION</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Date début</label>
                                @php
                                    $startDate = \Carbon\Carbon::parse($reservation->start_date);
                                    $deliveryTime = \Carbon\Carbon::parse($reservation->delivery_time);
                                    $startDate->setTime($deliveryTime->hour, $deliveryTime->minute);
                                @endphp
                                <input type="datetime-local" name="start_date"
                                       value="{{ $startDate->format('Y-m-d\TH:i') }}"
                                       class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Date fin</label>
                                @php
                                    $endDate = \Carbon\Carbon::parse($reservation->end_date);
                                    $returnTime = \Carbon\Carbon::parse($reservation->return_time);
                                    $endDate->setTime($returnTime->hour, $returnTime->minute);
                                @endphp
                                <input type="datetime-local" name="end_date" 
                                       value="{{ $endDate->format('Y-m-d\TH:i') }}" 
                                       class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Durée</label>
                                <input type="text" 
                                       value="{{ Carbon\Carbon::parse($reservation->end_date)->diffInDays(Carbon\Carbon::parse($reservation->start_date)) }} jours"
                                       class="form-control bg-gray-100" readonly>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Lieu de départ</label>
                                <select name="pickup_location" class="form-select">
                                    <option value="">-- Sélectionnez --</option>
                                    <option value="Tunis" {{ $reservation->car->pickup_location == 'Tunis' ? 'selected' : '' }}>Tunis</option>
                                    <option value="Sfax" {{ $reservation->car->pickup_location == 'Sfax' ? 'selected' : '' }}>Sfax</option>
                                    <option value="Sousse" {{ $reservation->car->pickup_location == 'Sousse' ? 'selected' : '' }}>Sousse</option>
                                    <option value="Djerba" {{ $reservation->car->pickup_location == 'Djerba' ? 'selected' : '' }}>Djerba</option>
                                    <option value="Gasserine" {{ $reservation->car->pickup_location == 'Gasserine' ? 'selected' : '' }}>Gasserine</option>
                                    <option value="Nabeul" {{ $reservation->car->pickup_location == 'Nabeul' ? 'selected' : '' }}>Nabeul</option>
                                    <option value="Mahdia" {{ $reservation->car->pickup_location == 'Mahdia' ? 'selected' : '' }}>Mahdia</option>
                                    <option value="Gabes" {{ $reservation->car->pickup_location == 'Gabes' ? 'selected' : '' }}>Gabes</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Lieu de retour</label>
                                <select name="return_location" class="form-select">
                                    <option value="">-- Sélectionnez --</option>
                                    <option value="Tunis" {{ $reservation->car->return_location == 'Tunis' ? 'selected' : '' }}>Tunis</option>
                                    <option value="Sfax" {{ $reservation->car->return_location == 'Sfax' ? 'selected' : '' }}>Sfax</option>
                                    <option value="Sousse" {{ $reservation->car->return_location == 'Sousse' ? 'selected' : '' }}>Sousse</option>
                                    <option value="Djerba" {{ $reservation->car->return_location == 'Djerba' ? 'selected' : '' }}>Djerba</option>
                                    <option value="Gasserine" {{ $reservation->car->return_location == 'Gasserine' ? 'selected' : '' }}>Gasserine</option>
                                    <option value="Nabeul" {{ $reservation->car->return_location == 'Nabeul' ? 'selected' : '' }}>Nabeul</option>
                                    <option value="Mahdia" {{ $reservation->car->return_location == 'Mahdia' ? 'selected' : '' }}>Mahdia</option>
                                    <option value="Gabes" {{ $reservation->car->return_location == 'Gabes' ? 'selected' : '' }}>Gabes</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Type de boîte</label>
                                <select name="gearbox_type" class="form-select" required>
                                    <option value="Automatique" {{ $reservation->car->gearbox_type == 'Automatique' ? 'selected' : '' }}>Automatique</option>
                                    <option value="Manuelle" {{ $reservation->car->gearbox_type == 'Manuelle' ? 'selected' : '' }}>Manuelle</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Tarifs et Paiement -->
                <div class="card mb-6">
                    <div class="card-header d-flex align-items-center gap-4">
                        <div class="p-3 bg-success bg-opacity-10 rounded-xl">
                            <i class="icon-base ti tabler-currency-dollar text-success text-xl"></i>
                        </div>
                        <h5 class="card-title mb-0 text-gray-800 uppercase tracking-wide">TARIFS ET PAIEMENT</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Prix/jour</label>
                                <input type="text" value="{{ $reservation->car->price_per_day }} DT" 
                                       class="form-control bg-gray-100" readonly>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Total</label>
                                <input type="text" value="{{ $reservation->car->price_per_day * $reservation->days }} DT"
                                       class="form-control bg-gray-100" readonly>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Méthode paiement</label>
                                <select name="payment_method" class="form-select">
                                    <option value="Espèce" {{ $reservation->payment_method == 'Espèce' ? 'selected' : '' }}>Espèce</option>
                                    <option value="Carte crédit" {{ $reservation->payment_method == 'Carte crédit' ? 'selected' : '' }}>Carte crédit</option>
                                    <option value="Cheque" {{ $reservation->payment_method == 'Cheque' ? 'selected' : '' }}>Chèque</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Statut paiement</label>
                                <select name="payment_status" class="form-select" required>
                                    <option value="non payé" {{ $reservation->payment_status == 'non payé' ? 'selected' : '' }}>Non payé</option>
                                    <option value="Partiellement payé" {{ $reservation->payment_status == 'Partiellement payé' ? 'selected' : '' }}>Partiellement payé</option>
                                    <option value="payed" {{ $reservation->payment_status == 'payed' ? 'selected' : '' }}>Payé</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Statut réservation</label>
                                <select name="status" class="form-select" required>
                                    <option value="en attente" {{ $reservation->status == 'en attente' ? 'selected' : '' }}>En attente</option>
                                    <option value="en cours" {{ $reservation->status == 'en cours' ? 'selected' : '' }}>En cours</option>
                                    <option value="confirmée" {{ $reservation->status == 'confirmée' ? 'selected' : '' }}>Confirmée</option>
                                    <option value="annulée" {{ $reservation->status == 'annulée' ? 'selected' : '' }}>Annulée</option>
                                    <option value="terminée" {{ $reservation->status == 'terminée' ? 'selected' : '' }}>Terminée</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Garantie</label>
                                <input type="text" name="garantie" value="{{ $reservation->garantie }}" 
                                       class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Deuxième Conducteur -->
<!-- Deuxième Conducteur -->
<div class="card mb-6">
    <div class="card-header d-flex align-items-center gap-4">
        <div class="p-3 bg-warning bg-opacity-10 rounded-xl">
            <i class="icon-base ti tabler-users text-warning text-xl"></i>
        </div>
        <h5 class="card-title mb-0 text-gray-800 uppercase tracking-wide">DEUXIÈME CONDUCTEUR</h5>
    </div>
    <div class="card-body">
        <!-- Input pour le CIN -->
        <div class="mb-4">
            <label class="form-label">CIN du deuxième conducteur</label>
            <input type="text" id="second_driver_cin" name="identity_number_conducteur" 
                   value="{{ $reservation->identity_number_conducteur ?? '' }}"
                   class="form-control" placeholder="Entrez le CIN du conducteur">
        </div>
        
        <!-- Bouton de recherche -->
        <button type="button" class="btn btn-primary mb-4" onclick="searchDriver()">
            <i class="ti ti-search me-1"></i> Rechercher
        </button>
        
        <!-- Messages d'état -->
        <div id="driver-message" class="mb-4"></div>
        
        <!-- Formulaire du conducteur - Toujours visible -->
        <div id="driver-form-container" class="row">
            <div class="col-md-6 mb-4">
                <label class="form-label">Prénom</label>
                <input type="text" name="first_name_conducteur" 
                       value="{{ $reservation->first_name_conducteur ?? '' }}" 
                       class="form-control">
            </div>
            <div class="col-md-6 mb-4">
                <label class="form-label">Nom</label>
                <input type="text" name="last_name_conducteur" 
                       value="{{ $reservation->last_name_conducteur ?? '' }}" 
                       class="form-control">
            </div>
            <div class="col-md-6 mb-4">
                <label class="form-label">Date de naissance</label>
                <input type="date" name="date_of_birth_conducteur" 
                       value="{{ $reservation->date_of_birth_conducteur ?? '' }}" 
                       class="form-control">
            </div>
            <div class="col-md-6 mb-4">
                <label class="form-label">Lieu de naissance</label>
                <input type="text" name="place_of_birth_conducteur" 
                       value="{{ $reservation->place_of_birth_conducteur ?? '' }}" 
                       class="form-control">
            </div>
            <div class="col-md-6 mb-4">
                <label class="form-label">Nationalité</label>
                <input type="text" name="nationality_conducteur" 
                       value="{{ $reservation->nationality_conducteur ?? '' }}" 
                       class="form-control">
            </div>
            <div class="col-md-6 mb-4">
                <label class="form-label">CIN</label>
                <input type="text" name="identity_number_conducteur" 
                       value="{{ $reservation->identity_number_conducteur ?? '' }}" 
                       class="form-control">
            </div>
            <div class="col-md-6 mb-4">
                <label class="form-label">Date CIN</label>
                <input type="date" name="identity_date_conducteur" 
                       value="{{ $reservation->identity_date_conducteur ?? '' }}" 
                       class="form-control">
            </div>
            <div class="col-md-6 mb-4">
                <label class="form-label">Permis</label>
                <input type="text" name="driver_license_number_conducteur" 
                       value="{{ $reservation->driver_license_number_conducteur ?? '' }}" 
                       class="form-control">
            </div>
            <div class="col-md-6 mb-4">
                <label class="form-label">Date permis</label>
                <input type="date" name="license_date_conducteur" 
                       value="{{ $reservation->license_date_conducteur ?? '' }}" 
                       class="form-control">
            </div>
            <div class="col-md-6 mb-4">
                <label class="form-label">Adresse</label>
                <input type="text" name="address_conducteur" 
                       value="{{ $reservation->address_conducteur ?? '' }}" 
                       class="form-control">
            </div>
            <div class="col-md-6 mb-4">
                <label class="form-label">Téléphone</label>
                <input type="text" name="mobile_number_conducteur" 
                       value="{{ $reservation->mobile_number_conducteur ?? '' }}" 
                       class="form-control">
            </div>
        </div>
    </div>
</div>

<script>
function searchDriver() {
    const cin = document.getElementById('second_driver_cin').value.trim();
    const messageContainer = document.getElementById('driver-message');
    
    if (!cin) {
        messageContainer.innerHTML = `
            <div class="alert alert-danger">
                <i class="ti ti-alert-circle me-2"></i> Veuillez entrer un numéro CIN valide.
            </div>
        `;
        return;
    }
    
    // Afficher un indicateur de chargement
    messageContainer.innerHTML = `
        <div class="alert alert-info">
            <i class="ti ti-loader me-2"></i> Recherche en cours...
        </div>
    `;
    
    // Faire une requête AJAX pour vérifier si le conducteur existe
    fetch(`/admin/drivers/search?cin=${encodeURIComponent(cin)}`, {
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erreur réseau');
        }
        return response.json();
    })
    .then(data => {
        if (data.success && data.driver) {
            // Conducteur trouvé - afficher message et pré-remplir
            messageContainer.innerHTML = `
                <div class="alert alert-success">
                    <i class="ti ti-user-check me-2"></i> Conducteur existant trouvé. Les champs ont été pré-remplis.
                </div>
            `;
            
            // Remplir automatiquement tous les champs
            document.querySelector('input[name="first_name_conducteur"]').value = data.driver.first_name || '';
            document.querySelector('input[name="last_name_conducteur"]').value = data.driver.last_name || '';
            document.querySelector('input[name="date_of_birth_conducteur"]').value = data.driver.date_of_birth || '';
            document.querySelector('input[name="place_of_birth_conducteur"]').value = data.driver.place_of_birth || '';
            document.querySelector('input[name="nationality_conducteur"]').value = data.driver.nationality || '';
            document.querySelector('input[name="identity_number_conducteur"]').value = data.driver.identity_number || '';
            document.querySelector('input[name="identity_date_conducteur"]').value = data.driver.identity_date || '';
            document.querySelector('input[name="driver_license_number_conducteur"]').value = data.driver.driver_license_number || '';
            document.querySelector('input[name="license_date_conducteur"]').value = data.driver.license_date || '';
            document.querySelector('input[name="address_conducteur"]').value = data.driver.address || '';
            document.querySelector('input[name="mobile_number_conducteur"]').value = data.driver.mobile_number || '';
            
        } else {
            // Aucun conducteur trouvé - afficher message mais garder le formulaire visible
            messageContainer.innerHTML = `
                <div class="alert alert-warning">
                    <i class="ti ti-user-x me-2"></i> Aucun conducteur trouvé avec ce CIN. Veuillez remplir les informations manuellement.
                </div>
            `;
            
            // On garde le CIN saisi dans le champ CIN
            document.querySelector('input[name="identity_number_conducteur"]').value = cin;
            
            // On vide les autres champs
            const fieldsToClear = [
                'first_name_conducteur', 'last_name_conducteur',
                'date_of_birth_conducteur', 'place_of_birth_conducteur',
                'nationality_conducteur', 'identity_date_conducteur',
                'driver_license_number_conducteur', 'license_date_conducteur',
                'address_conducteur', 'mobile_number_conducteur'
            ];
            
            fieldsToClear.forEach(field => {
                if (field !== 'identity_number_conducteur') {
                    document.querySelector(`input[name="${field}"]`).value = '';
                }
            });
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        messageContainer.innerHTML = `
            <div class="alert alert-danger">
                <i class="ti ti-alert-triangle me-2"></i> Erreur lors de la recherche: ${error.message}
            </div>
        `;
    });
}
</script>

<script>
    function loadDriverForm() {
        const cin = document.getElementById('second_driver_cin').value.trim();
        const messageContainer = document.getElementById('driver-message');
        const formContainer = document.getElementById('driver-form-container');
        
        if (!cin) {
            messageContainer.innerHTML = `
                <div class="alert alert-danger">
                    <i class="ti ti-alert-circle me-2"></i> Veuillez entrer un numéro CIN
                </div>
            `;
            return;
        }
        
        // Afficher un message de chargement
        messageContainer.innerHTML = `
            <div class="alert alert-info">
                <i class="ti ti-loader me-2"></i> Chargement du formulaire...
            </div>
        `;
        
        // Simuler un délai de chargement (à remplacer par votre appel AJAX)
        setTimeout(() => {
            // Ici vous devriez faire un appel AJAX pour récupérer les données
            // Pour l'exemple, nous allons juste afficher un formulaire vide
            
            messageContainer.innerHTML = `
                <div class="alert alert-success">
                    <i class="ti ti-check me-2"></i> Formulaire prêt à être rempli pour le CIN: ${cin}
                </div>
            `;
            
            // Afficher le formulaire vide
            formContainer.innerHTML = `
                <div class="col-md-6 mb-4">
                    <label class="form-label">Prénom</label>
                    <input type="text" name="first_name_conducteur" class="form-control" required>
                </div>
                <div class="col-md-6 mb-4">
                    <label class="form-label">Nom</label>
                    <input type="text" name="last_name_conducteur" class="form-control" required>
                </div>
                <div class="col-md-6 mb-4">
                    <label class="form-label">Date de naissance</label>
                    <input type="date" name="date_of_birth_conducteur" class="form-control">
                </div>
                <div class="col-md-6 mb-4">
                    <label class="form-label">Lieu de naissance</label>
                    <input type="text" name="place_of_birth_conducteur" class="form-control">
                </div>
                <div class="col-md-6 mb-4">
                    <label class="form-label">Nationalité</label>
                    <input type="text" name="nationality_conducteur" class="form-control">
                </div>
                <div class="col-md-6 mb-4">
                    <label class="form-label">CIN</label>
                    <input type="text" name="identity_number_conducteur" value="${cin}" class="form-control">
                </div>
                <div class="col-md-6 mb-4">
                    <label class="form-label">Permis</label>
                    <input type="text" name="driver_license_number_conducteur" class="form-control" required>
                </div>
                <div class="col-md-6 mb-4">
                    <label class="form-label">Téléphone</label>
                    <input type="text" name="mobile_number_conducteur" class="form-control">
                </div>
            `;
        }, 1000);
    }
</script>
<!-- Script pour le deuxième conducteur -->
<script>
    function searchDriver() {
        const cin = document.getElementById('second_driver_cin').value.trim();
        const resultContainer = document.getElementById('driver-search-result');
        const formContainer = document.getElementById('driver-form-container');
        
        if (!cin) {
            resultContainer.innerHTML = `
                <div class="alert alert-danger">
                    <i class="ti ti-alert-circle me-2"></i> Veuillez entrer un numéro CIN valide.
                </div>
            `;
            return;
        }
        
        // Afficher un indicateur de chargement
        resultContainer.innerHTML = `
            <div class="alert alert-info">
                <i class="ti ti-loader me-2"></i> Recherche en cours...
            </div>
        `;
        
        // Simuler une requête AJAX (remplacez par une vraie requête fetch)
        setTimeout(() => {
            // Ici vous devriez faire une vraie requête AJAX à votre backend
            // Pour l'exemple, je simule une réponse positive
            const driverFound = true; // Simuler un conducteur trouvé
            
            if (driverFound) {
                resultContainer.innerHTML = `
                    <div class="alert alert-success">
                        <i class="ti ti-user-check me-2"></i> Conducteur trouvé avec le CIN: ${cin}
                    </div>
                `;
                
                // Afficher le formulaire
                formContainer.style.display = 'block';
                formContainer.innerHTML = `
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Prénom</label>
                        <input type="text" name="first_name_conducteur" 
                               class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Nom</label>
                        <input type="text" name="last_name_conducteur" 
                               class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Date de naissance</label>
                        <input type="date" name="date_of_birth_conducteur" 
                               class="form-control">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Lieu de naissance</label>
                        <input type="text" name="place_of_birth_conducteur" 
                               class="form-control">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Nationalité</label>
                        <input type="text" name="nationality_conducteur" 
                               class="form-control">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label">CIN</label>
                        <input type="text" name="identity_number_conducteur" 
                               value="${cin}" 
                               class="form-control" readonly>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Date CIN</label>
                        <input type="date" name="identity_date_conducteur" 
                               class="form-control">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Permis</label>
                        <input type="text" name="driver_license_number_conducteur" 
                               class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Date permis</label>
                        <input type="date" name="license_date_conducteur" 
                               class="form-control">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Adresse</label>
                        <input type="text" name="address_conducteur" 
                               class="form-control">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Téléphone</label>
                        <input type="text" name="mobile_number_conducteur" 
                               class="form-control">
                    </div>
                `;
            } else {
                resultContainer.innerHTML = `
                    <div class="alert alert-warning">
                        <i class="ti ti-user-x me-2"></i> Aucun conducteur trouvé. Veuillez saisir les informations manuellement.
                    </div>
                `;
                
                // Afficher le formulaire vide
                formContainer.style.display = 'block';
                formContainer.innerHTML = `
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Prénom</label>
                        <input type="text" name="first_name_conducteur" 
                               class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Nom</label>
                        <input type="text" name="last_name_conducteur" 
                               class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Date de naissance</label>
                        <input type="date" name="date_of_birth_conducteur" 
                               class="form-control">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Lieu de naissance</label>
                        <input type="text" name="place_of_birth_conducteur" 
                               class="form-control">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Nationalité</label>
                        <input type="text" name="nationality_conducteur" 
                               class="form-control">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label">CIN</label>
                        <input type="text" name="identity_number_conducteur" 
                               value="${cin}" 
                               class="form-control">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Date CIN</label>
                        <input type="date" name="identity_date_conducteur" 
                               class="form-control">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Permis</label>
                        <input type="text" name="driver_license_number_conducteur" 
                               class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Date permis</label>
                        <input type="date" name="license_date_conducteur" 
                               class="form-control">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Adresse</label>
                        <input type="text" name="address_conducteur" 
                               class="form-control">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Téléphone</label>
                        <input type="text" name="mobile_number_conducteur" 
                               class="form-control">
                    </div>
                `;
            }
        }, 1000);
    }
</script>
                <!-- Boutons -->
                <div class="text-center pt-4">
                    <button type="submit" class="btn btn-primary px-6 py-3">
                        <i class="icon-base ti tabler-device-floppy me-1_5"></i>Enregistrer les modifications
                    </button>
                    <a href="{{ route('adminDashboard') }}" class="btn btn-label-secondary px-6 py-3 ms-3">
                        <i class="icon-base ti tabler-x me-1_5"></i>Annuler
                    </a>
                </div>
            </form>
            
            <!-- Script pour le deuxième conducteur -->
            <script>
                function searchDriver() {
                    const cin = document.getElementById('second_driver_cin').value.trim();
                    const resultContainer = document.getElementById('driver-search-result');
                    const formContainer = document.getElementById('driver-form-container');
                    
                    if (!cin) {
                        resultContainer.innerHTML = `
                            <div class="alert alert-danger">
                                <i class="ti ti-alert-circle me-2"></i> Veuillez entrer un numéro CIN valide.
                            </div>
                        `;
                        return;
                    }
                    
                    // Afficher un indicateur de chargement
                    resultContainer.innerHTML = `
                        <div class="alert alert-info">
                            <i class="ti ti-loader me-2"></i> Recherche en cours...
                        </div>
                    `;
                    
                    fetch(`/admin/drivers/search?cin=${encodeURIComponent(cin)}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Erreur réseau');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success && data.driver) {
                                resultContainer.innerHTML = `
                                    <div class="alert alert-success">
                                        <i class="ti ti-user-check me-2"></i> Conducteur trouvé: ${data.driver.first_name} ${data.driver.last_name}
                                    </div>
                                `;
                                
                                // Afficher le formulaire pré-rempli
                                formContainer.innerHTML = `
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Prénom</label>
                                            <input type="text" name="first_name_conducteur" 
                                                   value="${data.driver.first_name}" 
                                                   class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Nom</label>
                                            <input type="text" name="last_name_conducteur" 
                                                   value="${data.driver.last_name}" 
                                                   class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Date de naissance</label>
                                            <input type="date" name="date_of_birth_conducteur" 
                                                   value="${data.driver.date_of_birth}" 
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Lieu de naissance</label>
                                            <input type="text" name="place_of_birth_conducteur" 
                                                   value="${data.driver.place_of_birth}" 
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Nationalité</label>
                                            <input type="text" name="nationality_conducteur" 
                                                   value="${data.driver.nationality}" 
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">CIN</label>
                                            <input type="text" name="identity_number_conducteur" 
                                                   value="${data.driver.identity_number}" 
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Date CIN</label>
                                            <input type="date" name="identity_date_conducteur" 
                                                   value="${data.driver.identity_date}" 
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Permis</label>
                                            <input type="text" name="driver_license_number_conducteur" 
                                                   value="${data.driver.driver_license_number}" 
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Date permis</label>
                                            <input type="date" name="license_date_conducteur" 
                                                   value="${data.driver.license_date}" 
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Adresse</label>
                                            <input type="text" name="address_conducteur" 
                                                   value="${data.driver.address}" 
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Téléphone</label>
                                            <input type="text" name="mobile_number_conducteur" 
                                                   value="${data.driver.mobile_number}" 
                                                   class="form-control">
                                        </div>
                                    </div>
                                `;
                            } else {
                                resultContainer.innerHTML = `
                                    <div class="alert alert-warning">
                                        <i class="ti ti-user-x me-2"></i> Aucun conducteur trouvé. Veuillez saisir les informations manuellement.
                                    </div>
                                `;
                                
                                // Afficher un formulaire vide
                                formContainer.innerHTML = `
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Prénom</label>
                                            <input type="text" name="first_name_conducteur" 
                                                   class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Nom</label>
                                            <input type="text" name="last_name_conducteur" 
                                                   class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Date de naissance</label>
                                            <input type="date" name="date_of_birth_conducteur" 
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Lieu de naissance</label>
                                            <input type="text" name="place_of_birth_conducteur" 
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Nationalité</label>
                                            <input type="text" name="nationality_conducteur" 
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">CIN</label>
                                            <input type="text" name="identity_number_conducteur" 
                                                   value="${cin}" 
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Date CIN</label>
                                            <input type="date" name="identity_date_conducteur" 
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Permis</label>
                                            <input type="text" name="driver_license_number_conducteur" 
                                                   class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Date permis</label>
                                            <input type="date" name="license_date_conducteur" 
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Adresse</label>
                                            <input type="text" name="address_conducteur" 
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Téléphone</label>
                                            <input type="text" name="mobile_number_conducteur" 
                                                   class="form-control">
                                        </div>
                                    </div>
                                `;
                            }
                        })
                        .catch(error => {
                            console.error('Erreur:', error);
                            resultContainer.innerHTML = `
                                <div class="alert alert-danger">
                                    <i class="ti ti-alert-triangle me-2"></i> Une erreur s'est produite lors de la recherche.
                                </div>
                            `;
                        });
                }
            </script>
        </div>
    </div>
</div>
@endsection