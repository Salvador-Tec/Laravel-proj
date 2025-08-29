@extends('admin.noname')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Réservations Actives</h5>
      <small class="text-muted">Liste des réservations actives</small>
    </div>
    <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Matricule</th>
            <th>Voiture</th>
            <th>Client</th>
            <th>CIN</th>
            <th>Date début</th>
            <th>Heure départ</th>
            <th>Date fin</th>
            <th>Heure retour</th>
            <th>Jours</th>
            <th>Prix/J</th>
            <th>Total</th>
            <th>Paiement</th>
            <th>Statut</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($activeDepartures as $reservation)
            <tr class="reservation-row"
                data-start-date="{{ \Carbon\Carbon::parse($reservation->start_date)->format('Y-m-d') }}"
                data-end-date="{{ \Carbon\Carbon::parse($reservation->end_date)->format('Y-m-d') }}">
              <td>{{ $reservation->id }}</td>
              <td>{{ optional($reservation->car)->matricule }}</td>
              <td>{{ optional($reservation->car)->brand }} {{ optional($reservation->car)->model }}</td>
              <td>{{ $reservation->first_name }} {{ $reservation->last_name }}</td>
              <td>{{ $reservation->identity_number }}</td>
              <td>{{ \Carbon\Carbon::parse($reservation->start_date)->format('Y-m-d') }}</td>
              <td>{{ $reservation->delivery_time }}</td>
              <td>{{ \Carbon\Carbon::parse($reservation->end_date)->format('Y-m-d') }}</td>
              <td>{{ $reservation->return_time }}</td>
              <td>{{ $reservation->days }}</td>
              <td>{{ number_format($reservation->price_per_day, 2) }}</td>
              <td>{{ number_format($reservation->total_price, 2) }}</td>
              <td>{{ $reservation->payment_status }}</td>
              <td>{{ $reservation->status }}</td>
              <td>
                <a class="btn btn-sm btn-primary" href="{{ route('reservation.showContrat', $reservation->id) }}">Voir</a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="15" class="text-center">Aucune réservation active</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection