@extends('admin.noname')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <form method="POST" action="{{ route('cars.update', $car->id) }}">
        @csrf
        @method('PUT')
        
        <div class="row">
            <!-- Voiture Sidebar (INTACTE) -->
            <div class="col-xl-4 col-lg-5 order-1 order-md-0">
                <!-- Voiture Card -->
                <div class="card mb-6">
                    <div class="card-body pt-12">
                        <div class="user-avatar-section">
                            <div class="d-flex align-items-center flex-column">
                                                                   <img loading="lazy" src="{{ asset($car->image) }}" alt="car image">

                                <div class="user-info text-center">
                                    <h5>{{ $car->brand }} {{ $car->model }}</h5>
                                    <span class="badge bg-label-{{ $car->isActive() ? 'success' : 'danger' }}">
                                        {{ $car->isActive() ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-around flex-wrap my-6 gap-0 gap-md-3 gap-lg-4">
                            <div class="d-flex align-items-center me-5 gap-4">
                                <div class="avatar">
                                    <div class="avatar-initial bg-label-primary rounded">
                                        <i class="icon-base ti tabler-calendar icon-lg"></i>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="mb-0">{{ $car->year }}</h5>
                                    <span>Année</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-4">
                                <div class="avatar">
                                    <div class="avatar-initial bg-label-primary rounded">
                                        <i class="icon-base ti tabler-gas-station icon-lg"></i>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="mb-0">{{ $car->fuel_type }}</h5>
                                    <span>Carburant</span>
                                </div>
                            </div>
                        </div>
                        <h5 class="pb-4 border-bottom mb-4">Détails</h5>
                        <div class="info-container">
                            <ul class="list-unstyled mb-6">
                                <li class="mb-2">
                                    <span class="h6">Marque:</span>
                                    <input type="text" name="brand" class="form-control" value="{{ $car->brand }}" required>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Modèle:</span>
                                    <input type="text" name="model" class="form-control" value="{{ $car->model }}" required>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Immatriculation:</span>
                                    <input type="text" name="matricule" class="form-control" value="{{ $car->matricule }}" required>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Statut:</span>
                                    <select name="status" class="form-select">
                                        <option value="active" {{ $car->isActive() ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ !$car->isActive() ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Prix/jour:</span>
                                    <input type="number" step="0.01" name="price_per_day" class="form-control" value="{{ $car->price_per_day }}" required>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Disponibilité:</span>
                                    <input type="number" name="quantity" class="form-control" value="{{ $car->quantity }}" required min="1">
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Type de transmission:</span>
                                    <select name="transmission" class="form-select">
                                        <option value="Manuelle" {{ $car->transmission == 'Manuelle' ? 'selected' : '' }}>Manuelle</option>
                                        <option value="Automatique" {{ $car->transmission == 'Automatique' ? 'selected' : '' }}>Automatique</option>
                                    </select>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Couleur:</span>
                                    <input type="text" name="color" class="form-control" value="{{ $car->color }}">
                                </li>
                            </ul>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary me-4">
                                    Enregistrer
                                </button>
                                <form method="POST" action="{{ route('cars.destroy', $car->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-label-danger" 
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette voiture?')">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Voiture Card -->
                
                <!-- Stats Card -->
                <div class="card mb-6 border border-2 border-primary rounded primary-shadow">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <span class="badge bg-label-primary">Statistiques</span>
                            <div class="d-flex justify-content-center">
                                <sub class="h5 pricing-currency mb-auto mt-1 text-primary">DT</sub>
                                <h1 class="mb-0 text-primary">{{ number_format($car->reservations->sum('total_price'), 0) }}</h1>
                            </div>
                        </div>
                        <ul class="list-unstyled g-2 my-6">
                            <li class="mb-2 d-flex align-items-center">
                                <i class="icon-base ti tabler-circle-filled icon-10px text-secondary me-2"></i>
                                <span>Revenu total</span>
                            </li>
                            <li class="mb-2 d-flex align-items-center">
                                <i class="icon-base ti tabler-circle-filled icon-10px text-secondary me-2"></i>
                                <span>{{ $car->reservations->count() }} réservations</span>
                            </li>
                            <li class="mb-2 d-flex align-items-center">
                                <i class="icon-base ti tabler-circle-filled icon-10px text-secondary me-2"></i>
                                <span>{{ $car->activeReservations()->count() }} actives</span>
                            </li>
                        </ul>
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="h6 mb-0">Disponibilité</span>
                            <span class="h6 mb-0">{{ $car->quantity }} / {{ $car->quantity + $car->activeReservations()->count() }}</span>
                        </div>
                        <div class="progress mb-1 bg-label-primary" style="height: 6px">
                            <div
                                class="progress-bar"
                                role="progressbar"
                                style="width: {{ ($car->quantity / ($car->quantity + $car->activeReservations()->count())) * 100 }}%"
                                aria-valuenow="{{ $car->quantity }}"
                                aria-valuemin="0"
                                aria-valuemax="{{ $car->quantity + $car->activeReservations()->count() }}"></div>
                        </div>
                        <small>{{ $car->activeReservations()->count() }} réservations actives</small>
                        <div class="d-grid w-100 mt-6">
                            <a href="{{ route('cars.index') }}" class="btn btn-primary">
                                Retour à la liste
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /Stats Card -->
            </div>
            <!--/ Voiture Sidebar -->

            <!-- Voiture Content avec système d'onglets -->
            <div class="col-xl-8 col-lg-7 order-0 order-md-1">
                <!-- Voiture Pills avec onglets Bootstrap -->
                <div class="nav-align-top">
                    <ul class="nav nav-pills flex-column flex-md-row flex-wrap mb-6 row-gap-2" id="carTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="true">
                                <i class="icon-base ti tabler-car icon-sm me-1_5"></i>Détails
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="assurance-tab" data-bs-toggle="tab" data-bs-target="#assurance" type="button" role="tab" aria-controls="assurance" aria-selected="false">
                                <i class="icon-base ti tabler-calendar icon-sm me-1_5"></i>Assurances
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="entretien-tab" data-bs-toggle="tab" data-bs-target="#entretien" type="button" role="tab" aria-controls="entretien" aria-selected="false">
                                <i class="icon-base ti tabler-chart-bar icon-sm me-1_5"></i>Entretien
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="visite-tab" data-bs-toggle="tab" data-bs-target="#visite" type="button" role="tab" aria-controls="visite" aria-selected="false">
                                <i class="icon-base ti tabler-file-text icon-sm me-1_5"></i>Visite technique
                            </button>
                        </li>
                    </ul>
                    
                    <!-- Contenu des onglets -->
                    <div class="tab-content" id="carTabsContent">
                        <!-- Onglet Détails (actif par défaut) -->
                        <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
                            <!-- Informations techniques -->
                            <div class="card mb-6">
                                <h5 class="card-header">Informations techniques</h5>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <ul class="list-unstyled">
                                                <li class="mb-3">
                                                    <span class="text-muted">Moteur:</span>
                                                    <input type="text" name="engine" class="form-control" value="{{ $car->engine }}">
                                                </li>
                                                <li class="mb-3">
                                                    <span class="text-muted">Boîte de vitesse:</span>
                                                    <select name="gearbox_type" class="form-select">
                                                        <option value="Manuelle" {{ $car->gearbox_type == 'Manuelle' ? 'selected' : '' }}>Manuelle</option>
                                                        <option value="Automatique" {{ $car->gearbox_type == 'Automatique' ? 'selected' : '' }}>Automatique</option>
                                                    </select>
                                                </li>
                                                <li class="mb-3">
                                                    <span class="text-muted">Numéro de série:</span>
                                                    <input type="text" name="numero_serie" class="form-control" value="{{ $car->numero_serie }}">
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <ul class="list-unstyled">
                                                <li class="mb-3">
                                                    <span class="text-muted">Kilométrage:</span>
                                                    <input type="number" name="mileage" class="form-control" value="{{ $car->mileage }}">
                                                </li>
                                                <li class="mb-3">
                                                    <span class="text-muted">Couleur:</span>
                                                    <span class="fw-medium">{{ $car->color }}</span>
                                                </li>
                                                <li class="mb-3">
                                                    <span class="text-muted">Type de carburant:</span>
                                                    <select name="fuel_type" class="form-select">
                                                        <option value="Essence" {{ $car->fuel_type == 'Essence' ? 'selected' : '' }}>Essence</option>
                                                        <option value="Diesel" {{ $car->fuel_type == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                                                        <option value="Hybride" {{ $car->fuel_type == 'Hybride' ? 'selected' : '' }}>Hybride</option>
                                                        <option value="Électrique" {{ $car->fuel_type == 'Électrique' ? 'selected' : '' }}>Électrique</option>
                                                    </select>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Informations tarifaires -->
                            <div class="card mb-6">
                                <h5 class="card-header">Informations tarifaires</h5>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <ul class="list-unstyled">
                                                <li class="mb-3">
                                                    <label class="text-muted mb-1" for="price_per_day">Prix par jour:</label>
                                                    <input type="number" step="0.01" name="price_per_day" id="price_per_day" class="form-control" value="{{ $car->price_per_day }}">
                                                </li>
                                                <li class="mb-3">
                                                    <label class="text-muted mb-1" for="seasonal_price">Prix saisonnier:</label>
                                                    <input type="number" step="0.01" name="seasonal_price" id="seasonal_price" class="form-control" value="{{ $car->seasonal_price }}">
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <ul class="list-unstyled">
                                                <li class="mb-3">
                                                    <label class="text-muted mb-1" for="summer_price">Prix été:</label>
                                                    <input type="number" step="0.01" name="summer_price" id="summer_price" class="form-control" value="{{ $car->summer_price }}">
                                                </li>
                                                <li class="mb-3">
                                                    <label class="text-muted mb-1" for="reduce">Réduction:</label>
                                                    <div class="input-group">
                                                        <input type="number" name="reduce" id="reduce" class="form-control" value="{{ $car->reduce }}" min="0" max="100">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Réservations actives -->
                            <div class="card mb-6">
                                <h5 class="card-header">Réservations actives</h5>
                                <div class="card-body pt-1">
                                    @if ($car->activeReservations()->isEmpty())
                                        <div class="alert alert-info">Aucune réservation active pour cette voiture.</div>
                                    @else
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Client</th>
                                                        <th>Date de début</th>
                                                        <th>Date de fin</th>
                                                        <th>Montant</th>
                                                        <th>Statut</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($car->activeReservations() as $res)
                                                        <tr>
                                                            <td>
                                                                @if($res->client)
                                                                    {{ $res->client->first_name }} {{ $res->client->last_name }}
                                                                @else
                                                                    Client inconnu
                                                                @endif
                                                            </td>
                                                            <td>{{ $res->start_date ? \Carbon\Carbon::parse($res->start_date)->format('d/m/Y') : 'N/A' }}</td>
                                                            <td>{{ $res->end_date ? \Carbon\Carbon::parse($res->end_date)->format('d/m/Y') : 'N/A' }}</td>
                                                            <td>{{ number_format($res->total_price, 2) }} dt</td>
                                                            <td>
                                                                <span class="badge bg-label-success">Active</span>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Historique des modifications -->
                            <div class="card mb-6">
                                <h5 class="card-header">Historique des modifications</h5>
                                <div class="card-body pt-1">
                                    <ul class="timeline mb-0">
                                        <li class="timeline-item timeline-item-transparent">
                                            <span class="timeline-point timeline-point-primary"></span>
                                            <div class="timeline-event">
                                                <div class="timeline-header mb-3">
                                                    <h6 class="mb-0">Voiture créée</h6>
                                                    <small class="text-body-secondary">
                                                        @if($car->created_at)
                                                            {{ $car->created_at->diffForHumans() }}
                                                        @else
                                                            Date inconnue
                                                        @endif
                                                    </small>
                                                </div>
                                                <p class="mb-2">
                                                    Ajoutée par: Admin<br>
                                                    Matricule: {{ $car->matricule }}
                                                </p>
                                            </div>
                                        </li>

                                        @if($car->updated_at && $car->updated_at->ne($car->created_at))
                                        <li class="timeline-item timeline-item-transparent">
                                            <span class="timeline-point timeline-point-info"></span>
                                            <div class="timeline-event">
                                                <div class="timeline-header mb-3">
                                                    <h6 class="mb-0">Dernière modification</h6>
                                                    <small class="text-body-secondary">
                                                        @if($car->updated_at)
                                                            {{ $car->updated_at->diffForHumans() }}
                                                        @else
                                                            Date inconnue
                                                        @endif
                                                    </small>
                                                </div>
                                                <p class="mb-2">
                                                    Modifiée par: Admin<br>
                                                    Changements: Détails techniques
                                                </p>
                                            </div>
                                        </li>
                                        @endif
                                        
                                        @foreach($car->reservations->sortByDesc('created_at')->take(2) as $reservation)
                                        <li class="timeline-item timeline-item-transparent">
                                            <span class="timeline-point timeline-point-success"></span>
                                            <div class="timeline-event">
                                                <div class="timeline-header mb-3">
                                                    <h6 class="mb-0">Nouvelle réservation</h6>
                                                    <small class="text-body-secondary">
                                                        @if($reservation->created_at)
                                                            {{ $reservation->created_at->diffForHumans() }}
                                                        @else
                                                            Date inconnue
                                                        @endif
                                                    </small>
                                                </div>
                                                <p class="mb-2">
                                                    Client: {{ $reservation->client->first_name ?? 'N/A' }} {{ $reservation->client->last_name ?? '' }}<br>
                                                    Période: 
                                                    @if($reservation->start_date)
                                                        {{ \Carbon\Carbon::parse($reservation->start_date)->format('d/m/Y') }} 
                                                    @else
                                                        -
                                                    @endif
                                                    à 
                                                    @if($reservation->end_date)
                                                        {{ \Carbon\Carbon::parse($reservation->end_date)->format('d/m/Y') }}
                                                    @else
                                                        -
                                                    @endif
                                                </p>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Onglet Assurance -->
                        <div class="tab-pane fade" id="assurance" role="tabpanel" aria-labelledby="assurance-tab">
                             <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="nom_assurance" class="form-label">Nom de l'assurance</label>
                            <input type="text" id="nom_assurance" name="nom_assurance"
                                   value="{{ old('nom_assurance', optional($car->assurances->first())->nom) }}"
                                   class="form-control" />
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="montant_assurance" class="form-label">Montant (€)</label>
                            <input type="number" step="0.01" min="0" id="montant_assurance" name="montant_assurance"
                                   value="{{ old('montant_assurance', optional($car->assurances->first())->montant) }}"
                                   class="form-control" />
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="date_debut_assurance" class="form-label">Date de début</label>
                            <input type="date" id="date_debut_assurance" name="date_debut_assurance"
                                   value="{{ old('date_debut_assurance', optional($car->assurances->first())->date_debut) }}"
                                   class="form-control" />
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="date_fin_assurance" class="form-label">Date de fin</label>
                            <input type="date" id="date_fin_assurance" name="date_fin_assurance"
                                   value="{{ old('date_fin_assurance', optional($car->assurances->first())->date_fin) }}"
                                   class="form-control" />
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="jours_restants_assurance" class="form-label">Jours restants</label>
                            <input type="text" id="jours_restants_assurance" name="jours_restants_assurance" readonly
                                   value="{{ old('jours_restants_assurance', optional($car->assurances->first())->jours_restants) }}"
                                   class="form-control bg-gray-100" />
                        </div>
                    </div>
                </div>
                        </div>
                        
                        <!-- Onglet Entretien -->
                        <div class="tab-pane fade" id="entretien" role="tabpanel" aria-labelledby="entretien-tab">
                              <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <label for="kilometrage" class="form-label">Kilométrage</label>
                            <input type="number" id="kilometrage" name="kilometrage"
                                   value="{{ old('kilometrage', optional($car->entretiens->first())->kilometrage) }}" min="0"
                                   class="form-control" />
                        </div>

                        <div class="col-md-4 mb-4">
                            <label for="type_entretien" class="form-label">Type d'entretien</label>
                            <input type="text" id="type_entretien" name="type_entretien"
                                   value="{{ old('type_entretien', optional($car->entretiens->first())->type_entretien) }}"
                                   class="form-control" />
                        </div>

                        <div class="col-md-4 mb-4">
                            <label for="date_entretien" class="form-label">Date d'entretien</label>
                            <input type="date" id="date_entretien" name="date_entretien"
                                   value="{{ old('date_entretien', optional($car->entretiens->first())->date_entretien) }}"
                                   class="form-control" />
                        </div>

                        <div class="col-md-4 mb-4">
                            <label for="date_prochain_entretien" class="form-label">Date prochain entretien</label>
                            <input type="date" id="date_prochain_entretien" name="date_prochain_entretien"
                                   value="{{ old('date_prochain_entretien', optional($car->entretiens->first())->date_prochain_entretien) }}"
                                   class="form-control" />
                        </div>

                        <div class="col-md-4 mb-4">
                            <label for="kilometrage_prochain_entretien" class="form-label">Kilométrage prochain entretien</label>
                            <input type="number" id="kilometrage_prochain_entretien" name="kilometrage_prochain_entretien" min="0"
                                   value="{{ old('kilometrage_prochain_entretien', optional($car->entretiens->first())->kilometrage_prochain_entretien) }}"
                                   class="form-control" />
                        </div>

                        <div class="col-md-4 mb-4">
                            <label for="jours_restants_entretien" class="form-label">Jours Restants</label>
                            <input type="text" id="jours_restants_entretien" name="jours_restants_entretien" readonly
                                   class="form-control bg-gray-100" />
                        </div>

                        <div class="col-md-12 mb-4">
                            <label for="remarque" class="form-label">Remarque</label>
                            <textarea id="remarque" name="remarque" rows="3"
                                      class="form-control">{{ old('remarque', optional($car->entretiens->first())->remarque) }}</textarea>
                        </div>
                    </div>
                </div>
                        </div>
                        
                        <!-- Onglet Visite Technique -->
                        <div class="tab-pane fade" id="visite" role="tabpanel" aria-labelledby="visite-tab">
                            <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <label for="date_visite" class="form-label">Date de visite</label>
                            <input type="date" id="date_visite" name="date_visite"
                                   value="{{ old('date_visite', optional($car->visitesTechniques->first())->date_visite) }}"
                                   class="form-control" />
                            @error('date_visite')<p class="text-danger mt-1 fs-tiny">{{ $message }}</p>@enderror
                        </div>

                        <div class="col-md-4 mb-4">
                            <label for="jours_restants_visite" class="form-label">Jours Restants</label>
                            <input type="text" id="jours_restants_visite" name="jours_restants_visite" readonly
                                   value="{{ old('jours_restants_visite', optional($car->visitesTechniques->first())->jours_restants) }}"
                                   class="form-control bg-gray-100" />
                        </div>

                        <div class="col-md-4 mb-4">
                            <label for="kilometrage" class="form-label">Kilométrage</label>
                            <input type="number" id="kilometrage" name="kilometrage"
                                   value="{{ old('kilometrage', optional($car->visitesTechniques->first())->kilometrage) }}"
                                   class="form-control" />
                            @error('kilometrage')<p class="text-danger mt-1 fs-tiny">{{ $message }}</p>@enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="date_prochain_visite" class="form-label">Date prochaine visite</label>
                            <input type="date" id="date_prochain_visite" name="date_prochain_visite"
                                   value="{{ old('date_prochain_visite', optional($car->visitesTechniques->first())->date_prochain_visite) }}"
                                   class="form-control" />
                            @error('date_prochain_visite')<p class="text-danger mt-1 fs-tiny">{{ $message }}</p>@enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="remarque" class="form-label">Remarque</label>
                            <textarea id="remarque" name="remarque" rows="3"
                                      class="form-control">{{ old('remarque', optional($car->visitesTechniques->first())->remarque) }}</textarea>
                            @error('remarque')<p class="text-danger mt-1 fs-tiny">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Voiture Content -->
        </div>
    </form>
    
    <!-- Modal pour ajouter une assurance -->
    <div class="modal fade" id="addAssuranceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter une assurance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('assurances.store') }}">
                    @csrf
                    <input type="hidden" name="car_id" value="{{ $car->id }}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nom de l'assurance</label>
                            <input type="text" name="nom" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Date début</label>
                                <input type="date" name="date_debut" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Date fin</label>
                                <input type="date" name="date_fin" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Montant (DT)</label>
                            <input type="number" step="0.01" name="montant" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    /* Style minimal pour les champs de formulaire */
    .form-control {
        border: 1px solid #d9dee3;
        border-radius: 0.375rem;
        padding: 0.4375rem 0.875rem;
        font-size: 0.9375rem;
        height: calc(1.5em + 0.875rem + 2px);
        background-color: #fff;
        color: #697a8d;
    }
    
    .form-select {
        border: 1px solid #d9dee3;
        border-radius: 0.375rem;
        padding: 0.4375rem 0.875rem;
        font-size: 0.9375rem;
        height: calc(1.5em + 0.875rem + 2px);
        background-color: #fff;
        color: #697a8d;
    }
    
    .input-group-text {
        background-color: #f5f5f9;
        border: 1px solid #d9dee3;
    }
    
    /* Styles pour les onglets */
    .nav-pills .nav-link {
        transition: all 0.3s ease;
    }
    
    .nav-pills .nav-link.active {
        background: linear-gradient(135deg, #4361ee 0%, #3f37c9 100%);
        color: white;
        box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3);
    }
    
    .tab-content {
        padding-top: 20px;
    }
    
    /* Style pour le tableau des assurances */
    .table-hover tbody tr:hover {
        background-color: rgba(67, 97, 238, 0.05);
    }
</style>

<!-- Ajouter Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>