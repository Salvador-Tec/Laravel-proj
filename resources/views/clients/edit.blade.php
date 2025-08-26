@extends('admin.noname')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="app-ecommerce">
        <!-- Edit Client Header -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
            <div class="d-flex flex-column justify-content-center">
                <h4 class="mb-1">Modifier les Informations du Client</h4>
                <p class="mb-0">Mise à jour des détails du client</p>
            </div>
            <div class="d-flex align-content-center flex-wrap gap-4">
                <a href="{{ route('users') }}" class="btn btn-label-secondary">
                    <i class="ti ti-arrow-left me-1"></i>Retour
                </a>
                <button type="submit" form="clientForm" class="btn btn-primary">Enregistrer les modifications</button>
            </div>
        </div>

        @if (session('success'))
        <div class="alert alert-success alert-dismissible mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible mb-4" role="alert">
            <h5 class="alert-heading">Il y a {{ $errors->count() }} erreur(s) dans le formulaire</h5>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="row">
            <!-- Left Column -->
            <div class="col-12 col-lg-8">
                <!-- Client Information Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Informations Personnelles</h5>
                    </div>
                    <div class="card-body">
                        <form id="clientForm" action="{{ route('clients.update', $client->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="row g-4">
                                <!-- First Name -->
                                <div class="col-md-6">
                                    <label class="form-label" for="first_name">Prénom</label>
                                    <input type="text" id="first_name" name="first_name" 
                                           value="{{ old('first_name', $client->first_name) }}"
                                           class="form-control @error('first_name') is-invalid @enderror">
                                </div>

                                <!-- Last Name -->
                                <div class="col-md-6">
                                    <label class="form-label" for="last_name">Nom</label>
                                    <input type="text" id="last_name" name="last_name" 
                                           value="{{ old('last_name', $client->last_name) }}"
                                           class="form-control @error('last_name') is-invalid @enderror">
                                </div>

                                <!-- Date of Birth -->
                                <div class="col-md-6">
                                    <label class="form-label" for="date_of_birth">Date de Naissance</label>
                                    <input type="date" id="date_of_birth" name="date_of_birth" 
                                           value="{{ old('date_of_birth', $client->date_of_birth) }}"
                                           class="form-control @error('date_of_birth') is-invalid @enderror">
                                </div>
                                
                                <!-- Place of Birth -->
                                <div class="col-md-6">
                                    <label class="form-label" for="place_of_birth">Lieu de Naissance</label>
                                    <input type="text" id="place_of_birth" name="place_of_birth" 
                                           value="{{ old('place_of_birth', $client->place_of_birth) }}"
                                           class="form-control @error('place_of_birth') is-invalid @enderror">
                                </div>

                                <!-- Nationality -->
                                <div class="col-md-6">
                                    <label class="form-label" for="nationality">Nationalité</label>
                                    <input type="text" id="nationality" name="nationality" 
                                           value="{{ old('nationality', $client->nationality) }}"
                                           class="form-control @error('nationality') is-invalid @enderror">
                                </div>

                                <!-- Identity Number -->
                                <div class="col-md-6">
                                    <label class="form-label" for="identity_number">Numéro d'Identité</label>
                                    <input type="text" id="identity_number" name="identity_number" 
                                           value="{{ old('identity_number', $client->identity_number) }}"
                                           class="form-control @error('identity_number') is-invalid @enderror">
                                </div>

                                <!-- Driver License -->
                                <div class="col-md-6">
                                    <label class="form-label" for="driver_license_number">Numéro de Permis</label>
                                    <input type="text" id="driver_license_number" name="driver_license_number" 
                                           value="{{ old('driver_license_number', $client->driver_license_number) }}"
                                           class="form-control @error('driver_license_number') is-invalid @enderror">
                                </div>

                                <!-- Phone Number -->
                                <div class="col-md-6">
                                    <label class="form-label" for="mobile_number">Numéro de Téléphone</label>
                                    <input type="text" id="mobile_number" name="mobile_number" 
                                           value="{{ old('mobile_number', $client->mobile_number) }}"
                                           class="form-control @error('mobile_number') is-invalid @enderror">
                                </div>

                                <!-- Address -->
                                <div class="col-12">
                                    <label class="form-label" for="address">Adresse</label>
                                    <input type="text" id="address" name="address" 
                                           value="{{ old('address', $client->address) }}"
                                           class="form-control @error('address') is-invalid @enderror">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Gallery Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Galerie d'Images</h5>
                    </div>
                    <div class="card-body">
                        <div class="dropzone needsclick" id="dropzone-gallery">
                            <div class="dz-message needsclick">
                                <p class="mb-2">Glissez-déposez vos images ici</p>
                                <p class="text-body-secondary mb-2">ou</p>
                                <button type="button" class="btn btn-label-primary" id="btnBrowseGallery">
                                    Parcourir les fichiers
                                </button>
                            </div>
                            <input type="file" name="gallery[]" multiple class="d-none" id="galleryInput">
                        </div>
                        <div class="mt-3">
                            <small class="text-muted">Formats acceptés: JPG, PNG, GIF - Max 2MB par image</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-12 col-lg-4">
                <!-- Status Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Statut & Catégorie</h5>
                    </div>
                    <div class="card-body">
                        <!-- Status -->
                        <div class="mb-4">
                            <label class="form-label" for="status">Statut du Client</label>
                            <select id="status" class="form-select">
                                <option value="active" selected>Actif</option>
                                <option value="inactive">Inactif</option>
                                <option value="pending">En attente</option>
                            </select>
                        </div>

                        <!-- Category -->
                        <div class="mb-4">
                            <label class="form-label" for="category">Catégorie</label>
                            <div class="input-group">
                                <select id="category" class="form-select">
                                    <option value="particulier">Particulier</option>
                                    <option value="entreprise">Entreprise</option>
                                    <option value="vip">VIP</option>
                                </select>
                                <button class="btn btn-outline-primary" type="button">
                                    <i class="ti ti-plus"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Tags -->
                        <div>
                            <label class="form-label" for="clientTags">Tags</label>
                            <input type="text" id="clientTags" class="form-control" value="Fidèle, Nouveau, Important">
                        </div>
                    </div>
                </div>

                <!-- History Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Historique</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex mb-3">
                                <div class="avatar avatar-sm flex-shrink-0 me-3">
                                    <span class="avatar-initial bg-label-primary rounded">
                                        <i class="ti ti-edit"></i>
                                    </span>
                                </div>
                                <div>
                                    <p class="mb-0">Dernière modification</p>
                                    <small class="text-muted">24 Juin 2023 à 14:30</small>
                                </div>
                            </li>
                            <li class="d-flex mb-3">
                                <div class="avatar avatar-sm flex-shrink-0 me-3">
                                    <span class="avatar-initial bg-label-success rounded">
                                        <i class="ti ti-user-plus"></i>
                                    </span>
                                </div>
                                <div>
                                    <p class="mb-0">Créé le</p>
                                    <small class="text-muted">15 Mai 2023 à 10:15</small>
                                </div>
                            </li>
                            <li class="d-flex">
                                <div class="avatar avatar-sm flex-shrink-0 me-3">
                                    <span class="avatar-initial bg-label-info rounded">
                                        <i class="ti ti-calendar"></i>
                                    </span>
                                </div>
                                <div>
                                    <p class="mb-0">Nombre de réservations</p>
                                    <small class="text-muted">12 réservations</small>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('btnBrowseGallery').addEventListener('click', function() {
        document.getElementById('galleryInput').click();
    });
    
    document.getElementById('galleryInput').addEventListener('change', function(e) {
        if (this.files.length > 0) {
            const dropzone = document.getElementById('dropzone-gallery');
            dropzone.classList.add('dz-started');
            
            // Clear previous previews
            dropzone.querySelectorAll('.dz-preview').forEach(el => el.remove());
            
            // Add new previews
            Array.from(this.files).forEach(file => {
                const preview = document.createElement('div');
                preview.className = 'dz-preview dz-file-preview';
                preview.innerHTML = `
                    <div class="dz-details">
                        <div class="dz-thumbnail">
                            <img data-dz-thumbnail>
                            <span class="dz-nopreview">${file.name}</span>
                        </div>
                        <div class="dz-filename">${file.name}</div>
                        <div class="dz-size">${formatFileSize(file.size)}</div>
                    </div>
                    <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                    <div class="dz-error-message"><span data-dz-errormessage></span></div>
                `;
                dropzone.appendChild(preview);
                
                const img = preview.querySelector('img');
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        img.src = e.target.result;
                        img.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    });
    
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
</script>
@endpush