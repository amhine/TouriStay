<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TouriStay 2030 - Location pour le Mondial 2030</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.10.3/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
 
</head>
<body class="font-sans">
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

    <!-- Hero Section -->
    <section class="hero-section h-screen flex items-center justify-center text-white bg-green-700">
        <div class="container mx-auto px-4 text-center ">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">Trouvez votre logement pour le Mondial 2030</h1>
            <p class="text-xl md:text-2xl mb-8">Solution simple et rapide pour louer des maisons et appartements pour le Mondial 2030 "Morocco-Spain-Portugal"</p>
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-4xl mx-auto">
                <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
                    <div class="w-full md:w-1/3">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Destination</label>
                        <select class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-600">
                            <option>Toutes les villes</option>
                            <option>Casablanca, Maroc</option>
                            <option>Rabat, Maroc</option>
                            <option>Madrid, Espagne</option>
                            <option>Barcelone, Espagne</option>
                            <option>Lisbonne, Portugal</option>
                            <option>Porto, Portugal</option>
                        </select>
                    </div>
                    <div class="w-full md:w-1/3">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Dates</label>
                        <input type="date" class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-600">
                    </div>
                    <div class="w-full md:w-1/4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Voyageurs</label>
                        <select class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-600">
                            <option>1 voyageur</option>
                            <option>2 voyageurs</option>
                            <option>3 voyageurs</option>
                            <option>4+ voyageurs</option>
                        </select>
                    </div>
                    <div class="w-full md:w-auto">
                        <button class="w-full md:w-auto bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition">
                            Rechercher
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Destinations Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Destinations du Mondial 2030</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Maroc -->
                <div class="destination-card bg-white rounded-lg overflow-hidden shadow-md transition duration-300">
                    <img src="/api/placeholder/400/250" alt="Maroc" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <span class="w-8 h-8 rounded-full bg-red-600 flex items-center justify-center text-white mr-2">
                                <i class="fas fa-landmark"></i>
                            </span>
                            <h3 class="text-xl font-bold">Maroc</h3>
                        </div>
                        <p class="text-gray-600 mb-4">Découvrez l'hospitalité marocaine et profitez des matchs dans les villes de Casablanca, Rabat, Marrakech et Tanger.</p>
                        <a href="#" class="text-green-600 hover:text-green-700 font-semibold flex items-center">
                            Explorer <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Espagne -->
                <div class="destination-card bg-white rounded-lg overflow-hidden shadow-md transition duration-300">
                    <img src="/api/placeholder/400/250" alt="Espagne" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <span class="w-8 h-8 rounded-full bg-yellow-500 flex items-center justify-center text-white mr-2">
                                <i class="fas fa-sun"></i>
                            </span>
                            <h3 class="text-xl font-bold">Espagne</h3>
                        </div>
                        <p class="text-gray-600 mb-4">Vivez l'ambiance festive espagnole et assistez aux matchs à Madrid, Barcelone, Séville et Valence.</p>
                        <a href="#" class="text-green-600 hover:text-green-700 font-semibold flex items-center">
                            Explorer <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Portugal -->
                <div class="destination-card bg-white rounded-lg overflow-hidden shadow-md transition duration-300">
                    <img src="/api/placeholder/400/250" alt="Portugal" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <span class="w-8 h-8 rounded-full bg-green-600 flex items-center justify-center text-white mr-2">
                                <i class="fas fa-water"></i>
                            </span>
                            <h3 class="text-xl font-bold">Portugal</h3>
                        </div>
                        <p class="text-gray-600 mb-4">Explorez la beauté du Portugal et ne manquez pas les matchs à Lisbonne, Porto et autres villes hôtes.</p>
                        <a href="#" class="text-green-600 hover:text-green-700 font-semibold flex items-center">
                            Explorer <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Types de logements Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Types de logements</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white p-4 rounded-lg shadow text-center hover:shadow-lg transition">
                    <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-home text-2xl"></i>
                    </div>
                    <h3 class="font-bold mb-2">Maisons</h3>
                    <p class="text-gray-600 text-sm">Idéal pour les groupes</p>
                </div>
                
                <div class="bg-white p-4 rounded-lg shadow text-center hover:shadow-lg transition">
                    <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-building text-2xl"></i>
                    </div>
                    <h3 class="font-bold mb-2">Appartements</h3>
                    <p class="text-gray-600 text-sm">Pour les couples et petits groupes</p>
                </div>
                
                <div class="bg-white p-4 rounded-lg shadow text-center hover:shadow-lg transition">
                    <div class="w-16 h-16 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-hotel text-2xl"></i>
                    </div>
                    <h3 class="font-bold mb-2">Villas</h3>
                    <p class="text-gray-600 text-sm">Pour une expérience luxueuse</p>
                </div>
                
                <div class="bg-white p-4 rounded-lg shadow text-center hover:shadow-lg transition">
                    <div class="w-16 h-16 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-bed text-2xl"></i>
                    </div>
                    <h3 class="font-bold mb-2">Chambres</h3>
                    <p class="text-gray-600 text-sm">Options économiques</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Fonctionnalités -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Pourquoi choisir TouriStay 2030</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-20 h-20 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shield-alt text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Réservations Sécurisées</h3>
                    <p class="text-gray-600">Paiements sécurisés et vérification des hôtes pour votre tranquillité d'esprit</p>
                </div>
                
                <div class="text-center">
                    <div class="w-20 h-20 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-map-marked-alt text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Proximité des Stades</h3>
                    <p class="text-gray-600">Trouvez des logements proches des stades du Mondial 2030</p>
                </div>
                
                <div class="text-center">
                    <div class="w-20 h-20 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-headset text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Support 24/7</h3>
                    <p class="text-gray-600">Assistance disponible à tout moment pendant votre séjour</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Témoignages -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Ce que disent nos clients</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-500 flex mr-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span class="text-gray-600">5.0</span>
                    </div>
                    <p class="text-gray-600 mb-4">"Excellent service! J'ai pu réserver facilement un appartement à Rabat pour assister aux matchs. Tout était parfait."</p>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gray-300 rounded-full mr-3"></div>
                        <div>
                            <h4 class="font-semibold">Sophie Martin</h4>
                            <p class="text-sm text-gray-500">France</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-500 flex mr-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="text-gray-600">4.5</span>
                    </div>
                    <p class="text-gray-600 mb-4">"Superbe expérience! La maison à Lisbonne était idéalement située, et le propriétaire très accueillant."</p>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gray-300 rounded-full mr-3"></div>
                        <div>
                            <h4 class="font-semibold">John Smith</h4>
                            <p class="text-sm text-gray-500">Royaume-Uni</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-500 flex mr-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span class="text-gray-600">5.0</span>
                    </div>
                    <p class="text-gray-600 mb-4">"Plateforme très pratique! J'ai trouvé rapidement un logement à Barcelone à proximité du stade. Je recommande vivement!"</p>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gray-300 rounded-full mr-3"></div>
                        <div>
                            <h4 class="font-semibold">Carlos Mendes</h4>
                            <p class="text-sm text-gray-500">Brésil</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Appel à l'action -->
    <section class="py-16 bg-green-600 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-6">Prêt pour le Mondial 2030?</h2>
            <p class="text-xl mb-8">Inscrivez-vous maintenant et soyez le premier à recevoir des offres exclusives</p>
            <div class="max-w-md mx-auto flex flex-col md:flex-row">
                <input type="email" placeholder="Votre adresse email" class="w-full px-6 py-3 rounded-lg mb-4 md:mb-0 md:rounded-r-none md:flex-1 text-gray-700">
                <button class="w-full md:w-auto px-6 py-3 bg-blue-600 hover:bg-blue-700 rounded-lg md:rounded-l-none font-semibold transition">S'inscrire</button>
            </div>
        </div>
    </section>
    
   

    <script>
        // Script pour le menu mobile
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.querySelector('.md\\:hidden button');
            const mobileMenu = document.createElement('div');
            mobileMenu.className = 'mobile-menu fixed inset-0 bg-white z-50 transform translate-x-full transition-transform duration-300 ease-in-out';
            mobileMenu.innerHTML = `
                <div class="p-4 flex justify-between items-center border-b">
                    <span class="text-2xl font-bold text-green-600">TouriStay<span class="text-blue-600">2030</span></span>
                    <button class="close-menu text-gray-700 focus:outline-none">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <div class="p-4">
                    <ul class="space-y-4">
                        <li><a href="#" class="block py-2 text-gray-700 hover:text-green-600 transition">Accueil</a></li>
                        <li><a href="#" class="block py-2 text-gray-700 hover:text-green-600 transition">Destinations</a></li>
                        <li><a href="#" class="block py-2 text-gray-700 hover:text-green-600 transition">Logements</a></li>
                        <li><a href="#" class="block py-2 text-gray-700 hover:text-green-600 transition">Événements</a></li>
                        <li><a href="#" class="block py-2 text-gray-700 hover:text-green-600 transition">À propos</a></li>
                    </ul>
                    <div class="mt-6 space-y-4">
                        <a href="#" class="block w-full py-2 text-center rounded bg-white text-green-600 border border-green-600 hover:bg-green-600 hover:text-white transition">Se connecter</a>
                        <a href="#" class="block w-full py-2 text-center rounded bg-green-600 text-white hover:bg-green-700 transition">S'inscrire</a>
                    </div>
                </div>
            `;
            document.body.appendChild(mobileMenu);
            
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.remove('translate-x-full');
            });
            
            document.querySelector('.close-menu').addEventListener('click', function() {
                mobileMenu.classList.add('translate-x-full');
            });
        });
    </script>
</body>
</html>