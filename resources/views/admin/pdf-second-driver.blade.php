<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; padding: 30px; }
        h2 { text-align: center; color: darkblue; }
    </style>
</head>
<body>
    <h2>Contrat - Deuxième Conducteur</h2>

    <p><strong>Nom :</strong> {{ $reservation->first_name_conducteur }} {{ $reservation->last_name_conducteur }}</p>
    <p><strong>CIN :</strong> {{ $reservation->identity_number_conducteur }}</p>
    <p><strong>Téléphone :</strong> {{ $reservation->mobile_number_conducteur }}</p>

    @if($car)
        <p><strong>Voiture :</strong> {{ $car->brand }} {{ $car->model }} - {{ $car->registration_number }}</p>
    @endif

    <p><strong>Date de début :</strong> {{ $reservation->start_date }}</p>
    <p><strong>Date de fin :</strong> {{ $reservation->end_date }}</p>
</body>
</html>
