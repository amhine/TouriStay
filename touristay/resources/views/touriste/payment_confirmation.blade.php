<!DOCTYPE html>
<html>
<head>
    <title>Confirmation de votre réservation</title>
</head>
<body>
    <h1>Bonjour {{ $reservation->touriste->name }},</h1>

    <p>Nous vous confirmons la réception de votre paiement.</p>

    <h3>Détails de votre réservation :</h3>
    <ul>
        <li><strong>Annonce :</strong> {{ $reservation->annonce->titre }}</li>
        <li><strong>Date de début :</strong> {{ $reservation->dateDebut }}</li>
        <li><strong>Date de fin :</strong> {{ $reservation->dateFin }}</li>
        <li><strong>Prix total :</strong> {{ $reservation->total }} USD</li>
    </ul>

    <h3>Coordonnées du propriétaire :</h3>
    <p>Nom : {{ $proprietaire->name }}</p>
    <p>Email : {{ $proprietaire->email }}</p>
    <p>Téléphone : {{ $proprietaire->phone }}</p>

    <p>Merci de votre confiance et bon séjour !</p>
    
    <p>L'équipe Touristay</p>
</body>
</html>
