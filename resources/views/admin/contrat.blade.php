<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #ffffff;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding-top: 30px;
    }

    .container {
      width: 80%;
      max-width: 700px;
      margin: 0 auto;
    }

    h2 {
      text-align: center;
      margin-top: 30px;
      margin-bottom: 10px;
      color: #333;
    }

    table {
      width: 100%;
      margin-bottom: 20px;
      border-collapse: collapse;
    }

    td {
      padding: 5px 0;
      font-size: 15px;
    }

    .print-container {
      text-align: center;
      margin: 30px 0;
    }

    button {
      padding: 10px 20px;
      background-color: red;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }

    @media print {
      .print-container {
        display: none;
      }
    }
  </style>
</head>
<body>

  <div class="container">
    
    <!-- Client principal -->
    <h2>Client Principal</h2>
    <table>
      <tr><td>Nom: {{ $reservation->first_name }} {{ $reservation->last_name }}</td></tr>
      <tr><td>Date de Naissance: {{ $reservation->date_of_birth }} {{ $reservation->place_of_birth }}</td></tr>
      <tr><td>Nationality: {{ $reservation->nationality }}</td></tr>
      <tr><td>Cin: {{ $reservation->identity_number }}</td></tr>
      <tr><td>Permis: {{ $reservation->driver_license_number }}</td></tr>
      <tr><td>Telephone: {{ $reservation->mobile_number }}</td></tr>
      <tr><td>Address: {{ $reservation->address }}</td></tr>
    </table>

    <!-- Conducteur supplémentaire -->
    @if($reservation->first_name_conducteur)
    <h2>Conducteur Supplémentaire</h2>
    <table>
      <tr><td>Nom: {{ $reservation->first_name_conducteur }} {{ $reservation->last_name_conducteur }}</td></tr>
      <tr><td>Date de Naissance: {{ $reservation->date_of_birth_conducteur }} {{ $reservation->place_of_birth_conducteur }}</td></tr>
      <tr><td>Nationality: {{ $reservation->nationality_conducteur }}</td></tr>
      <tr><td>Cin: {{ $reservation->identity_number_conducteur }}</td></tr>
      <tr><td>Permis: {{ $reservation->driver_license_number_conducteur }}</td></tr>
      <tr><td>Telephone: {{ $reservation->mobile_number_conducteur }}</td></tr>
      <tr><td>Address: {{ $reservation->address_conducteur }}</td></tr>
    </table>
    @endif

    <!-- Véhicule -->
    <h2>Véhicule</h2>
    <table>
      <tr><td>Matricule : {{ $reservation->car->matricule }}</td></tr>
      <tr><td>Marque : {{ $reservation->car->brand }}</td></tr>
      <tr><td>Lieu de prise : {{ $reservation->car->pickup_location }}</td></tr>
      <tr><td>Lieu de retour : {{ $reservation->car->return_location }}</td></tr>
    </table>

    <!-- Durée de location -->
    <h2>Durée de location</h2>
    <table>
      <tr><td>Du : {{ $reservation->start_date }}</td></tr>
      <tr><td>Au : {{ $reservation->end_date }}</td></tr>
      <tr><td>Durée : {{ \Carbon\Carbon::parse($reservation->end_date)->diffInDays(\Carbon\Carbon::parse($reservation->start_date)) }} jours</td></tr>
    </table>

    <!-- Montant -->
    <h2>Montant à payer</h2>
    <table>
      <tr><td>Total : {{ $reservation->car->price_per_day * $reservation->days }} TND</td></tr>
      <tr><td>Méthode de paiement : {{ $reservation->payment_method ?? 'Non spécifiée' }}</td></tr>
      <tr><td>Statut du paiement : {{ $reservation->payment_status }}</td></tr>
    </table>

    <!-- Bouton PDF -->
    <div class="print-container">
      <button onclick="generatePDF()">🖨️ Imprimer le contrat</button>
    </div>
  </div>

  <!-- Scripts JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script>
    function generatePDF() {
      const { jsPDF } = window.jspdf;
      const printContainer = document.querySelector('.print-container');
      printContainer.style.display = 'none';

      html2canvas(document.body).then(function(canvas) {
        const doc = new jsPDF('p', 'mm', 'a4');
        const imgData = canvas.toDataURL('image/png');
        const imgProps = doc.getImageProperties(imgData);
        const pdfWidth = doc.internal.pageSize.getWidth();
        const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

        doc.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
        doc.save('contrat_location.pdf');

        printContainer.style.display = 'block';
      });
    }
  </script>

</body>
</html>
