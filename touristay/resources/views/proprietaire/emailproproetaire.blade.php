<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle réservation confirmée</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #004D40;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 20px;
        }

        .content h2 {
            color: #004D40;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .details {
            margin: 20px 0;
            padding: 15px;
            background-color: #f0f0f0;
            border-radius: 5px;
        }

        .details p {
            margin: 10px 0;
            font-size: 14px;
            color: #333;
        }

        .details p strong {
            color: #004D40;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            padding: 20px;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #e0e0e0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Nouvelle Réservation Confirmée</h1>
        </div>

        <div class="content">
            <h2>Bonjour {{ $proprietaire->name }},</h2>

            <p>Une nouvelle réservation a été effectuée sur votre annonce.</p>

            <div class="details">
                <p><strong>Touriste :</strong> {{ $touriste->name }}</p>
                <p><strong>Annonce :</strong> {{ $reservation->annonce->titre }}</p>
                <p><strong>Prix Total :</strong> {{ $reservation->prix_total }} $</p>
                <p><strong>Date d'arrivée :</strong> {{ $reservation->date_debut }}</p>
                <p><strong>Date de départ :</strong> {{ $reservation->date_fin }}</p>
            </div>

            <p>Merci d'utiliser Touristay !</p>
        </div>

       
    </div>
</body>
</html>
