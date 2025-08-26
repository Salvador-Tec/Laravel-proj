@extends('admin.noname')

@section('content')


        <form action="{{ route('cars.store') }}" method="POST"  enctype="multipart/form-data">
        <div class="container-xxl flex-grow-1 container-p-y">
    <div class="app-ecommerce">
        <!-- Header Section -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
            <div class="d-flex flex-column justify-content-center">
                
            </div>
            <div class="d-flex justify-content-start gap-4 mt-5">
                <a href="{{ route('cars.index') }}" class="btn btn-label-secondary">
                    <i class="icon-base ti tabler-x me-1_5"></i>Annuler
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="icon-base ti tabler-device-floppy me-1_5"></i>Enregistrer
                </button>
            </div>
        </div>  
            @csrf
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
                                    <label for="brand" class="form-label">Marque</label>
                                    <input type="text" name="brand" id="brand" class="form-control" placeholder="Ex: Toyota">
                                    @error('brand')
                                        <span class="text-danger fs-tiny">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <!-- Model -->
                                <div class="col-sm-6 mb-4">
                                    <label for="model" class="form-label">Modèle</label>
                                    <input type="text" name="model" id="model" class="form-control" placeholder="Ex: Corolla">
                                    @error('model')
                                        <span class="text-danger fs-tiny">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <!-- Pickup Location -->
                                <div class="col-sm-6 mb-4">
                                    <label for="pickup_location" class="form-label">Départ</label>
                                    <input type="text" name="pickup_location" id="pickup_location" class="form-control" placeholder="Lieu de prise en charge">
                                    @error('pickup_location')
                                        <span class="text-danger fs-tiny">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <!-- Return Location -->
                                <div class="col-sm-6 mb-4">
                                    <label for="return_location" class="form-label">Arrivé</label>
                                    <input type="text" name="return_location" id="return_location" class="form-control" placeholder="Lieu de retour">
                                    @error('return_location')
                                        <span class="text-danger fs-tiny">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <!-- Engine -->
                                <div class="col-sm-6 mb-4">
                                    <label for="engine" class="form-label">Moteur</label>
                                    <input type="text" name="engine" id="engine" class="form-control" placeholder="Type de moteur">
                                    @error('engine')
                                        <span class="text-danger fs-tiny">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <!-- Quantity -->
                                <div class="col-sm-6 mb-4">
                                    <label for="quantity" class="form-label">Quantité</label>
                                    <input type="number" name="quantity" id="quantity" class="form-control" min="1" value="1">
                                    @error('quantity')
                                        <span class="text-danger fs-tiny">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <!-- Matricule -->
                                <div class="col-sm-6 mb-4">
                                    <label for="matricule" class="form-label">Matricule</label>
                                    <input type="text" name="matricule" id="matricule" class="form-control" placeholder="Plaque d'immatriculation">
                                    @error('matricule')
                                        <span class="text-danger fs-tiny">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <!-- Gearbox Type -->
                                <div class="col-sm-6 mb-4">
                                    <label for="gearbox_type" class="form-label">Type de boîte</label>
                                    <select id="gearbox_type" name="gearbox_type" class="form-select">
                                        <option value="">-- Sélectionnez --</option>
                                        <option value="manuelle">Manuelle</option>
                                        <option value="automatique">Automatique</option>
                                    </select>
                                    @error('gearbox_type')
                                        <span class="text-danger fs-tiny">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <!-- Serial Number -->
                                <div class="col-sm-6 mb-4">
                                    <label for="numero_serie" class="form-label">Numéro de série</label>
                                    <input type="text" name="numero_serie" id="numero_serie" class="form-control" placeholder="Numéro de série">
                                    @error('numero_serie')
                                        <span class="text-danger fs-tiny">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <!-- DPME Date -->
                                <div class="col-sm-6 mb-4">
                                    <label for="date_dpme" class="form-label">Date DPME</label>
                                    <input type="date" name="date_dpme" id="date_dpme" class="form-control">
                                    @error('date_dpme')
                                        <span class="text-danger fs-tiny">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <!-- DDE Date -->
                                <div class="col-sm-6 mb-4">
                                    <label for="date_dde" class="form-label">Date DDE</label>
                                    <input type="date" name="date_dde" id="date_dde" class="form-control">
                                    @error('date_dde')
                                        <span class="text-danger fs-tiny">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <!-- Leasing Due Date -->
                                <div class="col-sm-6 mb-4">
                                    <label for="date_echeance_leasing" class="form-label">Échéance leasing</label>
                                    <input type="date" name="date_echeance_leasing" id="date_echeance_leasing" class="form-control">
                                    @error('date_echeance_leasing')
                                        <span class="text-danger fs-tiny">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <!-- Leasing Status -->
                                <div class="col-sm-6 mb-4">
                                    <label for="etat_echeance_leasing" class="form-label">État échéance</label>
                                    <select id="etat_echeance_leasing" name="etat_echeance_leasing" class="form-select">
                                        <option value="payé">Payé</option>
                                        <option value="non payé">Non payé</option>
                                    </select>
                                    @error('etat_echeance_leasing')
                                        <span class="text-danger fs-tiny">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <!-- Settlement -->
                                <div class="col-sm-6 mb-4">
                                    <label for="reglement" class="form-label">Règlement</label>
                                    <input type="text" name="reglement" id="reglement" class="form-control" placeholder="Détails de règlement">
                                    @error('reglement')
                                        <span class="text-danger fs-tiny">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <!-- Company Name -->
                                <div class="col-sm-6 mb-4">
                                    <label for="nom_societe" class="form-label">Nom société</label>
                                    <input type="text" name="nom_societe" id="nom_societe" class="form-control" placeholder="Nom de la société">
                                    @error('nom_societe')
                                        <span class="text-danger fs-tiny">{{ $message }}</span>
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
                            <div class="dropzone needsclick" id="dropzone-basic">
                                <div class="dz-message needsclick">
                                    <p class="h4 needsclick pt-3 mb-2">Glissez-déposez votre image ici</p>
                                    <p class="h6 text-body-secondary d-block fw-normal mb-2">ou</p>
                                    <span class="needsclick btn btn-sm btn-label-primary" id="btnBrowse">Parcourir les fichiers</span>
                                    <input id="file-upload" name="image" type="file" class="d-none" accept="image/*">
                                </div>
                                <div class="fallback">
                                    <input name="image" type="file" />
                                </div>
                            </div>
                            @error('image')
                                <span class="text-danger fs-tiny mt-2 d-block">{{ $message }}</span>
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
                                <label for="price_per_day" class="form-label">Prix/jour (DT)</label>
                                <input type="number" step="0.01" name="price_per_day" id="price_per_day" class="form-control" placeholder="0.00">
                                @error('price_per_day')
                                    <span class="text-danger fs-tiny">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <!-- Seasonal Price -->
                            <div class="mb-4">
                                <label for="seasonal_price" class="form-label">Prix saisonnier (DT/jour)</label>
                                <input type="number" step="0.01" name="seasonal_price" id="seasonal_price" class="form-control" placeholder="0.00">
                                @error('seasonal_price')
                                    <span class="text-danger fs-tiny">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <!-- Summer Price -->
                            <div class="mb-4">
                                <label for="summer_price" class="form-label">Prix été (DT/jour)</label>
                                <input type="number" step="0.01" name="summer_price" id="summer_price" class="form-control" placeholder="0.00">
                                @error('summer_price')
                                    <span class="text-danger fs-tiny">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <!-- Discount -->
                            <div class="mb-4">
                                <label for="reduce" class="form-label">Réduction (%)</label>
                                <input type="number" name="reduce" id="reduce" class="form-control" placeholder="0" min="0" max="100">
                                @error('reduce')
                                    <span class="text-danger fs-tiny">{{ $message }}</span>
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
                            <!-- Status -->
                            <div class="mb-4">
                                <label for="status" class="form-label">Statut</label>
                                <select id="status" name="status" class="form-select">
                                    <option value="">-- Sélectionnez --</option>
                                    <option value="available">Disponible</option>
                                    <option value="unavailable">Indisponible</option>
                                </select>
                                @error('status')
                                    <span class="text-danger fs-tiny">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <!-- Stars Rating -->
                            <div class="mb-4">
                                <label for="stars" class="form-label">Étoiles</label>
                                <select id="stars" name="stars" class="form-select">
                                    <option value="5">⭐⭐⭐⭐⭐ (5/5)</option>
                                    <option value="4">⭐⭐⭐⭐ (4/5)</option>
                                    <option value="3">⭐⭐⭐ (3/5)</option>
                                    <option value="2">⭐⭐ (2/5)</option>
                                    <option value="1">⭐ (1/5)</option>
                                </select>
                                @error('stars')
                                    <span class="text-danger fs-tiny">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <!-- In Stock -->
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
        // Gestion de la zone de dépôt d'images
        const dropzone = document.querySelector('.dropzone');
        const fileInput = document.getElementById('file-upload');
        const browseBtn = document.getElementById('btnBrowse');
        
        if (dropzone) {
            dropzone.addEventListener('click', function(e) {
                if (e.target === browseBtn || e.target === dropzone) {
                    fileInput.click();
                }
            });
            
            fileInput.addEventListener('change', function() {
                if (this.files.length) {
                    const fileName = this.files[0].name;
                    dropzone.querySelector('.dz-message').innerHTML = `
                        <p class="h4 pt-3 mb-2">Fichier sélectionné</p>
                        <p class="mb-2">${fileName}</p>
                        <span class="btn btn-sm btn-label-secondary mt-2">Changer de fichier</span>
                    `;
                }
            });
            
            dropzone.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.style.borderColor = '#696cff';
                this.style.backgroundColor = 'rgba(105, 108, 255, 0.1)';
            });
            
            dropzone.addEventListener('dragleave', function() {
                this.style.borderColor = '#d9dee3';
                this.style.backgroundColor = '#f9fafb';
            });
            
            dropzone.addEventListener('drop', function(e) {
                e.preventDefault();
                this.style.borderColor = '#d9dee3';
                this.style.backgroundColor = '#f9fafb';
                
                if (e.dataTransfer.files.length) {
                    fileInput.files = e.dataTransfer.files;
                    const fileName = e.dataTransfer.files[0].name;
                    dropzone.querySelector('.dz-message').innerHTML = `
                        <p class="h4 pt-3 mb-2">Fichier sélectionné</p>
                        <p class="mb-2">${fileName}</p>
                        <span class="btn btn-sm btn-label-secondary mt-2">Changer de fichier</span>
                    `;
                }
            });
        }
    });
</script>
@endpush