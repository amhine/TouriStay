<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - TouriStay</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #6ee7b7 0%, #3b82f6 100%);
        }
        .profile-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center ">
    <!-- Navbar pour TouriStay -->
    <nav class="bg-white shadow-md w-full">
        <div class="container mx-auto px-4 py-2">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-green-600">TouriStay</span>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="/dashboard/proprietaire" class="text-gray-700 hover:text-green-600 transition">Accueil</a>
                    <a href="/annonce" class="text-gray-700 hover:text-green-600 transition">Annonces</a>
                    <a href="/profile" class="text-gray-700 hover:text-green-600 transition">Profil</a>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    <form action="/logout" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 rounded bg-green-600 text-white hover:bg-green-700 transition">
                            Logout
                        </button>
                    </form>
                </div>
                <div class="md:hidden">
                    <button class="text-gray-700 focus:outline-none">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Carte de profil -->
    <div class="gradient-bg max-w-4xl w-full rounded-2xl shadow-2xl overflow-hidden p-8 space-y-8 text-white mt-8">
        <!-- En-tête du profil -->
        <header class="text-center">
            <h2 class="text-4xl font-bold">Mon Profil</h2>
            <p class="text-sm text-gray-200">Gérez vos informations personnelles et vos paramètres de compte.</p>
        </header>

        <!-- Informations utilisateur -->
        <section class="space-y-6">
            <div class="flex justify-center items-center space-x-6">
                <img src="{{ old('image', $user->image) }}" alt="Avatar" class="rounded-full w-28 h-28 object-cover border-4 border-white shadow-lg">
                <div>
                    <h3 class="text-2xl font-semibold">{{ old('name', $user->name) }}</h3>
                    <p class="text-sm text-gray-200">{{ old('email', $user->email) }}</p>
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <h4 class="text-lg font-semibold">Informations personnelles</h4>
                    <p class="text-sm text-gray-200">Téléphone : +212{{ old('numtel', $user->numtel) }}</p>
                    <p class="text-sm text-gray-200">Adresse :{{ old('adress', $user->adress) }}</p>
                </div>
            </div>
        </section>

        <!-- Actions : Modifier profil, changer mot de passe -->
        <section class="mt-8 space-y-6">
            <div class="flex justify-center space-x-6">
                <a href="/editprf" class="glass-effect px-8 py-3 rounded-lg text-white hover:bg-white hover:text-gray-900 transition duration-300 flex items-center space-x-2">
                    <i class="fas fa-user-edit"></i>
                    <span>Modifier le profil</span>
                </a>
                <a href="/changepassword" class="glass-effect px-8 py-3 rounded-lg text-white hover:bg-white hover:text-gray-900 transition duration-300 flex items-center space-x-2">
                    <i class="fas fa-lock"></i>
                    <span>Changer le mot de passe</span>
                </a>
            </div>
        </section>

  

        </section>

        
    </div>

</body>
</html>