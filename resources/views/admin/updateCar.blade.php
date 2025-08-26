@extends('admin.noname')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="app-ecommerce">
        <!-- Header Section -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
            <div class="d-flex flex-column justify-content-center">
               
            </div>
            <div class="d-flex align-content-center flex-wrap gap-4">
                <a href="{{ route('cars.index') }}" class="btn btn-label-secondary">
                    <i class="icon-base ti tabler-x me-1_5"></i>Annuler
                </a>
                <button type="submit" form="carForm" class="btn btn-primary">
                    <i class="icon-base ti tabler-device-floppy me-1_5"></i>Mettre à jour
                </button>
            </div>
        </div>

        <form id="carForm" action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <!-- Left Column - Car Details -->
                <div class="col-12 col-lg-8">
                    <!-- Car Information -->
                    <div class="card mb-6">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Informations sur la voiture</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Brand -->
                                <div class="col-sm-6 mb-4">
                                    <label for="brand" class="form-label">Marque <span class="text-danger">*</span></label>
                                    <input type="text" name="brand" id="brand" class="form-control" placeholder="Ex: Toyota" value="{{ old('brand', $car->brand) }}" required>
                                    @error('brand')
                                        <div class="text-danger mt-1 fs-tiny">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Model -->
                                <div class="col-sm-6 mb-4">
                                    <label for="model" class="form-label">Modèle <span class="text-danger">*</span></label>
                                    <input type="text" name="model" id="model" class="form-control" placeholder="Ex: Corolla" value="{{ old('model', $car->model) }}" required>
                                    @error('model')
                                        <div class="text-danger mt-1 fs-tiny">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Pickup Location -->
                                <div class="col-sm-6 mb-4">
                                    <label for="pickup_location" class="form-label">Lieu de départ</label>
                                    <input type="text" name="pickup_location" id="pickup_location" class="form-control" placeholder="Lieu de prise en charge" value="{{ old('pickup_location', $car->pickup_location) }}">
                                    @error('pickup_location')
                                        <div class="text-danger mt-1 fs-tiny">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Return Location -->
                                <div class="col-sm-6 mb-4">
                                    <label for="return_location" class="form-label">Lieu de retour</label>
                                    <input type="text" name="return_location" id="return_location" class="form-control" placeholder="Lieu de restitution" value="{{ old('return_location', $car->return_location) }}">
                                    @error('return_location')
                                        <div class="text-danger mt-1 fs-tiny">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Engine -->
                                <div class="col-sm-6 mb-4">
                                    <label for="engine" class="form-label">Moteur</label>
                                    <input type="text" name="engine" id="engine" class="form-control" placeholder="Type de moteur" value="{{ old('engine', $car->engine) }}">
                                    @error('engine')
                                        <div class="text-danger mt-1 fs-tiny">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Quantity -->
                                <div class="col-sm-6 mb-4">
                                    <label for="quantity" class="form-label">Quantité <span class="text-danger">*</span></label>
                                    <input type="number" name="quantity" id="quantity" class="form-control" min="1" value="{{ old('quantity', $car->quantity) }}" required>
                                    @error('quantity')
                                        <div class="text-danger mt-1 fs-tiny">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Matricule -->
                                <div class="col-sm-6 mb-4">
                                    <label for="matricule" class="form-label">Matricule</label>
                                    <input type="text" name="matricule" id="matricule" class="form-control" placeholder="Plaque d'immatriculation" value="{{ old('matricule', $car->matricule) }}">
                                    @error('matricule')
                                        <div class="text-danger mt-1 fs-tiny">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Gearbox Type -->
                                <div class="col-sm-6 mb-4">
                                    <label for="gearbox_type" class="form-label">Type de boîte</label>
                                    <select id="gearbox_type" name="gearbox_type" class="form-select">
                                        <option value="">-- Sélectionnez --</option>
                                        <option value="manuelle" {{ old('gearbox_type', $car->gearbox_type) == 'manuelle' ? 'selected' : '' }}>Manuelle</option>
                                        <option value="automatique" {{ old('gearbox_type', $car->gearbox_type) == 'automatique' ? 'selected' : '' }}>Automatique</option>
                                    </select>
                                    @error('gearbox_type')
                                        <div class="text-danger mt-1 fs-tiny">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Serial Number -->
                                <div class="col-sm-6 mb-4">
                                    <label for="numero_serie" class="form-label">Numéro de série</label>
                                    <input type="text" name="numero_serie" id="numero_serie" class="form-control" placeholder="Numéro de série" value="{{ old('numero_serie', $car->numero_serie) }}">
                                    @error('numero_serie')
                                        <div class="text-danger mt-1 fs-tiny">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- DPME Date -->
                                <div class="col-sm-6 mb-4">
                                    <label for="date_dpme" class="form-label">Date DPME</label>
                                    <input type="date" name="date_dpme" id="date_dpme" class="form-control" value="{{ old('date_dpme', $car->date_dpme) }}">
                                    @error('date_dpme')
                                        <div class="text-danger mt-1 fs-tiny">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- DDE Date -->
                                <div class="col-sm-6 mb-4">
                                    <label for="date_dde" class="form-label">Date DDE</label>
                                    <input type="date" name="date_dde" id="date_dde" class="form-control" value="{{ old('date_dde', $car->date_dde) }}">
                                    @error('date_dde')
                                        <div class="text-danger mt-1 fs-tiny">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Leasing Due Date -->
                                <div class="col-sm-6 mb-4">
                                    <label for="date_echeance_leasing" class="form-label">Échéance leasing</label>
                                    <input type="date" name="date_echeance_leasing" id="date_echeance_leasing" class="form-control" value="{{ old('date_echeance_leasing', $car->date_echeance_leasing) }}">
                                    @error('date_echeance_leasing')
                                        <div class="text-danger mt-1 fs-tiny">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Leasing Status -->
                                <div class="col-sm-6 mb-4">
                                    <label for="etat_echeance_leasing" class="form-label">État échéance</label>
                                    <select id="etat_echeance_leasing" name="etat_echeance_leasing" class="form-select">
                                        <option value="payé" {{ old('etat_echeance_leasing', $car->etat_echeance_leasing) == 'payé' ? 'selected' : '' }}>Payé</option>
                                        <option value="non payé" {{ old('etat_echeance_leasing', $car->etat_echeance_leasing) == 'non payé' ? 'selected' : '' }}>Non payé</option>
                                    </select>
                                    @error('etat_echeance_leasing')
                                        <div class="text-danger mt-1 fs-tiny">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Settlement -->
                                <div class="col-sm-6 mb-4">
                                    <label for="reglement" class="form-label">Règlement</label>
                                    <input type="text" name="reglement" id="reglement" class="form-control" placeholder="Détails de règlement" value="{{ old('reglement', $car->reglement) }}">
                                    @error('reglement')
                                        <div class="text-danger mt-1 fs-tiny">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Company Name -->
                                <div class="col-sm-6 mb-4">
                                    <label for="nom_societe" class="form-label">Nom société</label>
                                    <input type="text" name="nom_societe" id="nom_societe" class="form-control" placeholder="Nom de la société" value="{{ old('nom_societe', $car->nom_societe) }}">
                                    @error('nom_societe')
                                        <div class="text-danger mt-1 fs-tiny">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Car Image -->
                    <div class="card mb-6">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 card-title">Image de la voiture</h5>
                        </div>
                        <div class="card-body">
                            <div class="dropzone needsclick" id="imageDropzone">
                                @if($car->image)
                                    <div class="dz-preview d-flex flex-column align-items-center">
                                        <img src="{{ asset('storage/' . $car->image) }}" class="dz-image rounded mb-3" style="max-height: 200px; max-width: 100%;">
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-label-secondary" onclick="document.getElementById('carImage').click()">
                                                <i class="icon-base ti tabler-replace me-1_5"></i>Remplacer
                                            </button>
                                            <button type="button" class="btn btn-label-danger" onclick="resetDropzone()">
                                                <i class="icon-base ti tabler-trash me-1_5"></i>Supprimer
                                            </button>
                                        </div>
                                    </div>
                                @else
                                    <div class="dz-message needsclick">
                                        <div class="mb-3">
                                            <i class="icon-base ti tabler-photo fs-1 text-muted"></i>
                                        </div>
                                        <h5 class="mb-2">Glissez-déposez votre image ici</h5>
                                        <p class="text-body-secondary mb-4">ou</p>
                                        <button type="button" class="btn btn-label-primary" id="browseBtn">
                                            <i class="icon-base ti tabler-upload me-1_5"></i>Parcourir les fichiers
                                        </button>
                                    </div>
                                @endif
                                <input id="carImage" name="image" type="file" class="d-none" >
                                <input type="hidden" name="delete_image" id="delete_image" value="0">
                            </div>
                            @error('image')
                                <div class="text-danger mt-2 fs-tiny">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Right Column - Pricing & Status -->
                <div class="col-12 col-lg-4">
                    <!-- Pricing Card -->
                    <div class="card mb-6">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Tarification</h5>
                        </div>
                        <div class="card-body">
                            <!-- Price per Day -->
                            <div class="mb-4">
                                <label for="price_per_day" class="form-label">Prix/jour (DT) <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" name="price_per_day" id="price_per_day" class="form-control" placeholder="0.00" value="{{ old('price_per_day', $car->price_per_day) }}" required>
                                @error('price_per_day')
                                    <div class="text-danger mt-1 fs-tiny">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Seasonal Price -->
                            <div class="mb-4">
                                <label for="seasonal_price" class="form-label">Prix saisonnier (DT/jour)</label>
                                <input type="number" step="0.01" name="seasonal_price" id="seasonal_price" class="form-control" placeholder="0.00" value="{{ old('seasonal_price', $car->seasonal_price) }}">
                                @error('seasonal_price')
                                    <div class="text-danger mt-1 fs-tiny">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Summer Price -->
                            <div class="mb-4">
                                <label for="summer_price" class="form-label">Prix été (DT/jour)</label>
                                <input type="number" step="0.01" name="summer_price" id="summer_price" class="form-control" placeholder="0.00" value="{{ old('summer_price', $car->summer_price) }}">
                                @error('summer_price')
                                    <div class="text-danger mt-1 fs-tiny">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Discount -->
                            <div class="mb-4">
                                <label for="reduce" class="form-label">Réduction (%)</label>
                                <input type="number" name="reduce" id="reduce" class="form-control" placeholder="0" min="0" max="100" value="{{ old('reduce', $car->reduce) }}">
                                @error('reduce')
                                    <div class="text-danger mt-1 fs-tiny">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Status Card -->
                    <div class="card mb-6">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Statut et évaluation</h5>
                        </div>
                        <div class="card-body">
                            <!-- Stars Rating -->
                            <div class="mb-4">
                                <label for="stars" class="form-label">Évaluation</label>
                                <select id="stars" name="stars" class="form-select">
                                    <option value="5" {{ old('stars', $car->stars) == '5' ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5/5)</option>
                                    <option value="4" {{ old('stars', $car->stars) == '4' ? 'selected' : '' }}>⭐⭐⭐⭐ (4/5)</option>
                                    <option value="3" {{ old('stars', $car->stars) == '3' ? 'selected' : '' }}>⭐⭐⭐ (3/5)</option>
                                    <option value="2" {{ old('stars', $car->stars) == '2' ? 'selected' : '' }}>⭐⭐ (2/5)</option>
                                    <option value="1" {{ old('stars', $car->stars) == '1' ? 'selected' : '' }}>⭐ (1/5)</option>
                                </select>
                                @error('stars')
                                    <div class="text-danger mt-1 fs-tiny">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Status -->
                            <div class="mb-4">
                                <label for="status" class="form-label">Statut de disponibilité <span class="text-danger">*</span></label>
                                <select id="status" name="status" class="form-select" required>
                                    <option value="">-- Sélectionnez --</option>
                                    <option value="available" {{ old('status', $car->status) == 'available' ? 'selected' : '' }}>Disponible</option>
                                    <option value="unavailable" {{ old('status', $car->status) == 'unavailable' ? 'selected' : '' }}>Indisponible</option>
                                </select>
                                @error('status')
                                    <div class="text-danger mt-1 fs-tiny">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- In Stock Toggle -->
                            <div class="d-flex justify-content-between align-items-center border-top pt-3 mt-3">
                                <label class="form-label mb-0">En stock</label>
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" checked>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropzone = document.getElementById('imageDropzone');
        const fileInput = document.getElementById('carImage');
        const browseBtn = document.getElementById('browseBtn');
        
        if (dropzone && browseBtn) {
            // Ouvrir le sélecteur de fichiers au clic
            browseBtn.addEventListener('click', () => fileInput.click());
        }
        
        if (fileInput) {
            // Gestion du changement de fichier
            fileInput.addEventListener('change', function() {
                if (this.files.length) handleFileSelection(this.files[0]);
            });
        }
        
        if (dropzone) {
            // Gestion du drag & drop
            ['dragover', 'dragenter'].forEach(event => {
                dropzone.addEventListener(event, (e) => {
                    e.preventDefault();
                    dropzone.classList.add('border-primary', 'bg-lighter');
                }, false);
            });
            
            ['dragleave', 'drop'].forEach(event => {
                dropzone.addEventListener(event, (e) => {
                    e.preventDefault();
                    dropzone.classList.remove('border-primary', 'bg-lighter');
                    
                    if (event === 'drop' && e.dataTransfer.files.length) {
                        handleFileSelection(e.dataTransfer.files[0]);
                    }
                }, false);
            });
            
            // Gérer la sélection de fichier
            function handleFileSelection(file) {
                if (!file.type.match('image.*')) {
                    alert('Veuillez sélectionner une image valide (JPG, PNG, GIF)');
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    dropzone.innerHTML = `
                        <div class="dz-preview d-flex flex-column align-items-center">
                            <img src="${e.target.result}" class="dz-image rounded mb-3" style="max-height: 200px; max-width: 100%;">
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-label-secondary" onclick="document.getElementById('carImage').click()">
                                    <i class="icon-base ti tabler-replace me-1_5"></i>Remplacer
                                </button>
                                <button type="button" class="btn btn-label-danger" onclick="resetDropzone()">
                                    <i class="icon-base ti tabler-trash me-1_5"></i>Supprimer
                                </button>
                            </div>
                        </div>
                    `;
                };
                reader.readAsDataURL(file);
            }
            
            // Réinitialiser la dropzone (définie dans l'espace global)
            window.resetDropzone = function() {
                
                fileInput.value = '';
                // Signale au backend qu'il faut supprimer l'image
                document.getElementById('delete_image').value = '1';
                dropzone.innerHTML = `
                    <div class="dz-message needsclick">
                        <div class="mb-3">
                            <i class="icon-base ti tabler-photo fs-1 text-muted"></i>
                        </div>
                        <h5 class="mb-2">Glissez-déposez votre image ici</h5>
                        <p class="text-body-secondary mb-4">ou</p>
                        <button type="button" class="btn btn-label-primary" id="browseBtn">
                            <i class="icon-base ti tabler-upload me-1_5"></i>Parcourir les fichiers
                        </button>
                    </div>
                `;
                attachBrowseBtnEvent(); // <--- Ajoute ceci ici
            };
        }
    });

    function attachBrowseBtnEvent() {
        const browseBtn = document.getElementById('browseBtn');
        if (browseBtn) {
            browseBtn.addEventListener('click', () => fileInput.click());
        }
    }

    // Appelle cette fonction au chargement
    attachBrowseBtnEvent();
</script>
@endpush