@extends('admin.noname')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Titre principal -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold py-3 mb-0">
            <span class="text-muted fw-light">Gestion des Voitures /</span> Radars
        </h4>
    </div>

    <!-- Widgets Statistiques -->
    <div class="card mb-4">
        <div class="card-widget-separator-wrapper">
            <div class="card-body card-widget-separator">
                <div class="row gy-4 gy-sm-1">
                    <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-4 pb-sm-0">
                            <div>
                                <p class="mb-1">Radars Totaux</p>
                                <h4 class="mb-1">{{ $radars->count() }}</h4>
                            </div>
                            <span class="avatar me-sm-6">
                                <span class="avatar-initial rounded bg-label-danger">
                                    <i class="icon-base ti tabler-radar-2 icon-28px"></i>
                                </span>
                            </span>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none me-6" />
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-4 pb-sm-0">
                            <div>
                                <p class="mb-1">En Attente</p>
                                <h4 class="mb-1">{{ $radars->where('traite', false)->count() }}</h4>
                            </div>
                            <span class="avatar p-2 me-lg-6">
                                <span class="avatar-initial rounded bg-label-warning">
                                    <i class="icon-base ti tabler-clock icon-28px"></i>
                                </span>
                            </span>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none" />
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-start border-end pb-4 pb-sm-0 card-widget-3">
                            <div>
                                <p class="mb-1">Traités</p>
                                <h4 class="mb-1">{{ $radars->where('traite', true)->count() }}</h4>
                            </div>
                            <span class="avatar p-2 me-sm-6">
                                <span class="avatar-initial rounded bg-label-success">
                                    <i class="icon-base ti tabler-circle-check icon-28px"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="mb-1">Amendes Total</p>
                                <h4 class="mb-1">{{ number_format($radars->sum('montant'), 2) }} DT</h4>
                            </div>
                            <span class="avatar p-2">
                                <span class="avatar-initial rounded bg-label-primary">
                                    <i class="icon-base ti tabler-currency-dinar icon-28px"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Barre d'action et filtres -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                <div class="d-flex flex-wrap gap-3 mb-3 mb-md-0">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRadarModal">
                        <i class="icon-base ti tabler-plus me-2"></i> Ajouter Radar
                    </button>
                    <a href="{{ route('cars.index') }}" class="btn btn-label-secondary">
                        <i class="icon-base ti tabler-arrow-back me-2"></i> Retour aux voitures
                    </a>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <input id="searchMatricule" type="text" placeholder="Matricule" class="form-control w-auto" />
                    <input id="searchMarque" type="text" placeholder="Marque" class="form-control w-auto" />
                    <input id="searchModele" type="text" placeholder="Modèle" class="form-control w-auto" />
                    <button id="btnClearFilters" class="btn btn-label-danger">
                        <i class="icon-base ti tabler-x me-2"></i> Réinitialiser
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Message de succès -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tableau des radars -->
    <div class="card">
        <h5 class="card-header">Liste des Radars</h5>
        <div class="table-responsive text-nowrap">
            <table id="radarTable" class="table table-hover">
                <thead>
                    <tr>
                        <th>Matricule</th>
                        <th>Marque</th>
                        <th>Modèle</th>
                        <th>Date Infraction</th>
                        <th>Date Traitement</th>
                        <th>N°Contrat</th>
                        <th class="text-center">Traité</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($radars as $radar)
                    <tr data-id="{{ $radar->id }}">
                        <!-- Correction des attributs data-field -->
                        <td class="editable" data-field="matricule">
                            <strong>{{ $radar->car->matricule ?? 'N/A' }}</strong>
                        </td>
                        <td class="editable" data-field="marque">{{ $radar->car->brand ?? 'N/A' }}</td>
                        <td class="editable" data-field="modele">{{ $radar->car->model ?? 'N/A' }}</td>
                        <td class="editable" data-field="date_infraction">
                            {{ \Carbon\Carbon::parse($radar->date_infraction)->format('d/m/Y') }}
                        </td>
                        <td class="editable" data-field="date_traitement">
                            @if($radar->date_traitement)
                                {{ \Carbon\Carbon::parse($radar->date_traitement)->format('d/m/Y') }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="editable" data-field="numero_contrat">{{ $radar->numero_contrat ?? '-' }}</td>
                        <td class="text-center editable-checkbox" data-field="traite">
                            <input type="checkbox" class="form-check-input" {{ $radar->traite ? 'checked' : '' }} disabled>
                        </td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="icon-base ti tabler-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <button class="dropdown-item editRowBtn">
                                        <i class="icon-base ti tabler-edit me-1"></i> Modifier
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <div class="misc-wrapper">
                                <h2 class="mb-2">Aucun radar trouvé</h2>
                                <p class="mb-4">Cliquez sur "Ajouter Radar" pour commencer</p>
                                <img src="{{ asset('admin/assets/img/illustrations/page-misc-error.png') }}" alt="page-misc-error" width="160" class="img-fluid">
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal pour ajouter un radar -->
    <div class="modal fade" id="addRadarModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Ajouter un Radar</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{ route('cars.radars.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-4">
                                <label for="car_id" class="form-label">Voiture</label>
                                <select name="car_id" id="car_id" class="form-control" onchange="updateCarDetails(this)" required>
                                    <option value="">-- Sélectionner --</option>
                                    @foreach($cars as $car)
                                        <option value="{{ $car->id }}"
                                            data-matricule="{{ $car->matricule }}"
                                            data-brand="{{ $car->brand }}"
                                            data-model="{{ $car->model }}">
                                            {{ $car->matricule }} - {{ $car->brand }} - {{ $car->model }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col mb-0">
                                <label for="matricule" class="form-label">Matricule</label>
                                <input type="text" id="matricule" name="matricule" class="form-control" readonly>
                            </div>
                            <div class="col mb-0">
                                <label for="marque" class="form-label">Marque</label>
                                <input type="text" id="marque" name="marque" class="form-control" readonly>
                            </div>
                            <div class="col mb-0">
                                <label for="modele" class="form-label">Modèle</label>
                                <input type="text" id="modele" name="modele" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4">
                                <label for="date_infraction" class="form-label">Date Infraction</label>
                                <input type="date" name="date_infraction" id="date_infraction" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4">
                                <label for="date_traitement" class="form-label">Date de Traitement</label>
                                <input type="date" name="date_traitement" id="date_traitement" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4">
                                <label for="numero_contrat" class="form-label">Numéro Contrat</label>
                                <input type="text" name="numero_contrat" id="numero_contrat" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="traite" value="1" id="traite">
                                    <label class="form-check-label" for="traite">
                                        Traité
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                            Annuler
                        </button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .card-widget-separator-wrapper .card-body {
        padding: 1.5rem;
    }
    .editable input {
        width: 100%;
        padding: 0.375rem 0.75rem;
        border: 1px solid #d9dee3;
        border-radius: 0.375rem;
    }
    .editable-checkbox .form-check-input {
        margin: 0 auto;
    }
    tr:hover {
        background-color: rgba(115, 103, 240, 0.04);
    }
</style>

<script>
    // Auto-fill details in add form based on selected car
    function updateCarDetails(select) {
        const selectedOption = select.options[select.selectedIndex];
        document.getElementById('matricule').value = selectedOption.getAttribute('data-matricule') || '';
        document.getElementById('marque').value = selectedOption.getAttribute('data-brand') || '';
        document.getElementById('modele').value = selectedOption.getAttribute('data-model') || '';
    }

    // Filters - Fonctionnalités de recherche corrigées
    const searchMatricule = document.getElementById('searchMatricule');
    const searchMarque = document.getElementById('searchMarque');
    const searchModele = document.getElementById('searchModele');
    const btnClearFilters = document.getElementById('btnClearFilters');
    const table = document.getElementById('radarTable');
    const tbody = table.querySelector('tbody');

    function filterTable() {
        const valMatricule = searchMatricule.value.toLowerCase();
        const valMarque = searchMarque.value.toLowerCase();
        const valModele = searchModele.value.toLowerCase();

        Array.from(tbody.rows).forEach(row => {
            // Correction : utilisation des bons noms de data-field
            const mat = row.querySelector('[data-field="matricule"]').textContent.toLowerCase();
            const mar = row.querySelector('[data-field="marque"]').textContent.toLowerCase();
            const mod = row.querySelector('[data-field="modele"]').textContent.toLowerCase();

            // Vérification si toutes les conditions sont remplies
            const showRow = 
                (valMatricule === '' || mat.includes(valMatricule)) &&
                (valMarque === '' || mar.includes(valMarque)) &&
                (valModele === '' || mod.includes(valModele));

            row.style.display = showRow ? '' : 'none';
        });
    }

    [searchMatricule, searchMarque, searchModele].forEach(input => {
        input.addEventListener('input', filterTable);
    });

    if(btnClearFilters) {
        btnClearFilters.addEventListener('click', () => {
            searchMatricule.value = '';
            searchMarque.value = '';
            searchModele.value = '';
            filterTable();
        });
    }

    // Inline Editing functionality
    if(tbody) {
        tbody.addEventListener('click', function(e) {
            const target = e.target;
            const editBtn = target.closest('.editRowBtn');
            
            if (editBtn) {
                const row = editBtn.closest('tr');
                const button = editBtn;
                
                // Check if already editing
                if (button.textContent.includes('Enregistrer')) {
                    saveRow(row, button);
                } else {
                    editRow(row, button);
                }
            }
        });
    }

    function editRow(row, button) {
        // Change button text
        button.innerHTML = '<i class="icon-base ti tabler-device-floppy me-1"></i> Enregistrer';
        
        // Make editable cells into inputs
        row.querySelectorAll('.editable').forEach(cell => {
            const field = cell.getAttribute('data-field');
            const val = cell.textContent.trim();
            let inputHtml = '';

            // For dates, use date input
            if (field === 'date_infraction' || field === 'date_traitement') {
                // Convert date format from d/m/Y to Y-m-d
                const dateParts = val.split('/');
                const formattedDate = dateParts.length === 3 ? `${dateParts[2]}-${dateParts[1]}-${dateParts[0]}` : '';
                inputHtml = `<input type="date" class="form-control" value="${formattedDate}">`;
            } else {
                // text inputs for others
                inputHtml = `<input type="text" class="form-control" value="${val}">`;
            }
            cell.innerHTML = inputHtml;
        });

        // For checkbox editable cell
        const checkboxCell = row.querySelector('.editable-checkbox');
        if (checkboxCell) {
            const checked = checkboxCell.querySelector('input[type="checkbox"]').checked;
            checkboxCell.innerHTML = `<input type="checkbox" class="form-check-input" ${checked ? 'checked' : ''}>`;
        }
    }

    function saveRow(row, button) {
        const id = row.getAttribute('data-id');

        // Collect updated data
        let data = {};
        row.querySelectorAll('.editable').forEach(cell => {
            const field = cell.getAttribute('data-field');
            const input = cell.querySelector('input');
            if (input) {
                data[field] = input.value;
            }
        });

        // Checkbox field
        const checkboxCell = row.querySelector('.editable-checkbox');
        if (checkboxCell) {
            const checkbox = checkboxCell.querySelector('input[type="checkbox"]');
            data['traite'] = checkbox.checked ? 1 : 0;
        }

        // Prepare fetch options
        fetch(`/radars/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur lors de la mise à jour');
            }
            return response.json();
        })
        .then(json => {
            // Update cells with new values
            row.querySelectorAll('.editable').forEach(cell => {
                const field = cell.getAttribute('data-field');
                let value = data[field] || '';
                
                // Format dates
                if (field === 'date_infraction' || field === 'date_traitement') {
                    const dateParts = value.split('-');
                    if (dateParts.length === 3) {
                        value = `${dateParts[2]}/${dateParts[1]}/${dateParts[0]}`;
                    }
                }
                
                cell.innerHTML = value;
            });

            // Checkbox cell update
            if (checkboxCell) {
                checkboxCell.innerHTML = `<input type="checkbox" class="form-check-input" ${data['traite'] == 1 ? 'checked' : ''} disabled>`;
            }

            // Change button back to edit
            button.innerHTML = '<i class="icon-base ti tabler-edit me-1"></i> Modifier';
        })
        .catch(err => {
            alert(err.message);
        });
    }
</script>
@endsection