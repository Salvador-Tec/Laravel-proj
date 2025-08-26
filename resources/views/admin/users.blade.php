@extends('admin.noname')

@section('content')
 <div class="container-xxl flex-grow-1 container-p-y">
              <!-- Product List Widget -->
              <div class="card mb-6">
                <div class="card-widget-separator-wrapper">
                  <div class="card-body card-widget-separator">
                    <div class="row gy-4 gy-sm-1">
                      <div class="col-sm-6 col-lg-3">
                        <div
                          class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-4 pb-sm-0">
                          <div>
                            <p class="mb-1">In-store Sales</p>
                            <h4 class="mb-1">$5,345.43</h4>
                            <p class="mb-0">
                              <span class="me-2">5k orders</span><span class="badge bg-label-success">+5.7%</span>
                            </p>
                          </div>
                          <span class="avatar me-sm-6">
                            <span class="avatar-initial rounded"
                              ><i class="icon-base ti tabler-smart-home icon-28px text-heading"></i
                            ></span>
                          </span>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none me-6" />
                      </div>
                      <div class="col-sm-6 col-lg-3">
                        <div
                          class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-4 pb-sm-0">
                          <div>
                            <p class="mb-1">Website Sales</p>
                            <h4 class="mb-1">$674,347.12</h4>
                            <p class="mb-0">
                              <span class="me-2">21k orders</span><span class="badge bg-label-success">+12.4%</span>
                            </p>
                          </div>
                          <span class="avatar p-2 me-lg-6">
                            <span class="avatar-initial rounded"
                              ><i class="icon-base ti tabler-device-laptop icon-28px text-heading"></i
                            ></span>
                          </span>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none" />
                      </div>
                      <div class="col-sm-6 col-lg-3">
                        <div
                          class="d-flex justify-content-between align-items-start border-end pb-4 pb-sm-0 card-widget-3">
                          <div>
                            <p class="mb-1">Discount</p>
                            <h4 class="mb-1">$14,235.12</h4>
                            <p class="mb-0">6k orders</p>
                          </div>
                          <span class="avatar p-2 me-sm-6">
                            <span class="avatar-initial rounded"
                              ><i class="icon-base ti tabler-gift icon-28px text-heading"></i
                            ></span>
                          </span>
                        </div>
                      </div>
                      <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-start">
                          <div>
                            <p class="mb-1">Affiliate</p>
                            <h4 class="mb-1">$8,345.23</h4>
                            <p class="mb-0">
                              <span class="me-2">150 orders</span><span class="badge bg-label-danger">-3.5%</span>
                            </p>
                          </div>
                          <span class="avatar p-2">
                            <span class="avatar-initial rounded"
                              ><i class="icon-base ti tabler-wallet icon-28px text-heading"></i
                            ></span>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <!-- Product List Table -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    
                       <!-- Search -->
                <li class="nav-item navbar-search-wrapper btn btn-text-secondary btn-icon rounded-pill">
                  <a class="nav-item nav-link search-toggler px-0" href="javascript:void(0);">
                    <span class="d-inline-block text-body-secondary fw-normal" id="autocomplete"></span>
                  </a>
                </li>
              <!-- Basic Bootstrap Table -->
              <div class="card">
                <h5 class="card-header">Table Basic</h5>
                <!-- Barre de recherche positionnée à droite -->
<div class="d-flex justify-content-end mt-3 me-3">
  <input id="searchInput" type="text" class="form-control w-auto" placeholder="Rechercher un client..." onkeyup="filterClients()" />
</div>

<br/>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                         <th >Prénom</th>
                <th>Nom</th>
              
              
                <th>Numéro d'Identité</th>
                <th>Numéro de Permis</th>
                <th>Adresse</th>
                <th>Numéro de Téléphone</th>
                <th>Cartes</th>
                <th>Actions</th>
                      </tr>
                    </thead>
                               <tbody>
                @foreach ($clients as $client)
                <tr id="client-row-{{ $client->id }}"  
    class="{{ ($client->is_blocked ? 'blocked-row' : '') }} {{ (request('highlight') == $client->identity_number ? 'selected-row' : '') }}">

                    <td >{{ $client->last_name}}</td>
                    <td >{{ $client->first_name}}</td>
                 
                  
                    <td >{{ $client->identity_number }}</td>
                    <td >{{ $client->driver_license_number }}</td>
                    <td >{{ $client->address }}</td>
                    <td >{{ $client->mobile_number }}</td>
                   <td >
    @if(is_array($client->gallery) && count($client->gallery) > 0)
        <!-- Bouton pour ouvrir la modale -->
        <button class="btn-super-attractive" onclick="openModal({{ $client->id }})">
            <i class="bi bi-image"></i> Voir les images
        </button>

        <!-- Modale Personnalisée -->
        <div id="modal{{ $client->id }}" class="modal-overlay">
            <div class="modal-content">
                <!-- Nouveau bouton de fermeture -->
                <button class="close-btn" onclick="closeModal({{ $client->id }})">X</button>
                <div class="modal-images">
                    @foreach ($client->gallery as $image)
                        <img src="{{ asset('storage/' . $image) }}" alt="Image du client" class="modal-image" style="width: 60px; height: auto;">
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <p>Aucune image disponible</p>
    @endif
</td>

 <td>
  <div class="dropdown">
    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
      <i class="icon-base ti tabler-dots-vertical"></i>
    </button>
    <div class="dropdown-menu">
      <!-- Lien pour voir (œil) -->
   <a class="dropdown-item" href="{{ route('clients.details', ['id' => $client->id]) }}">
  <i class="icon-base ti tabler-eye me-1"></i> Voir
</a>


      <!-- Lien pour éditer -->
<a class="dropdown-item" href="{{ route('clients.edit', $client->id) }}" title="Modifier">
  <i class="icon-base ti tabler-pencil me-1"></i> Edit
</a>


      <!-- Lien pour supprimer -->
     <!-- Delete link triggering form submission -->
<a class="dropdown-item text-red-600 hover:text-red-800" href="javascript:void(0);" 
   onclick="event.preventDefault(); if(confirm('Voulez-vous vraiment supprimer cet utilisateur ?')) document.getElementById('delete-form-{{ $client->id }}').submit();">
  <i class="icon-base ti tabler-trash me-1"></i> Delete
</a>

<!-- Hidden form for delete -->
<form id="delete-form-{{ $client->id }}" action="{{ route('deleteUser', $client->id) }}" method="POST" style="display: none;">
  @csrf
  @method('DELETE')
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
            </div>

            <script>
  function filterClients() {
    let input = document.getElementById("searchInput");
    let filter = input.value.toLowerCase();
    let table = document.querySelector(".table tbody");
    let rows = table.getElementsByTagName("tr");

    Array.from(rows).forEach(function(row) {
      let text = row.textContent.toLowerCase();
      row.style.display = text.includes(filter) ? "" : "none";
    });
  }
</script>

@endsection