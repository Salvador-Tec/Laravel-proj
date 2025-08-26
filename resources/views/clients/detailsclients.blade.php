@extends('admin.noname')

@section('content')
 <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <!-- User Sidebar -->
                <div class="col-xl-4 col-lg-5 order-1 order-md-0">
                  <!-- User Card -->
                  <div class="card mb-6">
                    <div class="card-body pt-12">
                      <div class="user-avatar-section">
                        <div class="d-flex align-items-center flex-column">
                          <img
                            class="img-fluid rounded mb-4"
                            src="{{ asset('../../img/avatars/1.png')}}"
                            height="120"
                            width="120"
                            alt="User avatar" />
                          <div class="user-info text-center">
                            <h5>{{ $client->last_name }}  {{ $client->first_name }}</h5>
                            <span class="badge bg-label-secondary">Author</span>
                          </div>
                        </div>
                      </div>
                      <div class="d-flex justify-content-around flex-wrap my-6 gap-0 gap-md-3 gap-lg-4">
                        <div class="d-flex align-items-center me-5 gap-4">
                          <div class="avatar">
                            <div class="avatar-initial bg-label-primary rounded">
                              <i class="icon-base ti tabler-checkbox icon-lg"></i>
                            </div>
                          </div>
                          <div>
                            <h5 class="mb-0">1.23k</h5>
                            <span>Task Done</span>
                          </div>
                        </div>
                        <div class="d-flex align-items-center gap-4">
                          <div class="avatar">
                            <div class="avatar-initial bg-label-primary rounded">
                              <i class="icon-base ti tabler-briefcase icon-lg"></i>
                            </div>
                          </div>
                          <div>
                            <h5 class="mb-0">568</h5>
                            <span>Project Done</span>
                          </div>
                        </div>
                      </div>
                    <h5 class="pb-4 border-bottom mb-4">Détails du client</h5>
<div class="info-container">
  <ul class="list-unstyled mb-6">
    <li class="mb-2">
      <span class="h6">Nom:</span>
      <span>{{ $client->last_name }}</span>
    </li>
    <li class="mb-2">
      <span class="h6">Prénom:</span>
      <span>{{ $client->first_name }}</span>
    </li>
    <li class="mb-2">
      <span class="h6">Date de naissance:</span>
      <span>{{ $client->date_of_birth }}</span>
    </li>
    <li class="mb-2">
      <span class="h6">Lieu de naissance:</span>
      <span>{{ $client->place_of_birth }}</span>
    </li>
    <li class="mb-2">
      <span class="h6">Numéro d'identité:</span>
      <span>{{ $client->identity_number }}</span>
    </li>
    <li class="mb-2">
      <span class="h6">Date délivrance CIN:</span>
      <span>{{ $client->identity_date }}</span>
    </li>
    <li class="mb-2">
      <span class="h6">Numéro de permis:</span>
      <span>{{ $client->driver_license_number }}</span>
    </li>
    <li class="mb-2">
      <span class="h6">Date délivrance permis:</span>
      <span>{{ $client->license_date }}</span>
    </li>
    <li class="mb-2">
      <span class="h6">Adresse:</span>
      <span>{{ $client->address }}</span>
    </li>
    <li class="mb-2">
      <span class="h6">Nationalité:</span>
      <span>{{ $client->nationality }}</span>
    </li>
    <li class="mb-2">
      <span class="h6">Téléphone:</span>
      <span>{{ $client->mobile_number }}</span>
    </li>
  </ul>

</div>

                    </div>
                  </div>
                  <!-- /User Card -->
                  <!-- Plan Card -->
                  <div class="card mb-6 border border-2 border-primary rounded primary-shadow">
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-start">
                        <span class="badge bg-label-primary">Standard</span>
                        <div class="d-flex justify-content-center">
                          <sub class="h5 pricing-currency mb-auto mt-1 text-primary">$</sub>
                          <h1 class="mb-0 text-primary">99</h1>
                          <sub class="h6 pricing-duration mt-auto mb-3 fw-normal">month</sub>
                        </div>
                      </div>
                      <ul class="list-unstyled g-2 my-6">
                        <li class="mb-2 d-flex align-items-center">
                          <i class="icon-base ti tabler-circle-filled icon-10px text-secondary me-2"></i
                          ><span>10 Users</span>
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                          <i class="icon-base ti tabler-circle-filled icon-10px text-secondary me-2"></i
                          ><span>Up to 10 GB storage</span>
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                          <i class="icon-base ti tabler-circle-filled icon-10px text-secondary me-2"></i
                          ><span>Basic Support</span>
                        </li>
                      </ul>
                      <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="h6 mb-0">Days</span>
                        <span class="h6 mb-0">26 of 30 Days</span>
                      </div>
                      <div class="progress mb-1 bg-label-primary" style="height: 6px">
                        <div
                          class="progress-bar"
                          role="progressbar"
                          style="width: 65%"
                          aria-valuenow="65"
                          aria-valuemin="0"
                          aria-valuemax="100"></div>
                      </div>
                      <small>4 days remaining</small>
                      <div class="d-grid w-100 mt-6">
                        <button class="btn btn-primary" data-bs-target="#upgradePlanModal" data-bs-toggle="modal">
                          Upgrade Plan
                        </button>
                      </div>
                    </div>
                  </div>
                  <!-- /Plan Card -->
                </div>
                <!--/ User Sidebar -->

                <!-- User Content -->
                <div class="col-xl-8 col-lg-7 order-0 order-md-1">
                  <!-- User Pills -->
                  <div class="nav-align-top">
                    <ul class="nav nav-pills flex-column flex-md-row flex-wrap mb-6 row-gap-2">
                      <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"
                          ><i class="icon-base ti tabler-user-check icon-sm me-1_5"></i>Account</a
                        >
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="app-user-view-security.html"
                          ><i class="icon-base ti tabler-lock icon-sm me-1_5"></i>Security</a
                        >
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="app-user-view-billing.html"
                          ><i class="icon-base ti tabler-bookmark icon-sm me-1_5"></i>Billing & Plans</a
                        >
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="app-user-view-notifications.html"
                          ><i class="icon-base ti tabler-bell icon-sm me-1_5"></i>Notifications</a
                        >
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="app-user-view-connections.html"
                          ><i class="icon-base ti tabler-link icon-sm me-1_5"></i>Connections</a
                        >
                      </li>
                    </ul>
                  </div>
                  <!--/ User Pills -->

                  <!-- Project table -->
<div class="card mb-6">
  <div class="table-responsive mb-4">
    <table id="reservationsTable" class="table datatable-project">
      <thead class="border-top">
        <tr>
        
          <th>Client</th>
          <th>Voiture</th>
          <th>Date Début</th>
          <th>Date Fin</th>
          <th>Montant Total</th>
          <th>Payé</th>
          <th>Statut</th>
          <!-- Ajout d'une colonne vide pour correspondre au colspan du message "Aucune réservation" -->
          <th style="display: none"></th>
        </tr>
      </thead>
      <tbody>
  @php
    $i = 1;
    $activeReservations = $allReservations->filter(fn($reservation) => $reservation->status === 'active');
  @endphp

  @if($activeReservations->isEmpty())
    <tr>
      <td colspan="8" class="text-center">Aucune réservation active trouvée pour ce client.</td>
    </tr>
  @else
    @foreach($activeReservations as $reservation)
      <tr>
        
        <td>
          {{ $reservation->first_name ?? 'N/A' }} {{ $reservation->last_name ?? '' }}<br>
          <small class="text-muted">{{ $reservation->mobile_number ?? '-' }}</small>
        </td>
        <td>
          {{ optional($reservation->car)->brand ?? 'N/A' }} - {{ optional($reservation->car)->model ?? '' }}
        </td>
        <td>
          {{ $reservation->start_date ? \Carbon\Carbon::parse($reservation->start_date)->format('d/m/Y') : '-' }}
        </td>
        <td>
          {{ $reservation->end_date ? \Carbon\Carbon::parse($reservation->end_date)->format('d/m/Y') : '-' }}
        </td>
        <td>
          {{ number_format($reservation->total_price ?? 0, 2, ',', ' ') }} DT
        </td>
        <td class="text-success">
          {{ number_format($reservation->amount_paid ?? 0, 2, ',', ' ') }} DT
        </td>
        <td>
          <span class="badge {{ $reservation->payment_status === 'payed' ? 'bg-success' : 'bg-warning' }}">
            {{ ucfirst($reservation->payment_status ?? 'inconnu') }}
          </span>
        </td>
      </tr>
    @endforeach
  @endif
</tbody>

    </table>
  </div>
</div>

<script>
    $(document).ready(function () {
  if (!$.fn.DataTable.isDataTable('#reservationsTable')) {
    $('#reservationsTable').DataTable({
      language: {
        emptyTable: "Aucune réservation active."
      }
    });
  }
});

  document.addEventListener('DOMContentLoaded', function () {
    const table = $('#reservationsTable');

    // Initialise DataTable uniquement si la table a des données (pas que le message vide)
    if (table.find('tbody tr').length > 0 && !table.find('tbody tr td[colspan]').length) {
      table.DataTable({
        // tes options DataTables ici (ex: paging, searching, etc.)
      });
    }
  });
</script>




                  <!-- /Project table -->

                  <!-- Activity Timeline -->
                <div class="card mb-6">
  <h5 class="card-header">Historique des Réservations & Statistiques</h5>
  <div class="card-body pt-1">
    <ul class="timeline mb-0">

      <!-- Total réservations -->
      <li class="timeline-item timeline-item-transparent">
        <span class="timeline-point timeline-point-primary"></span>
        <div class="timeline-event">
          <div class="timeline-header mb-3">
            <h6 class="mb-0">Total Réservations</h6>
            <small class="text-body-secondary">Aujourd’hui</small>
          </div>
          <p class="mb-2">Nombre total : <strong>{{ $allReservations->count() }}</strong></p>
        </div>
      </li>

      <!-- Contrats actifs -->
      <li class="timeline-item timeline-item-transparent">
        <span class="timeline-point timeline-point-success"></span>
        <div class="timeline-event">
          <div class="timeline-header mb-3">
            <h6 class="mb-0">Contrats Actifs</h6>
            <small class="text-body-secondary">Mise à jour</small>
          </div>
          <p class="mb-2">
            Nombre de contrats payés : <strong>{{ $allReservations->where('payment_status', 'payed')->count() }}</strong>
          </p>
        </div>
      </li>

      <!-- Montant Total -->
      <li class="timeline-item timeline-item-transparent">
        <span class="timeline-point timeline-point-info"></span>
        <div class="timeline-event">
          <div class="timeline-header mb-3">
            <h6 class="mb-0">Montant Total Réservations</h6>
            <small class="text-body-secondary">Recalculé automatiquement</small>
          </div>
          <p class="mb-2">
            <strong>{{ $allReservations->sum('total_price') }} DT</strong>
          </p>
        </div>
      </li>

      <!-- Montant Payé -->
      <li class="timeline-item timeline-item-transparent">
        <span class="timeline-point timeline-point-warning"></span>
        <div class="timeline-event">
          <div class="timeline-header mb-3">
            <h6 class="mb-0">Montant Payé</h6>
            <small class="text-body-secondary">Mis à jour récemment</small>
          </div>
          <p class="mb-2 text-success fw-bold">
            {{ $allReservations->sum('amount_paid') }} DT
          </p>
        </div>
      </li>

      <!-- Montant Non Payé -->
      <li class="timeline-item timeline-item-transparent">
        <span class="timeline-point timeline-point-danger"></span>
        <div class="timeline-event">
          <div class="timeline-header mb-3">
            <h6 class="mb-0">Montant Non Payé</h6>
            <small class="text-body-secondary">Calculé</small>
          </div>
          <p class="mb-2 text-danger fw-bold">
            {{ $allReservations->sum('total_price') - $allReservations->sum('amount_paid') }} DT
          </p>
        </div>
      </li>

      <!-- Historique des réservations -->
      @foreach($allReservations->sortByDesc('created_at')->take(5) as $reservation)
      <li class="timeline-item timeline-item-transparent">
        <span class="timeline-point timeline-point-secondary"></span>
        <div class="timeline-event">
          <div class="timeline-header mb-3">
            <h6 class="mb-0">Réservation - {{ $reservation->car->brand ?? 'Voiture' }}</h6>
            <small class="text-body-secondary">
              {{ \Carbon\Carbon::parse($reservation->created_at)->diffForHumans() }}
            </small>
          </div>
          <p class="mb-2">
            Client : <strong>{{ $client->first_name }} {{ $client->last_name }}</strong><br>
            Période : <strong>{{ \Carbon\Carbon::parse($reservation->start_date)->format('d/m/Y') }}</strong> -
            <strong>{{ \Carbon\Carbon::parse($reservation->end_date)->format('d/m/Y') }}</strong><br>
            Total : <strong>{{ $reservation->total_price }} DT</strong><br>
            Payé : <strong class="text-success">{{ $reservation->amount_paid ?? '0' }} DT</strong><br>
            Statut : 
            <span class="badge {{ $reservation->payment_status === 'payed' ? 'bg-success' : 'bg-danger' }}">
              {{ $reservation->payment_status }}
            </span>
          </p>
        </div>
      </li>
      @endforeach

    </ul>
  </div>
</div>

                  <!-- /Activity Timeline -->

                  <!-- Invoice table -->
                  <div class="card mb-4">
                    <div class="card-datatable table-responsive">
                      <table class="table datatable-invoice">
                        <thead>
                          <tr>
                            <th></th>
                            <th>#</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Issued Date</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                  </div>
                  <!-- /Invoice table -->
                </div>
                <!--/ User Content -->
              </div>

              <!-- Modal -->
              <!-- Edit User Modal -->
              <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                  <div class="modal-content">
                    <div class="modal-body">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      <div class="text-center mb-6">
                        <h4 class="mb-2">Edit User Information</h4>
                        <p>Updating user details will receive a privacy audit.</p>
                      </div>
                      <form id="editUserForm" class="row g-6" onsubmit="return false">
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="modalEditUserFirstName">First Name</label>
                          <input
                            type="text"
                            id="modalEditUserFirstName"
                            name="modalEditUserFirstName"
                            class="form-control"
                            placeholder="John"
                            value="John" />
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="modalEditUserLastName">Last Name</label>
                          <input
                            type="text"
                            id="modalEditUserLastName"
                            name="modalEditUserLastName"
                            class="form-control"
                            placeholder="Doe"
                            value="Doe" />
                        </div>
                        <div class="col-12">
                          <label class="form-label" for="modalEditUserName">Username</label>
                          <input
                            type="text"
                            id="modalEditUserName"
                            name="modalEditUserName"
                            class="form-control"
                            placeholder="johndoe007"
                            value="johndoe007" />
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="modalEditUserEmail">Email</label>
                          <input
                            type="text"
                            id="modalEditUserEmail"
                            name="modalEditUserEmail"
                            class="form-control"
                            placeholder="example@domain.com"
                            value="example@domain.com" />
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="modalEditUserStatus">Status</label>
                          <select
                            id="modalEditUserStatus"
                            name="modalEditUserStatus"
                            class="select2 form-select"
                            aria-label="Default select example">
                            <option selected>Status</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                            <option value="3">Suspended</option>
                          </select>
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="modalEditTaxID">Tax ID</label>
                          <input
                            type="text"
                            id="modalEditTaxID"
                            name="modalEditTaxID"
                            class="form-control modal-edit-tax-id"
                            placeholder="123 456 7890"
                            value="123 456 7890" />
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="modalEditUserPhone">Phone Number</label>
                          <div class="input-group">
                            <span class="input-group-text">US (+1)</span>
                            <input
                              type="text"
                              id="modalEditUserPhone"
                              name="modalEditUserPhone"
                              class="form-control phone-number-mask"
                              placeholder="202 555 0111"
                              value="202 555 0111" />
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="modalEditUserLanguage">Language</label>
                          <select
                            id="modalEditUserLanguage"
                            name="modalEditUserLanguage"
                            class="select2 form-select"
                            multiple>
                            <option value="">Select</option>
                            <option value="english" selected>English</option>
                            <option value="spanish">Spanish</option>
                            <option value="french">French</option>
                            <option value="german">German</option>
                            <option value="dutch">Dutch</option>
                            <option value="hebrew">Hebrew</option>
                            <option value="sanskrit">Sanskrit</option>
                            <option value="hindi">Hindi</option>
                          </select>
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="modalEditUserCountry">Country</label>
                          <select
                            id="modalEditUserCountry"
                            name="modalEditUserCountry"
                            class="select2 form-select"
                            data-allow-clear="true">
                            <option value="">Select</option>
                            <option value="Australia">Australia</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Belarus">Belarus</option>
                            <option value="Brazil">Brazil</option>
                            <option value="Canada">Canada</option>
                            <option value="China">China</option>
                            <option value="France">France</option>
                            <option value="Germany">Germany</option>
                            <option value="India" selected>India</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Israel">Israel</option>
                            <option value="Italy">Italy</option>
                            <option value="Japan">Japan</option>
                            <option value="Korea">Korea, Republic of</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Philippines">Philippines</option>
                            <option value="Russia">Russian Federation</option>
                            <option value="South Africa">South Africa</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Ukraine">Ukraine</option>
                            <option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="United States">United States</option>
                          </select>
                        </div>
                        <div class="col-12">
                          <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" id="editBillingAddress" />
                            <label for="editBillingAddress" class="switch-label">Use as a billing address?</label>
                          </div>
                        </div>
                        <div class="col-12 text-center">
                          <button type="submit" class="btn btn-primary me-3">Submit</button>
                          <button
                            type="reset"
                            class="btn btn-label-secondary"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                            Cancel
                          </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ Edit User Modal -->

              <!-- Add New Credit Card Modal -->
              <div class="modal fade" id="upgradePlanModal" tabindex="-1" aria-modal="true" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
                  <div class="modal-content">
                    <div class="modal-body p-4">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      <div class="text-center mb-6">
                        <h2>Upgrade Plan</h2>
                        <p class="text-body-secondary">Choose the best plan for user.</p>
                      </div>
                      <form id="upgradePlanForm" class="row g-4" onsubmit="return false">
                        <div class="col-sm-9">
                          <label class="form-label" for="choosePlan">Choose Plan</label>
                          <select id="choosePlan" name="choosePlan" class="form-select" aria-label="Choose Plan">
                            <option selected>Choose Plan</option>
                            <option value="standard">Standard - $99/month</option>
                            <option value="exclusive">Exclusive - $249/month</option>
                            <option value="Enterprise">Enterprise - $499/month</option>
                          </select>
                        </div>
                        <div class="col-sm-3 d-flex align-items-end">
                          <button type="submit" class="btn btn-primary">Upgrade</button>
                        </div>
                      </form>
                    </div>
                    <hr class="mx-md-n5 mx-n3" />
                    <div class="modal-body">
                      <h6 class="mb-0">User current plan is standard plan</h6>
                      <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div class="d-flex justify-content-center me-2 mt-1">
                          <sup class="h6 pricing-currency pt-1 mt-2 mb-0 me-1 text-primary">$</sup>
                          <h1 class="mb-0 text-primary">99</h1>
                          <sub class="pricing-duration mt-auto mb-5 pb-1 small text-body">/month</sub>
                        </div>
                        <button class="btn btn-label-danger cancel-subscription">Cancel Subscription</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ Add New Credit Card Modal -->

              <!-- /Modal -->
            </div>
@endsection