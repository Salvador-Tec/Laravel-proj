<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body class="bg-light py-5">

<div class="container">
    <div class="card shadow-lg rounded-4">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Modifier les informations du client</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('clients.update', $client->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <h5 class="mb-3">Informations personnelles</h5>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Prénom</label>
                        
                        <input type="text" name="first_name" class="form-control" value="{{ $client->first_name }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nom</label>
                        <input type="text" name="last_name" class="form-control" value="{{ $client->last_name }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Numéro d'identité</label>
                        <input type="text" name="identity_number" class="form-control" value="{{ $client->identity_number }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Numéro de permis de conduire</label>
                        <input type="text" name="driver_license_number" class="form-control" value="{{ $client->driver_license_number }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Adresse</label>
                        <input type="text" name="address" class="form-control" value="{{ $client->address }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nationalité</label>
                        <input type="text" name="nationality" class="form-control" value="{{ $client->nationality }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Numéro de mobile</label>
                        <input type="text" name="mobile_number" class="form-control" value="{{ $client->mobile_number }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Date de naissance</label>
                        <input type="date" name="date_of_birth" class="form-control" value="{{ $client->date_of_birth }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Lieu de naissance</label>
                        <input type="text" name="place_of_birth" class="form-control" value="{{ $client->place_of_birth }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Date d'émission de la carte d'identité</label>
                        <input type="date" name="identity_date" class="form-control" value="{{ $client->identity_date }}">
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Date d'émission du permis</label>
                        <input type="date" name="license_date" class="form-control" value="{{ $client->license_date }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Photo (Galerie)</label>
                        <input type="file" name="gallery" class="form-control">
                        @if($client->gallery)
                            <img src="{{ asset('storage/' . $client->gallery) }}" alt="Photo" class="img-thumbnail mt-2" width="150">
                        @endif
                    </div>
                </div>

               
                <div class="d-flex justify-content-end">
                    <a href="{{ url('/users') }}" class="btn btn-danger btn-lg px-4">
                        Annuler
                    </a>

                    <button type="submit" class="btn btn-success btn-lg px-4">Enregistrer les modifications</button>

                </div>
                
                

            </form>
        </div>
    </div>
</div>

</body>
</html>
