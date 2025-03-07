<!-- resources/views/emails/reservation_proprietaire.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nouvelle réservation sur votre hébergement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
        }
        .header {
            background-color: #4a89dc;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        .reservation-details {
            background-color: #f9f9f9;
            padding: 15px;
            margin-top: 20px;
            border-radius: 5px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 0.8em;
            color: #777;
        }
        .button {
            display: inline-block;
            background-color: #4a89dc;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Nouvelle réservation!</h1>
    </div>
    
    <div class="content">
        <p>Bonjour {{ $proprietaire->name }},</p>
        
        <p>Bonne nouvelle! Votre hébergement "<strong>{{ $titreAnnonce }}</strong>" vient d'être réservé par {{ $nomClient }}.</p>
        
        <div class="reservation-details">
            <h3>Détails de la réservation:</h3>
            <p><strong>Numéro de réservation:</strong> #{{ $reservation->id }}</p>
            <p><strong>Dates:</strong> Du {{ date('d/m/Y', strtotime($dateDebut)) }} au {{ date('d/m/Y', strtotime($dateFin)) }}</p>
            
            @php
                $debut = new DateTime($dateDebut);
                $fin = new DateTime($dateFin);
                $nuits = $fin->diff($debut)->days;
                $nuits = max(1, $nuits);
            @endphp
            
            <p><strong>Nombre de nuits:</strong> {{ $nuits }}</p>
            <p><strong>Montant total:</strong> {{ $prixTotal }} USD</p>
            <p><strong>Client:</strong> {{ $nomClient }}</p>
            <p><strong>Email du client:</strong> {{ $emailClient }}</p>
        </div>
        
        <p>Le paiement a été effectué avec succès et la réservation est maintenant confirmée.</p>
        
        <p>Nous vous recommandons de contacter le client pour:</p>
        <ul>
            <li>Confirmer les détails de son arrivée</li>
            <li>Organiser la remise des clés</li>
            <li>Répondre à ses questions éventuelles</li>
        </ul>
        
        <p>Merci de faire partie de notre communauté Touristay!</p>
        
        <p>Cordialement,<br>L'équipe Touristay</p>
    </div>
    
    <div class="footer">
        <p>© {{ date('Y') }} Touristay. Tous droits réservés.</p>
        <p>Si vous avez des questions, veuillez nous contacter à support@touristay.com</p>
    </div>
</body>
</html>