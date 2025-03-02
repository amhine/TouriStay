<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mes Favoris | TouriStay</title>
    
    <!-- Font Awesome & TailwindCSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Styles personnalisés -->
    <style>
        .favorite-btn:hover i {
            color: #e3342f; /* Rouge plus vif au survol */
        }
    </style>
</head>
<body class="bg-gray-100">

    <!-- Navigation -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-2">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-green-600">TouriStay</span>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="/touriste/dashboard" class="text-gray-700 hover:text-green-600 transition">Accueil</a>
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
        @if($annonces->isEmpty())
            <p class="text-center text-gray-600 text-lg">Vous n'avez ajouté aucune annonce en favori.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- @foreach ($annonces as $annonce)
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <img src="{{ ( $annonce->image) }}" class="w-full h-48 object-cover" alt="Image de {{ $annonce->titre }}">

                        <div class="p-4">
                            <h5 class="text-xl font-semibold text-gray-800">{{ $annonce->titre }}</h5>
                            <p class="text-gray-600 mt-2">{{ Str::limit($annonce->description, 80) }}</p>
                            <p class="text-green-600 font-bold mt-2">Prix: {{ $annonce->prixparnuit }}€/nuit</p>

                            <!-- Boutons -->
                            <div class="flex justify-between items-center mt-4">
                                <form action="{{ route('favoris.toggle', $annonce->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="favorite-btn text-red-500 hover:text-red-600 transition">
                                        <i class="fas fa-heart-broken text-2xl"></i>
                                    </button>
                                </form>

                                <div class="text-center mt-6">
                                    <a href="{{ route('annonce') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                                        Retour aux annonces
                                    </a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                @endforeach --}}

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
                        <!-- Bouton Réserver -->
                        <!-- Boutons -->
                        <div class="flex justify-between items-center mt-4">
                            <form action="{{ route('favoris.toggle', $annonce->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="favorite-btn text-red-500 hover:text-red-600 transition">
                                    <i class="fas fa-heart-broken text-2xl"></i>
                                </button>
                            </form>

                            <div class="text-center mt-6">
                                <a href="{{ route('annonce') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                                    Retour aux annonces
                                </a>
                            </div>
                            
                        </div>
                    </div>
                </div> 
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6 flex justify-center">
                {{ $annonces->links() }}
            </div>
        @endif
    </div>

</body>
</html>
