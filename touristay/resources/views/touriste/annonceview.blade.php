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
                    <a href="/dashboard/touriste" class="text-gray-700 hover:text-green-600 transition">Accueil</a>
                    <a href="/annonce/touriste" class="text-gray-700 hover:text-green-600 transition">Annonces</a>
                    <a href="/favoris" class="text-gray-700 hover:text-green-600 transition">Favoris</a>
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

        <div class="container mx-auto px-4 py-8">
           <!-- Grille d'annonces -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @if($annonces->count() > 0)
                @foreach($annonces as $annonce)
                <!-- Carte d'annonce -->
                <div class="card bg-white rounded-xl overflow-hidden shadow-lg">
                    <div class="relative">
                        <img src="{{ old('image', $annonce->image) }}" alt="Appartement avec vue" class="w-full card-image">
                        <div class="absolute top-4 right-4 bg-purple-600 text-white px-3 py-1 rounded-full text-sm font-bold">
                            {{ old('prixparnuit', $annonce->prixparnuit) }} DH/nuit
                        </div>
                        <div class="absolute bottom-4 left-4 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                            {{ old('disponibilite', $annonce->disponibilite) }}
                        </div>
                        <form action="{{ route('favoris.toggle', $annonce->id) }}" method="POST" class="absolute top-4 left-4">
                            @csrf
                            <button type="submit" class="favorite-btn text-white bg-gray-800 bg-opacity-60 p-2 rounded-full hover:bg-red-500 transition">
                                <i class="fas fa-heart {{ $annonce->isFavorited() ? 'text-red-500' : 'text-white' }}"></i>
                            </button>
                        </form>
                    </div>
                    
                    <div class="p-5">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ old('titre', $annonce->titre) }}</h3>
                        <div class="flex items-center text-gray-600 mb-2">
                            <i class="fas fa-map-marker-alt mr-2 text-purple-600"></i>
                            <span>{{ old('adress', $annonce->adress) }}, {{ old('ville', $annonce->ville) }}</span>
                        </div>
                        <!-- Description -->
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ old('description', $annonce->description) }}
                        </p>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <div class="flex items-center mr-4">
                                    <i class="fas fa-bed mr-1 text-purple-600"></i>
                                    <span>{{ old('nbrchambre', $annonce->nbrchambre) }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-bath mr-1 text-purple-600"></i>
                                    <span>{{ old('nbrsallesebain', $annonce->nbrsallesebain) }}</span>
                                </div>
                            </div>
                        </div>
                        <!-- Équipements -->
                        <div class="border-t pt-4">
                            <div class="flex justify-around">
                                @foreach($annonce->equipement as $equip)
                                <div class="amenity-icon text-center">
                                    <i class="fas fa-{{ $equip->icon }} text-purple-600 text-xl mb-1"></i>
                                    <p class="text-xs">{{ $equip->nom }}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Bouton Réserver -->
                        <form action="{{ route('reservation.create', $annonce->id) }}" method="GET" class="mt-4">
                        <button class="w-full mt-4 bg-gradient-to-r from-purple-600 to-pink-500 text-white py-2 rounded-lg font-medium hover:opacity-90 transition duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50">
                            Réserver
                        </button>
                        </form>
                    </div>
                </div> 
                @endforeach
            @else
                <div class="col-span-3 text-center py-10">
                    <p class="text-gray-500 text-xl">Aucune annonce disponible.</p>
                </div>
            @endif
        </div>
        </div>
        
       

        <div class="flex justify-center space-x-2">
            @if ($annonces->onFirstPage())
                <span class="px-4 py-2 bg-gray-300 text-gray-600 rounded-lg">Précédent</span>
            @else
                <a href="{{ $annonces->previousPageUrl() }}" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">Précédent</a>
            @endif

            @foreach ($annonces->getUrlRange(1, $annonces->lastPage()) as $page => $url)
                @if ($page == $annonces->currentPage())
                    <span class="px-4 py-2 bg-purple-700 text-white font-bold rounded-lg">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">{{ $page }}</a>
                @endif
            @endforeach

            @if ($annonces->hasMorePages())
                <a href="{{ $annonces->nextPageUrl() }}" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">Suivant</a>
            @else
                <span class="px-4 py-2 bg-gray-300 text-gray-600 rounded-lg">Suivant</span>
            @endif
        </div>
    </div>
</body>
</html>