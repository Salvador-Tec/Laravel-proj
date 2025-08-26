@extends('layouts.myapp')

@section('content')
<div class="p-6">
    <script src="https://cdn.tailwindcss.com"></script>

<h2 class="text-3xl font-bold text-orange-700 mb-8 text-center">
  <i class="fas fa-user-circle mr-2"></i>
  Informations Client
</h2>

    {{-- Résultats --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Carte exemple statique --}}
        <div class="bg-white shadow-xl rounded-xl p-6 border border-orange-100 hover:shadow-2xl transition">
            <div class="flex items-center space-x-5 mb-4">
                                    <img src="{{ asset($reservation->car->image) }}" class="w-20 h-20 object-cover rounded-md shadow" />

                <div>
                    <h3 class="text-xl font-bold text-orange-800">{{ $reservation->car->brand }} {{ $reservation->car->model }}</h3>
                    <p class="text-sm text-gray-600 leading-6">
                        <strong> 🚗 Matricule :</strong> {{ $reservation->car->matricule }}<br>
                        <strong> ⚙️Type Boite :</strong>  {{ $reservation->car->gearbox_type ?? 'Aucun type de boite disponible' }}
<br>

                        <strong> ➡️Départ :</strong> {{ \Carbon\Carbon::parse($reservation->start_date)->format('d/m/Y') }}<br>
                        <strong> 📅Retour :</strong> {{ \Carbon\Carbon::parse($reservation->end_date)->format('d/m/Y') }}<br>
                        <strong> ⏳Durée :</strong> {{ $reservation->days }} jours


                    </p>
                </div>
            </div>

            {{-- client --}}
            <div class="mt-3 border-t pt-3 rounded-md px-3 py-2 bg-gray-50">
                <h4 class="font-semibold text-orange-700">
                    <h4 class="font-semibold text-orange-700">
    <i ></i> 🧑‍💼 Client
</h4>

</h4>

                <p class="text-sm text-gray-700 leading-5">
                    👤Nom : {{ $reservation->first_name }} {{ $reservation->last_name }}<br>
                    🪪 Numéro d'identité :  {{ $reservation->identity_number }}<br>
                     📞Mobile : {{ $reservation->mobile_number }}<br>
                    🧑‍🤝‍🧑 deuxième Condcuteur? :<p class="text-xs text-gray-600 dark:text-gray-400">
                                                            @if ($reservation->last_name_conducteur && $reservation->first_name_conducteur)
                                                                {{ $reservation->last_name_conducteur }} {{ $reservation->first_name_conducteur }}
                                                            @else
                                                            <span class="font-bold text-blue-600 underline">Aucun deuxième conducteur attribué</span>

                                                            @endif
                                                        </p>
                </p>
            </div>

            {{-- prix --}}
            <div class="mt-3 border-t pt-3 rounded-md px-3 py-2 bg-gray-50">
                <h4 class="font-semibold text-orange-700">💰Prix</h4>
                <p class="text-sm text-gray-700 leading-5">
                    🏷️ Garantie : {{ number_format($reservation->garantie, 2) }} DT<br>
                    💳 methode de payment : {{ $reservation->payment_method }}<br>
                    💶 prix :  {{ number_format($reservation->total_price, 2) }} DT<br><br>

                    ⏳ status de payment :  <td class="px-0 py-3 text-sm">
                                                @if ($reservation->payment_status == 'payed')
                                                    <span class="p-1 text-white rounded-md bg-green-500">Payé</span>
                                                @elseif ($reservation->payment_status === 'Partiellement payé')
                                                    <span class="p-0.5 text-white rounded-md bg-green-500">{{ $reservation->amount_paid }}</span>
                                                    <span class="p-0.5 text-white rounded-md bg-red-500">{{ number_format($reservation->total_price - $reservation->amount_paid, 2) }}</span>
                                                @elseif ($reservation->payment_status == 'non payé')
                                                    <span class="p-1 text-white rounded-md bg-red-500">Non payé</span>
                                                @endif
                                            </td><br><br>
                   ⏳ Status:   @php
    $status = strtolower(trim($reservation->status));
    $statusConfig = [
        'pré-réservé' => ['color' => '#64748b', 'icon' => 'fas fa-clock'],
        'reserve' => ['color' => '#f97316', 'icon' => 'fas fa-hourglass-half'],
        'active' => ['color' => '#22c55e', 'icon' => 'fas fa-check-circle'],
        'clôturé' => ['color' => '#ef4444', 'icon' => 'fas fa-ban'],
        'prolongé'    => ['color' => '#3b82f6', 'icon' => 'fas fa-calendar-plus'],
    ];
    $backgroundColor = $statusConfig[$status]['color'] ?? '#6b7280';
    $icon = $statusConfig[$status]['icon'] ?? 'fas fa-question';
@endphp

    <span class="inline-flex items-center gap-2 px-2 py-1 rounded-md text-white font-medium"
          style="background-color: {{ $backgroundColor }};"
          id="status-display-{{ $reservation->id }}">
        <i class="{{ $icon }}"></i>
        <span class="status-text">{{ ucfirst($status) }}</span>
    </span>
                </p>
            </div>

            
        </div>
    </div>
</div>

{{-- Script des jours restants --}}
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
@endsection
