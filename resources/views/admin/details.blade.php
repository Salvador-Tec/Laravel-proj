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
                    <i class="icon-base ti tabler-device-floppy me-1_5"></i>Enregistrer
                </button>
            </div>
        </div>

        <form id="carForm" method="POST" action="{{ route('cars.editCar', $car->id) }}" 
              class="bg-white p-6 rounded-3xl shadow-sm border border-gray-200" 
              autocomplete="off">
            @csrf
            @method('PUT')

            <!-- Informations Générales -->
            <div class="card mb-6">
                <div class="card-header d-flex align-items-center gap-4">
                    <div class="p-3 bg-blue-100 rounded-xl">
                        <i class="icon-base ti tabler-info-circle text-blue-600 text-xl"></i>
                    </div>
                    <h5 class="card-title mb-0 text-gray-800 uppercase tracking-wide">Informations générales</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Marque -->
                        <div class="col-md-6 mb-4">
                            <label for="marque" class="form-label">Marque</label>
                            <input type="text" id="marque" name="marque" value="{{ old('marque', $car->brand) }}" 
                                   class="form-control" />
                            @error('marque')<p class="text-danger mt-1 fs-tiny">{{ $message }}</p>@enderror
                        </div>

                        <!-- Modèle -->
                        <div class="col-md-6 mb-4">
                            <label for="modele" class="form-label">Modèle</label>
                            <input type="text" id="modele" name="modele" value="{{ old('modele', $car->model) }}"
                                   class="form-control" />
                            @error('modele')<p class="text-danger mt-1 fs-tiny">{{ $message }}</p>@enderror
                        </div>

                        <!-- Matricule -->
                        <div class="col-md-6 mb-4">
                            <label for="matricule" class="form-label">Matricule</label>
                            <input type="text" id="matricule" name="matricule" value="{{ old('matricule', $car->matricule) }}" 
                                   class="form-control" />
                            @error('matricule')<p class="text-danger mt-1 fs-tiny">{{ $message }}</p>@enderror
                        </div>

                        <!-- Type de boîte -->
                        <div class="col-md-6 mb-4">
                            <label for="boite" class="form-label">Type de boîte</label>
                            <select id="boite" name="boite" class="form-select">
                                <option value="">-- Sélectionner --</option>
                                <option value="manuelle" {{ old('boite', $car->gearbox_type) === 'manuelle' ? 'selected' : '' }}>Manuelle</option>
                                <option value="automatique" {{ old('boite', $car->gearbox_type) === 'automatique' ? 'selected' : '' }}>Automatique</option>
                            </select>
                            @error('boite')<p class="text-danger mt-1 fs-tiny">{{ $message }}</p>@enderror
                        </div>

                        <!-- Moteur -->
                        <div class="col-md-6 mb-4">
                            <label for="moteur" class="form-label">Moteur</label>
                            <input type="text" id="moteur" name="moteur" value="{{ old('moteur', $car->engine) }}" 
                                   class="form-control" />
                            @error('moteur')<p class="text-danger mt-1 fs-tiny">{{ $message }}</p>@enderror
                        </div>

                        <!-- Prix / jour -->
                        <div class="col-md-6 mb-4">
                            <label for="prix" class="form-label">Prix / jour (€)</label>
                            <input type="number" id="prix" name="prix" value="{{ old('prix', $car->price_per_day) }}" min="0" step="0.01" 
                                   class="form-control" />
                            @error('prix')<p class="text-danger mt-1 fs-tiny">{{ $message }}</p>@enderror
                        </div>

                        <!-- Disponibilité : Départ & Retour -->
                        <div class="col-md-6 mb-4">
                            <label for="pickup_location" class="form-label">Disponibilité (départ)</label>
                            <input type="text" id="pickup_location" name="pickup_location" value="{{ old('pickup_location', $car->pickup_location) }}" 
                                   class="form-control" />
                            @error('pickup_location')<p class="text-danger mt-1 fs-tiny">{{ $message }}</p>@enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="return_location" class="form-label">Disponibilité (retour)</label>
                            <input type="text" id="return_location" name="return_location" value="{{ old('return_location', $car->return_location) }}" 
                                   class="form-control" />
                            @error('return_location')<p class="text-danger mt-1 fs-tiny">{{ $message }}</p>@enderror
                        </div>

                        <!-- Quantité totale -->
                        <div class="col-md-6 mb-4">
                            <label for="quantite" class="form-label">Quantité totale</label>
                            <input type="number" id="quantite" name="quantite" value="{{ old('quantite', $car->quantity) }}" min="0"
                                   class="form-control" />
                            @error('quantite')<p class="text-danger mt-1 fs-tiny">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Assurance -->
            <div class="card mb-6">
                <div class="card-header d-flex align-items-center gap-4">
                    <div class="p-3 bg-green-100 rounded-xl">
                        <i class="icon-base ti tabler-shield text-green-600 text-xl"></i>
                    </div>
                    <h5 class="card-title mb-0 text-gray-800 uppercase tracking-wide">Assurance</h5>
                </div>
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

            <!-- Entretien -->
            <div class="card mb-6">
                <div class="card-header d-flex align-items-center gap-4">
                    <div class="p-3 bg-orange-100 rounded-xl">
                        <i class="icon-base ti tabler-tools text-orange-600 text-xl"></i>
                    </div>
                    <h5 class="card-title mb-0 text-gray-800 uppercase tracking-wide">Entretien</h5>
                </div>
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

            <!-- Visite Technique -->
            <div class="card mb-6">
                <div class="card-header d-flex align-items-center gap-4">
                    <div class="p-3 bg-purple-100 rounded-xl">
                        <i class="icon-base ti tabler-clipboard-check text-purple-600 text-xl"></i>
                    </div>
                    <h5 class="card-title mb-0 text-gray-800 uppercase tracking-wide">Visite Technique</h5>
                </div>
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

            <!-- Bouton d'enregistrement -->
            <div class="text-center pt-6">
                <button type="submit"
                  class="btn btn-primary px-10 py-3">
                  Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Assurance - Calcul des jours restants
        const dateDebutAssurance = document.getElementById('date_debut_assurance');
        const dateFinAssurance = document.getElementById('date_fin_assurance');
        const joursRestantsAssurance = document.getElementById('jours_restants_assurance');

        function calculerJoursRestantsAssurance() {
            const debut = dateDebutAssurance.value;
            const fin = dateFinAssurance.value;

            if (!debut || !fin) {
                joursRestantsAssurance.value = '';
                return;
            }

            const debutDate = new Date(debut);
            const finDate = new Date(fin);
            const aujourdHui = new Date();
            aujourdHui.setHours(0, 0, 0, 0);

            if (aujourdHui > finDate) {
                const diff = Math.ceil((aujourdHui - finDate) / (1000 * 60 * 60 * 24));
                joursRestantsAssurance.value = `Assurance expirée depuis ${diff} jour(s)`;
            } else {
                const diff = Math.ceil((finDate - aujourdHui) / (1000 * 60 * 60 * 24));
                joursRestantsAssurance.value = `${diff} jour(s) restant(s)`;
            }
        }

        if (dateDebutAssurance && dateFinAssurance && joursRestantsAssurance) {
            if (dateDebutAssurance.value && dateFinAssurance.value) {
                calculerJoursRestantsAssurance();
            }

            dateDebutAssurance.addEventListener('change', calculerJoursRestantsAssurance);
            dateFinAssurance.addEventListener('change', calculerJoursRestantsAssurance);
        }

        // Entretien - Calcul des jours restants
        const dateEntretien = document.getElementById('date_entretien');
        const joursRestantsEntretien = document.getElementById('jours_restants_entretien');

        function calculerJoursRestantsEntretien() {
            const dateInput = dateEntretien.value;
            if (!dateInput) {
                joursRestantsEntretien.value = '';
                return;
            }

            const [annee, mois, jour] = dateInput.split('-').map(Number);
            const dateEntretienDate = new Date(annee, mois - 1, jour);

            const aujourdHui = new Date();
            aujourdHui.setHours(0, 0, 0, 0);

            const diffJours = Math.ceil((dateEntretienDate - aujourdHui) / (1000 * 60 * 60 * 24));

            if (diffJours > 0) {
                joursRestantsEntretien.value = `${diffJours} jour(s) restant(s)`;
            } else if (diffJours === 0) {
                joursRestantsEntretien.value = `Dernier jour aujourd'hui`;
            } else {
                joursRestantsEntretien.value = `Entretien en retard de ${Math.abs(diffJours)} jour(s)`;
            }
        }

        if (dateEntretien && joursRestantsEntretien) {
            if (dateEntretien.value) {
                calculerJoursRestantsEntretien();
            }

            dateEntretien.addEventListener('change', calculerJoursRestantsEntretien);
        }

        // Visite Technique - Calcul des jours restants
        const dateVisite = document.getElementById('date_visite');
        const joursRestantsVisite = document.getElementById('jours_restants_visite');

        function calculerJoursRestantsVisite() {
            const dateInput = dateVisite.value;
            if (!dateInput) {
                joursRestantsVisite.value = '';
                return;
            }

            const [annee, mois, jour] = dateInput.split('-').map(Number);
            const dateVisiteDate = new Date(annee, mois - 1, jour);

            const aujourdHui = new Date();
            aujourdHui.setHours(0, 0, 0, 0);

            const diffJours = Math.ceil((dateVisiteDate - aujourdHui) / (1000 * 60 * 60 * 24));

            if (diffJours > 0) {
                joursRestantsVisite.value = `${diffJours} jour(s) restant(s)`;
            } else if (diffJours === 0) {
                joursRestantsVisite.value = "Dernier jour aujourd'hui";
            } else {
                joursRestantsVisite.value = `Visite expirée depuis ${Math.abs(diffJours)} jour(s)`;
            }
        }

        if (dateVisite && joursRestantsVisite) {
            if (dateVisite.value) {
                calculerJoursRestantsVisite();
            }

            dateVisite.addEventListener('change', calculerJoursRestantsVisite);
        }
    });
</script>
@endpush