<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement PayPal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-2xl rounded-lg p-8 w-96 text-center transform transition-transform hover:scale-105">
        <!-- Logo PayPal -->
        <div class="mb-6">
            <i class="fab fa-paypal text-4xl text-blue-500"></i>
        </div>

        <h2 class="text-2xl font-bold mb-4 text-gray-800">Paiement sécurisé</h2>
        <p class="text-gray-600 mb-6">Finalisez votre réservation en toute sécurité avec PayPal.</p>
        
        <!-- Détails de la réservation -->
        <div class="mb-6 text-left bg-gray-50 p-4 rounded-lg">
            <p class="mb-2"><span class="font-semibold text-gray-700">Article :</span> <span class="text-gray-600">{{ $reservation->annonce->titre }}</span></p>
            <p class="mb-2"><span class="font-semibold text-gray-700">Prix par nuit :</span> <span class="text-gray-600">{{ $reservation->annonce->prixparnuit }} DH/nuit</span></p>
            <p class="mb-2">
                <span class="font-semibold text-gray-700">Nombre de nuits :</span> 
                <span class="text-gray-600">{{ $nombreDeNuits }}</span>
            </p>
            
            <p class="text-lg font-bold mt-3 text-gray-800">
                Total : <span class="text-blue-500">{{ $prixTotal }}€</span>
            </p>
        </div>
        
        <form action="{{ route('payment', ['reservationId' => $reservation->id]) }}" method="POST">
    @csrf <!-- Include the CSRF token for security -->
    <button type="submit" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg transition-colors duration-300">
        <i class="fab fa-paypal mr-2"></i>Payer avec PayPal
    </button>
</form>

         
         
         

        <!-- Message de sécurité -->
        <p class="text-sm text-gray-500 mt-6">
            <i class="fas fa-lock mr-1"></i>Vos informations sont sécurisées.
        </p>
    </div>
</body>
</html>
