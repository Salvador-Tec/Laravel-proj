<!-- resources/views/contrat.blade.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrat de Location</title>
    <style>
        /* Réglages globaux */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 30px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* En-tête avec cadre */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #004b8d;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .logo {
            text-align: center;
            width: 30%;
        }

        .logo img {
            max-width: 100%;
            height: auto;
        }

        .coordonnees {
            display: flex;
            justify-content: space-between;
            width: 60%;
            font-size: 14px;
        }

        .coordonnees div {
            width: 48%;
        }

        .coordonnees .francais {
            text-align: left;
        }

        .coordonnees .arabe {
            text-align: right;
            direction: rtl;
        }

        h1, h2 {
            margin: 10px 0;
            color: #004b8d;
        }

        h3 {
            color: #1e88e5;
            text-align: center;
            margin-bottom: 20px;
        }

        h4 {
            color: #004b8d;
            margin-bottom: 10px;
        }

        .info-section {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 10px;
            font-size: 14px;
        }

        .label {
            font-weight: bold;
            color: #333;
        }

        .value {
            color: #555;
        }

        .voiture-images {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .voiture-images img {
            max-width: 23%;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .facturation {
            margin-top: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .important {
            margin-top: 30px;
            background-color: #f2f2f2;
            padding: 10px;
            border-left: 5px solid #f44336;
        }

        .signatures {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }

        .signatures div {
            width: 45%;
            text-align: center;
        }

        .signatures hr {
            margin-top: 20px;
            border-top: 1px solid #ccc;
        }

        footer {
            text-align: center;
            margin-top: 40px;
            color: #777;
            font-size: 12px;
        }

        .footer-note {
            margin-top: 20px;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <!-- Coordonnées en français à gauche -->
            <div class="coordonnees francais">
                <p><strong>Sigma Prime</strong><br>Location de voitures<br>Adresse : Rue de la Paix, 1000 Ville<br>Tél : +33 1 23 45 67 89</p>
            </div>

            <!-- Logo centré -->
            <div class="logo">
                <img src="{{ asset('images/logos/LOGOtext.png') }}" alt="Logo Sigma Prime">
            </div>

            <!-- Coordonnées en arabe à droite -->
            <div class="coordonnees arabe">
                <p><strong>سيغما برايم</strong><br>تأجير السيارات<br>العنوان: شارع السلام، 1000 مدينة<br>هاتف: +33 1 23 45 67 89</p>
            </div>
        </header>

        <section class="contrat">
            <h3>Contrat de Location N° {{ $reservation->id }}</h3>

            <div class="info-section">
                <h4>Identité de la location</h4>
                <div class="info-grid">
                    <div class="label">Nom et Prénom :</div>
                    <div class="value">{{ $reservation->client_name }}</div>
                    <div class="label">Matricule :</div>
                    <div class="value">{{ $reservation->matricule }}</div>
                    <div class="label">Type de Voiture :</div>
                    <div class="value">{{ $reservation->car_type }}</div>
                </div>
            </div>

            <div class="info-section">
                <h4>Durée de la location</h4>
                <div class="info-grid">
                    <div class="label">Du :</div>
                    <div class="value">{{ \Carbon\Carbon::parse($reservation->start_date)->format('d/m/Y') }}</div>
                    <div class="label">Au :</div>
                    <div class="value">{{ \Carbon\Carbon::parse($reservation->end_date)->format('d/m/Y') }}</div>
                </div>
            </div>

            <div class="voiture">
                <h4>État de la voiture</h4>
                <div class="voiture-images">
                    <img src="{{ asset('images/voiture_avant.png') }}" alt="Avant">
                    <img src="{{ asset('images/voiture_gauche.png') }}" alt="Gauche">
                    <img src="{{ asset('images/voiture_arriere.png') }}" alt="Arrière">
                    <img src="{{ asset('images/voiture_droite.png') }}" alt="Droite">
                </div>
            </div>

            <div class="facturation">
                <h4>Facturation</h4>
                <div class="info-grid">
                    <div class="label">Prix par jour :</div>
                    <div class="value">{{ number_format($reservation->price_per_day, 2) }} €</div>
                    <div class="label">Total Facture :</div>
                    <div class="value">{{ number_format($reservation->total_invoice, 2) }} €</div>
                </div>
            </div>

            <div class="important">
                <h4>Important</h4>
                <p>{{ $reservation->important_note }}</p>
            </div>

            <div class="signatures">
                <div class="agent">
                    <p>Signature de l'agent</p>
                    <hr>
                </div>
                <div class="client">
                    <p>Signature du client</p>
                    <hr>
                </div>
            </div>
        </section>

        <footer>
            <p>© 2024 Sigma Prime - Tous droits réservés</p>
            <p class="footer-note">Ce contrat est généré électroniquement et n'a pas besoin de signature manuscrite.</p>
        </footer>
    </div>
</body>
</html>
