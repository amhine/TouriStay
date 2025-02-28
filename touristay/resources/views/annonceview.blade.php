<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annonces Immobilières - TouriStay</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .card-image {
            height: 200px;
            object-fit: cover;
        }
        .amenity-icon {
            transition: all 0.3s ease;
        }
        .amenity-icon:hover {
            transform: translateY(-3px);
        }
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-md">
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

    <div class="container mx-auto px-4 py-8">
        <!-- Barre de Recherche -->
        <form action="{{ route('annonce') }}" method="GET" class="mb-8 bg-white rounded-lg shadow-md p-4">
            <div class="flex flex-wrap items-center justify-between gap-4">
              
                <div class="flex flex-wrap gap-2">
                    <input type="text" name="ville" value="{{ request('ville') }}" placeholder="Rechercher par ville" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 w-60">
                    <input type="date" name="disponibilite" value="{{ request('disponibilite') }}" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>
                <div>
                    <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg transition duration-300 flex items-center">
                        <i class="fas fa-search mr-2"></i> Rechercher
                    </button>
                </div>
            </div>
        </form>

        <!-- Grille d'annonces -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @if($annonces->count() > 0)
                @foreach($annonces as $annonce)
                <!-- Carte d'annonce -->
                <div class="card bg-white rounded-xl overflow-hidden shadow-lg">
                    <div class="relative">
                        <img src="{{ $annonce->image }}" alt="Appartement avec vue" class="w-full card-image">
                        <div class="absolute top-4 right-4 bg-purple-600 text-white px-3 py-1 rounded-full text-sm font-bold">
                            {{ $annonce->prixparnuit }} DH/nuit
                        </div>
                        <div class="absolute bottom-4 left-4 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                            {{ $annonce->disponibilite }}
                        </div>
                    </div>
                    <div class="p-5">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $annonce->titre }}</h3>
                        <div class="flex items-center text-gray-600 mb-2">
                            <i class="fas fa-map-marker-alt mr-2 text-purple-600"></i>
                            <span>{{ $annonce->adress }}, {{ $annonce->ville }}</span>
                        </div>
                        <p class="text-gray-600 mb-4 line-clamp-3">{{ $annonce->description }}</p>
                        
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <div class="flex items-center mr-4">
                                    <i class="fas fa-bed mr-1 text-purple-600"></i>
                                    <span>{{ $annonce->nbrchambre }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-bath mr-1 text-purple-600"></i>
                                    <span>{{ $annonce->nbrsallesebain }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border-t pt-4">
                            <div class="flex justify-around">
                                @foreach($equipement as $equip)
                                <div class="amenity-icon text-center">
                                    <i class="fas fa-{{ $equip->icon }} text-purple-600 text-xl mb-1"></i>
                                    <p class="text-xs">{{ $equip->nom }}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <button class="w-full mt-4 bg-gradient-to-r from-purple-600 to-pink-500 text-white py-2 rounded-lg font-medium hover:opacity-90 transition duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50">
                            Reserver
                        </button>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-span-3 text-center py-10">
                    <p class="text-gray-500 text-xl">Aucune annonce trouvée pour ces critères.</p>
                </div>
            @endif
        </div>
        
        <!-- Pagination -->
        <div class="mt-10 flex justify-center">
            {{ $annonces->links() }}
        </div>
    </div>
</body>
</html>