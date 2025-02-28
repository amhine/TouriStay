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
                <span class="text-2xl font-bold text-green-600">TouriStay</span>
                <div class="hidden md:flex space-x-8">
                    <a href="/proprietaire/dashboard" class="text-gray-700 hover:text-green-600 transition">Accueil</a>
                    <a href="/annonce/proprietaire" class="text-gray-700 hover:text-green-600 transition">Annonces</a>
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
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <!-- Bouton Ajouter une annonce -->
        <div class="flex justify-end mb-6">
            <a href="/annonce/ajouter" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-300">
                Ajouter une annonce
            </a>
        </div>

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
                        <div class="flex flex-nowrap space-x-4 mt-4">
                            <!-- Bouton Modifier -->
                            <a href="{{ route('annonce.edit', $annonce->id) }}" 
                               class="w-1/2 text-center bg-gradient-to-r from-blue-600 to-blue-400 text-white py-2 rounded-lg font-medium hover:opacity-90 transition duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                Modifier
                            </a>
                        
                            <!-- Bouton Supprimer -->
                            <form action="{{ route('annonces.destroy', $annonce->id) }}" method="POST"
                                  onsubmit="return confirm('Voulez-vous vraiment supprimer cette annonce ?');"
                                  class="w-1/2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-full bg-gradient-to-r from-red-600 to-red-400 text-white py-2 rounded-lg font-medium hover:opacity-90 transition duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                        
                        
                        
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

</body>
</html>
