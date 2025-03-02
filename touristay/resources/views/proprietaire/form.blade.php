<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Annonce - TouriStay</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="w-full max-w-2xl mx-auto p-8">
        <!-- Card Container -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-lg font-medium mb-6 text-center">Ajouter une Annonce</h2>
            
            <!-- Form -->
            <form action="/annonce/ajouter" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Informations de Base -->
                <div class="mb-6">
                   
                    
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Titre -->
                        <div class="col-span-1">
                            <label for="titre" class="block text-sm font-medium text-gray-700 mb-2">Titre de l'annonce</label>
                            <input type="text" name="titre" id="titre" placeholder="Titre de l'annonce" 
                                   class="w-full py-3 px-4 border border-gray-400 rounded-lg focus:outline-none focus:border-blue-500">
                        </div>
                        
                        <!-- Prix par Nuit -->
                        <div class="col-span-1">
                            <label for="prixparnuit" class="block text-sm font-medium text-gray-700 mb-2">Prix par nuit</label>
                            <input type="number" name="prixparnuit" id="prixparnuit" placeholder="Prix par nuit" 
                                   class="w-full py-3 px-4 border border-gray-400 rounded-lg focus:outline-none focus:border-blue-500">
                        </div>
                    </div>
                </div>

                <!-- Détails de l'Annonce -->
                <div class="mb-6">
                    
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Description -->
                        <div class="col-span-1">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea name="description" id="description" placeholder="Description détaillée" 
                                      class="w-full py-3 px-4 border border-gray-400 rounded-lg focus:outline-none focus:border-blue-500"></textarea>
                        </div>

                        <!-- Nombre de Chambres -->
                        <div class="col-span-1">
                            <label for="nbrchambre" class="block text-sm font-medium text-gray-700 mb-2">Nombre de chambres</label>
                            <input type="number" name="nbrchambre" id="nbrchambre" placeholder="Nombre de chambres" 
                                   class="w-full py-3 px-4 border border-gray-400 rounded-lg focus:outline-none focus:border-blue-500">
                        </div>

                        <!-- Nombre de Salles de Bain -->
                        <div class="col-span-1">
                            <label for="nbrsallesebain" class="block text-sm font-medium text-gray-700 mb-2">Nombre de salles de bain</label>
                            <input type="number" name="nbrsallesebain" id="nbrsallesebain" placeholder="Nombre de salles de bain" 
                                   class="w-full py-3 px-4 border border-gray-400 rounded-lg focus:outline-none focus:border-blue-500">
                        </div>
                    </div>
                </div>

                <!-- Localisation -->
                <div class="mb-6">
                    
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Adresse -->
                        <div class="col-span-1">
                            <label for="adress" class="block text-sm font-medium text-gray-700 mb-2">Adresse</label>
                            <input type="text" name="adress" id="adress" placeholder="Adresse de l'annonce" 
                                   class="w-full py-3 px-4 border border-gray-400 rounded-lg focus:outline-none focus:border-blue-500">
                        </div>

                        <!-- Ville -->
                        <div class="col-span-1">
                            <label for="ville" class="block text-sm font-medium text-gray-700 mb-2">Ville</label>
                            <input type="text" name="ville" id="ville" placeholder="Ville de l'annonce" 
                                   class="w-full py-3 px-4 border border-gray-400 rounded-lg focus:outline-none focus:border-blue-500">
                        </div>
                    </div>
                </div>

                <!-- Image et Disponibilité -->
                <div class="mb-6">
                    
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Image -->
                        <div class="col-span-1">
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                            <input type="texte" name="image" id="image"  placeholder="Image " 
                                   class="w-full py-3 px-4 border border-gray-400 rounded-lg focus:outline-none focus:border-blue-500">
                        </div>

                        <!-- Disponibilité -->
                        <div class="col-span-1">
                            <label for="disponibilite" class="block text-sm font-medium text-gray-700 mb-2">Disponibilité</label>
                            <input type="date" name="disponibilite" id="disponibilite" placeholder="Disponibilité" 
                                   class="w-full py-3 px-4 border border-gray-400 rounded-lg focus:outline-none focus:border-blue-500"
                                   min="<?php echo date('Y-m-d'); ?>" /> 
                        </div>
                    </div>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700">Équipements</label>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($equipement as $equip)
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="equipement[]" value="{{ $equip->id }}" class="form-checkbox text-blue-500">
                                <span class="ml-2">{{ $equip->nom }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                

                <!-- Champs supplémentaires (non visibles) -->
                <div class="hidden">
                    <input type="hidden" name="created_at" value="{{ now() }}">
                    <input type="hidden" name="updated_at" value="{{ now() }}">
                    <input type="hidden" name="id_proprietaire" value="{{ auth()->check() ? auth()->user()->id : '' }}">

                    
                </div>

                <!-- Submit Button -->
                <div class="mt-8">
                    <button type="submit" class="w-full bg-green-500 hover:bg-blue-600 text-white font-medium py-3 rounded-lg focus:outline-none">
                        Ajouter l'Annonce
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
