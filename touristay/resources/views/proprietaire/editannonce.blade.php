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
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Modifier l'annonce</h2>

    <form action="{{ route('annonce.update', $annonce->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Titre -->
        <div class="mb-4">
            <label for="titre" class="block text-sm font-medium text-gray-700">Titre</label>
            <input type="text" name="titre" id="titre" value="{{ old('titre', $annonce->titre) }}" 
                   class="w-full border border-gray-300 p-3 rounded-lg focus:ring focus:ring-blue-200">
        </div>

        <!-- Prix -->
        <div class="mb-4">
            <label for="prixparnuit" class="block text-sm font-medium text-gray-700">Prix par nuit (DH)</label>
            <input type="number" name="prixparnuit" id="prixparnuit" value="{{ old('prixparnuit', $annonce->prixparnuit) }}" 
                   class="w-full border border-gray-300 p-3 rounded-lg focus:ring focus:ring-blue-200">
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4" 
                      class="w-full border border-gray-300 p-3 rounded-lg focus:ring focus:ring-blue-200">{{ old('description', $annonce->description) }}</textarea>
        </div>

        <!-- Adresse -->
        <div class="mb-4">
            <label for="adress" class="block text-sm font-medium text-gray-700">Adresse</label>
            <input type="text" name="adress" id="adress" value="{{ old('adress', $annonce->adress) }}" 
                   class="w-full border border-gray-300 p-3 rounded-lg focus:ring focus:ring-blue-200">
        </div>

        <!-- Ville -->
        <div class="mb-4">
            <label for="ville" class="block text-sm font-medium text-gray-700">Ville</label>
            <input type="text" name="ville" id="ville" value="{{ old('ville', $annonce->ville) }}" 
                   class="w-full border border-gray-300 p-3 rounded-lg focus:ring focus:ring-blue-200">
        </div>

        <!-- Nombre de Chambres et Salles de Bain -->
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label for="nbrchambre" class="block text-sm font-medium text-gray-700">Chambres</label>
                <input type="number" name="nbrchambre" id="nbrchambre" value="{{ old('nbrchambre', $annonce->nbrchambre) }}" 
                       class="w-full border border-gray-300 p-3 rounded-lg focus:ring focus:ring-blue-200">
            </div>
            <div>
                <label for="nbrsallesebain" class="block text-sm font-medium text-gray-700">Salles de bain</label>
                <input type="number" name="nbrsallesebain" id="nbrsallesebain" value="{{ old('nbrsallesebain', $annonce->nbrsallesebain) }}" 
                       class="w-full border border-gray-300 p-3 rounded-lg focus:ring focus:ring-blue-200">
            </div>
        </div>

        <!-- Disponibilité -->
        <div class="mb-4">
            <label for="disponibilite" class="block text-sm font-medium text-gray-700">Disponibilité</label>
            <input type="date" name="disponibilite" id="disponibilite" 
                   value="{{ old('disponibilite', $annonce->disponibilite) }}" 
                   class="w-full border border-gray-300 p-3 rounded-lg focus:ring focus:ring-blue-200">
        </div>

        <!-- Équipements -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Équipements</label>
            <div class="grid grid-cols-2 gap-4">
                @foreach($equipement as $equip)
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="equipement[]" value="{{ $equip->id }}" 
                               class="form-checkbox text-blue-500"
                               {{ in_array($equip->id, $equipementsSelectionnes) ? 'checked' : '' }}>
                        <span class="ml-2">{{ $equip->nom }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- Bouton de soumission -->
        <div class="mt-6 flex justify-between">
            <a href="{{ route('annonce.proprietaire') }}" class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500">
                Annuler
            </a>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                Modifier
            </button>
        </div>
    </form>
</div>
</body>
</html>
