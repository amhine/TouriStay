<!-- resources/views/dashbordadmin.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tableau de bord d'administration</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
</head>
<body class="bg-gray-50 text-gray-800">
  <div class="flex h-screen">
    <!-- Sidebar -->
    <div class="w-64 bg-gray-900 text-white fixed h-full">
      <div class="p-5 border-b border-gray-800">
        <h2 class="text-xl font-bold">Admin Panel</h2>
      </div>
      <div class="pt-3">
        <div class="flex items-center px-5 py-3 bg-gray-800 border-l-4 border-blue-500">
          <span class="mr-3">📊</span>
          <span>Tableau de bord</span>
        </div>
        <div class="flex items-center px-5 py-3 hover:bg-gray-800 cursor-pointer transition-colors">
          <span class="mr-3">📑</span>
          <span>Annonces</span>
        </div>
        <div class="flex items-center px-5 py-3 hover:bg-gray-800 cursor-pointer transition-colors">
          <span class="mr-3">💰</span>
          <span>Paiements</span>
        </div>
        <div class="flex items-center px-5 py-3 hover:bg-gray-800 cursor-pointer transition-colors">
          <span class="mr-3">📅</span>
          <span>Réservations</span>
        </div>
        <div class="flex items-center px-5 py-3 hover:bg-gray-800 cursor-pointer transition-colors">
          <span class="mr-3">👥</span>
          <span>Utilisateurs</span>
        </div>
        <div class="flex items-center px-5 py-3 hover:bg-gray-800 cursor-pointer transition-colors">
          <span class="mr-3">⚙️</span>
          <span>Paramètres</span>
        </div>
      </div>
    </div>
    
    <!-- Main Content -->
    <div class="ml-64 p-6 w-full">
      <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold">Tableau de bord</h1>
        <div class="text-gray-600">{{ date('l, j F Y') }}</div>
      </div>
      
      <!-- Stats Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-5">
          <div class="text-gray-500 text-sm">Annonces actives</div>
          <div class="text-3xl font-bold my-2">{{ $annonces->where('disponibilite', true)->count() }}</div>
          <div class="text-green-500 text-sm">+15% vs mois dernier</div>
        </div>
        <div class="bg-white rounded-lg shadow p-5">
          <div class="text-gray-500 text-sm">Réservations</div>
          <div class="text-3xl font-bold my-2">{{ $reservations->count() }}</div>
          <div class="text-green-500 text-sm">+8% vs mois dernier</div>
        </div>
        <div class="bg-white rounded-lg shadow p-5">
          <div class="text-gray-500 text-sm">Revenus (€)</div>
          <div class="text-3xl font-bold my-2">
            @php
              $totalRevenu = 0;
              foreach($reservations as $reservation) {
                if(isset($reservation->prix_total)) {
                  $totalRevenu += $reservation->prix_total;
                }
              }
              echo number_format($totalRevenu, 0, ',', ' ');
            @endphp
          </div>
          <div class="text-green-500 text-sm">+12% vs mois dernier</div>
        </div>
        <div class="bg-white rounded-lg shadow p-5">
          <div class="text-gray-500 text-sm">Taux de conversion</div>
          <div class="text-3xl font-bold my-2">5.7%</div>
          <div class="text-green-500 text-sm">+0.5% vs mois dernier</div>
        </div>
      </div>
      
      <!-- Annonces Table -->
      <div class="bg-white rounded-lg shadow p-5 mb-8">
        <div class="flex justify-between items-center mb-5">
          <div class="font-semibold">Dernières annonces</div>
          <div class="flex space-x-2">
            <input type="text" placeholder="Rechercher..." class="border rounded-md p-2 text-sm">
            <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">Ajouter</button>
          </div>
        </div>
        <div class="overflow-x-auto">
          <table class="min-w-full">
            <thead>
              <tr class="bg-gray-50">
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date de création</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach($annonces->sortByDesc('created_at')->take(10) as $annonce)
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">#{{ $annonce->id }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $annonce->titre }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ date('d/m/Y', strtotime($annonce->created_at)) }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  @if($annonce->disponibilite)
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                  @else
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Désactivée</span>
                  @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <div class="flex space-x-2">
                    <a href="{{ route('annonce.edit', $annonce->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-xs transition-colors">Modifier</a>
                    <form action="{{ route('annonce.destroy', $annonce->id) }}" method="POST" class="inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-xs transition-colors" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce?')">Supprimer</button>
                    </form>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="flex justify-end mt-4">
          <nav class="flex space-x-2" aria-label="Pagination">
            <a href="#" class="bg-blue-500 text-white h-8 w-8 flex items-center justify-center rounded-md">1</a>
            <a href="#" class="text-gray-500 hover:bg-gray-100 h-8 w-8 flex items-center justify-center rounded-md">2</a>
            <a href="#" class="text-gray-500 hover:bg-gray-100 h-8 w-8 flex items-center justify-center rounded-md">3</a>
            <a href="#" class="text-gray-500 hover:bg-gray-100 h-8 w-8 flex items-center justify-center rounded-md">4</a>
            <a href="#" class="text-gray-500 hover:bg-gray-100 h-8 w-8 flex items-center justify-center rounded-md">></a>
          </nav>
        </div>
      </div>
      
      <!-- Réservations Table -->
      <div class="bg-white rounded-lg shadow p-5 mb-8">
        <div class="flex justify-between items-center mb-5">
          <div class="font-semibold">Dernières réservations</div>
          <div class="flex space-x-2">
            <input type="text" placeholder="Rechercher..." class="border rounded-md p-2 text-sm">
          </div>
        </div>
        <div class="overflow-x-auto">
          <table class="min-w-full">
            <thead>
              <tr class="bg-gray-50">
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Annonce</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date début</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date fin</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach($reservations->sortByDesc('created_at')->take(10) as $reservation)
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">#{{ $reservation->id }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  @if(isset($reservation->annonce))
                    {{ $reservation->annonce->titre }}
                  @else
                    Annonce non disponible
                  @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap">{{ date('d/m/Y', strtotime($reservation->dateDebut)) }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ date('d/m/Y', strtotime($reservation->dateFin)) }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  @if($reservation->status === 'payé')
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Payée</span>
                  @elseif($reservation->status === 'en attente')
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">En attente</span>
                  @elseif($reservation->status === 'annulée')
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Annulée</span>
                  @else
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">{{ $reservation->status }}</span>
                  @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <div class="flex space-x-2">
                    <a href="{{ route('reservation.show', $reservation->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-xs transition-colors">Détails</a>
                    <form action="{{ route('reservation.destroy', $reservation->id) }}" method="POST" class="inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-xs transition-colors" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation?')">Annuler</button>
                    </form>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="flex justify-end mt-4">
          <nav class="flex space-x-2" aria-label="Pagination">
            <a href="#" class="bg-blue-500 text-white h-8 w-8 flex items-center justify-center rounded-md">1</a>
            <a href="#" class="text-gray-500 hover:bg-gray-100 h-8 w-8 flex items-center justify-center rounded-md">2</a>
            <a href="#" class="text-gray-500 hover:bg-gray-100 h-8 w-8 flex items-center justify-center rounded-md">3</a>
            <a href="#" class="text-gray-500 hover:bg-gray-100 h-8 w-8 flex items-center justify-center rounded-md">4</a>
            <a href="#" class="text-gray-500 hover:bg-gray-100 h-8 w-8 flex items-center justify-center rounded-md">></a>
          </nav>
        </div>
      </div>
      
    </div>
  </div>
</body>
</html>