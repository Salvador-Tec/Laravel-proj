@extends('admin.noname')

@section('content')  
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row g-6">
        <!-- Carte des Départs Actifs -->
        <div class="col-xxl-12">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="mb-1">🚗 Départs de voitures actifs</h5>
                        <p class="card-subtitle">Réservations en cours</p>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-text-secondary btn-icon rounded-pill text-body-secondary border-0 me-n1"
                            type="button" id="activeDeparturesDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon-base ti tabler-dots-vertical icon-22px text-body-secondary"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="activeDeparturesDropdown">
                            <a class="dropdown-item" href="javascript:void(0);">Exporter</a>
                            <a class="dropdown-item" href="javascript:void(0);">Actualiser</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Filtres -->
                    <form method="GET" action="{{ route('reservations.actives') }}" class="mb-4">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <input type="text" name="matricule" placeholder="🔎 Matricule" 
                                       value="{{ request('matricule') }}" 
                                       class="form-control">
                            </div>
                            <div class="col-md-3">
                                <input type="date" name="start_date" value="{{ request('start_date') }}" 
                                       class="form-control">
                            </div>
                            <div class="col-md-3">
                                <input type="date" name="end_date" value="{{ request('end_date') }}" 
                                       class="form-control">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="ti ti-search me-1"></i> Filtrer
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Résultats -->
                    <div class="row g-4">
                        @forelse ($activeDepartures ?? [] as $reservation)
                            @php
                                $startFilter = request('start_date');
                                $endFilter = request('end_date');
                                $car = $reservation->car;

                                $hasMatchingDate = true;

                                if ($startFilter && $endFilter) {
                                    $hasMatchingDate =
                                        $car->entretiens->whereBetween('date_entretien', [$startFilter, $endFilter])->isNotEmpty() ||
                                        $car->assurances->filter(function ($assurance) use ($startFilter, $endFilter) {
                                            return ($assurance->date_debut <= $endFilter) && ($assurance->date_fin >= $startFilter);
                                        })->isNotEmpty() ||
                                        $car->visitesTechniques->whereBetween('date_visite', [$startFilter, $endFilter])->isNotEmpty();
                                }

                                $entretienMatched = $startFilter && $endFilter && $car->entretiens->whereBetween('date_entretien', [$startFilter, $endFilter])->isNotEmpty();
                                $assuranceMatched = $startFilter && $endFilter && $car->assurances->filter(function ($assurance) use ($startFilter, $endFilter) {
                                    return ($assurance->date_debut <= $endFilter) && ($assurance->date_fin >= $startFilter);
                                })->isNotEmpty();
                                $visiteMatched = $startFilter && $endFilter && $car->visitesTechniques->whereBetween('date_visite', [$startFilter, $endFilter])->isNotEmpty();
                            @endphp

                            <div class="col-xxl-6 col-md-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-4">
                                            <div class="avatar flex-shrink-0 me-4">
                                                <img src="{{ asset('storage/' . $car->image) }}" class="rounded" width="60" height="60">
                                            </div>
                                            <div>
                                                <h5 class="mb-1">{{ $car->brand }} {{ $car->model }}</h5>
                                                <small class="text-body">Mat: {{ $car->matricule }}</small>
                                            </div>
                                        </div>

                                        <ul class="p-0 m-0">
                                            <li class="mb-3">
                                                <div class="d-flex justify-content-between">
                                                    <span class="fw-medium">Départ:</span>
                                                    <span>{{\Carbon\Carbon::parse($reservation->start_date)->format('d/m/Y')}}</span>
                                                </div>
                                            </li>
                                            <li class="mb-3">
                                                <div class="d-flex justify-content-between">
                                                    <span class="fw-medium">Retour:</span>
                                                    <span>{{\Carbon\Carbon::parse($reservation->end_date)->format('d/m/Y')}}</span>
                                                </div>
                                            </li>
                                        </ul>

                                    <!-- Entretien -->
<div class="mt-4 p-3 rounded {{ $entretienMatched ? 'bg-label-warning' : 'bg-label-secondary' }}">
    <h6 class="fw-medium mb-2 cursor-pointer" onclick="toggleDetails(this)">
        🛠️ Entretien
    </h6>

    <div class="entretien-details d-none">
        @forelse($car->entretiens->take(1) as $entretien)
            <ul class="list-unstyled">
                <li class="d-flex justify-content-between mb-1">
                    <small>Date début:</small>
                    <small>{{\Carbon\Carbon::parse($entretien->date_entretien)->format('Y-m-d')}}</small>
                </li>
                <li class="d-flex justify-content-between mb-1">
                    <small>Date fin:</small>
                    <small>{{\Carbon\Carbon::parse($entretien->date_prochain_entretien)->format('Y-m-d')}}</small>
                </li>
                <li class="d-flex justify-content-between">
                    <small>Kilométrage:</small>
                    <small>{{ $entretien->kilometrage }} km</small>
                </li>
            </ul>
            <div class="mt-2 text-end">
                <small class="jours-restants" data-date="{{ $entretien->date_prochain_entretien }}"></small>
            </div>
        @empty
            <small class="text-muted">Aucun entretien enregistré</small>
        @endforelse
    </div>
</div>
<script>
    function toggleDetails(header) {
        const content = header.nextElementSibling;
        content.classList.toggle('d-none');
    }
</script>



                                       <!-- Assurance -->
<div class="mt-3 p-3 rounded {{ $assuranceMatched ? 'bg-label-success' : 'bg-label-secondary' }}">
    <h6 class="fw-medium mb-2 cursor-pointer" onclick="toggleDetails(this)">
        📄 Assurance
    </h6>

    <div class="assurance-details d-none">
        @forelse($car->assurances->take(1) as $assurance)
            <ul class="list-unstyled">
                <li class="d-flex justify-content-between mb-1">
                    <small>Nom:</small>
                    <small>{{ $assurance->nom }}</small>
                </li>
                <li class="d-flex justify-content-between mb-1">
                    <small>Début:</small>
                    <small>{{ \Carbon\Carbon::parse($assurance->date_debut)->format('Y-m-d') }}</small>
                </li>
                <li class="d-flex justify-content-between">
                    <small>Fin:</small>
                    <small>{{ \Carbon\Carbon::parse($assurance->date_fin)->format('Y-m-d') }}</small>
                </li>
            </ul>
            <div class="mt-2 text-end">
                <small class="jours-restants" data-date="{{ $assurance->date_fin }}"></small>
            </div>
        @empty
            <small class="text-muted">Aucune assurance enregistrée</small>
        @endforelse
    </div>
</div>
<script>
    function toggleDetails(header) {
        const content = header.nextElementSibling;
        content.classList.toggle('d-none');
    }
</script>


                                        <!-- Visite Technique -->
                                       <!-- Visite Technique -->
<div class="mt-3 p-3 rounded {{ $visiteMatched ? 'bg-label-danger' : 'bg-label-secondary' }}">
    <h6 class="fw-medium mb-2 cursor-pointer" onclick="toggleDetails(this)">
        🔍 Visite technique
    </h6>

    <div class="visite-details d-none">
        @forelse($car->visitesTechniques->take(1) as $visite)
            <ul class="list-unstyled">
                <li class="d-flex justify-content-between mb-1">
                    <small>Date début:</small>
                    <small>{{ \Carbon\Carbon::parse($visite->date_visite)->format('Y-m-d') }}</small>
                </li>
                <li class="d-flex justify-content-between">
                    <small>Date fin:</small>
                    <small>{{ \Carbon\Carbon::parse($visite->date_prochain_visite)->format('Y-m-d') }}</small>
                </li>
            </ul>
            <div class="mt-2 text-end">
                <small class="jours-restants" data-date="{{ $visite->date_prochain_visite }}"></small>
            </div>
        @empty
            <small class="text-muted">Aucune visite technique enregistrée</small>
        @endforelse
    </div>
</div>
                                    </div>
                                </div>
                            </div>
                        @empty
                        <div class="col-12 text-center py-4">
                            <p class="text-muted">🚫 Aucune réservation active</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const elements = document.querySelectorAll('.jours-restants');

    elements.forEach(function (el) {
        const dateStr = el.getAttribute('data-date');
        if (!dateStr) {
            el.textContent = 'Date invalide';
            return;
        }

        const [annee, mois, jour] = dateStr.split('-').map(Number);
        const dateCible = new Date(annee, mois - 1, jour);
        const aujourdHui = new Date();
        aujourdHui.setHours(0, 0, 0, 0);

        const diffJours = Math.ceil((dateCible - aujourdHui) / (1000 * 60 * 60 * 24));

        if (diffJours > 0) {
            el.textContent = `${diffJours} jour(s) restant(s)`;
        } else if (diffJours === 0) {
            el.textContent = `Dernier jour aujourd'hui`;
        } else {
            el.textContent = `Expiré depuis ${Math.abs(diffJours)} jour(s)`;
        }
    });
});
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggles = document.querySelectorAll(".toggle-section");

        toggles.forEach(toggle => {
            toggle.addEventListener("click", function () {
                const targetId = this.dataset.target;
                const target = document.querySelector(targetId);
                if (target) {
                    target.classList.toggle("d-none");
                }
            });
        });
    });
</script>

@endsection