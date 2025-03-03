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
        <div class="text-gray-600">Lundi, 3 Mars 2025</div>
      </div>
      
      <!-- Stats Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-5">
          <div class="text-gray-500 text-sm">Annonces actives</div>
          <div class="text-3xl font-bold my-2">245</div>
          <div class="text-green-500 text-sm">+15% vs mois dernier</div>
        </div>
        <div class="bg-white rounded-lg shadow p-5">
          <div class="text-gray-500 text-sm">Réservations</div>
          <div class="text-3xl font-bold my-2">189</div>
          <div class="text-green-500 text-sm">+8% vs mois dernier</div>
        </div>
        <div class="bg-white rounded-lg shadow p-5">
          <div class="text-gray-500 text-sm">Revenus (€)</div>
          <div class="text-3xl font-bold my-2">24 580</div>
          <div class="text-green-500 text-sm">+12% vs mois dernier</div>
        </div>
        <div class="bg-white rounded-lg shadow p-5">
          <div class="text-gray-500 text-sm">Taux de conversion</div>
          <div class="text-3xl font-bold my-2">5.7%</div>
          <div class="text-green-500 text-sm">+0.5% vs mois dernier</div>
        </div>
      </div>
      
      <!-- Charts -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-5 lg:col-span-2">
          <div class="flex justify-between items-center mb-5">
            <div class="font-semibold">Revenus mensuels</div>
            <select class="border rounded-md p-1 text-sm">
              <option>Cette année</option>
              <option>Année dernière</option>
              <option>Derniers 6 mois</option>
            </select>
          </div>
          <div class="bg-gray-100 h-64 rounded flex items-center justify-center">
            [Graphique de revenus mensuels]
          </div>
        </div>
        <div class="bg-white rounded-lg shadow p-5">
          <div class="font-semibold mb-5">Répartition des annonces</div>
          <div class="bg-gray-100 h-64 rounded flex items-center justify-center">
            [Graphique circulaire]
          </div>
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
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">#12345</td>
                <td class="px-6 py-4 whitespace-nowrap">Appartement T3 Centre-Ville</td>
                <td class="px-6 py-4 whitespace-nowrap">01/03/2025</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <div class="flex space-x-2">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-xs transition-colors">Modifier</button>
                    <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-xs transition-colors">Supprimer</button>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">#12344</td>
                <td class="px-6 py-4 whitespace-nowrap">Studio Meublé Quartier Étudiant</td>
                <td class="px-6 py-4 whitespace-nowrap">28/02/2025</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <div class="flex space-x-2">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-xs transition-colors">Modifier</button>
                    <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-xs transition-colors">Supprimer</button>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">#12343</td>
                <td class="px-6 py-4 whitespace-nowrap">Maison 4 Chambres avec Jardin</td>
                <td class="px-6 py-4 whitespace-nowrap">25/02/2025</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">En attente</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <div class="flex space-x-2">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-xs transition-colors">Modifier</button>
                    <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-xs transition-colors">Supprimer</button>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">#12342</td>
                <td class="px-6 py-4 whitespace-nowrap">Villa de Luxe Vue Mer</td>
                <td class="px-6 py-4 whitespace-nowrap">22/02/2025</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Désactivée</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <div class="flex space-x-2">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-xs transition-colors">Modifier</button>
                    <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-xs transition-colors">Supprimer</button>
                  </div>
                </td>
              </tr>
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
      
      <!-- Transactions Table -->
      <div class="bg-white rounded-lg shadow p-5">
        <div class="font-semibold mb-5">Dernières transactions</div>
        <div class="overflow-x-auto">
          <table class="min-w-full">
            <thead>
              <tr class="bg-gray-50">
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">#85214</td>
                <td class="px-6 py-4 whitespace-nowrap">Jean Dupont</td>
                <td class="px-6 py-4 whitespace-nowrap">03/03/2025</td>
                <td class="px-6 py-4 whitespace-nowrap">€850.00</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Payé</span>
                </td>
              </tr>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">#85213</td>
                <td class="px-6 py-4 whitespace-nowrap">Marie Martin</td>
                <td class="px-6 py-4 whitespace-nowrap">02/03/2025</td>
                <td class="px-6 py-4 whitespace-nowrap">€1,250.00</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">En attente</span>
                </td>
              </tr>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">#85212</td>
                <td class="px-6 py-4 whitespace-nowrap">Pierre Leclerc</td>
                <td class="px-6 py-4 whitespace-nowrap">01/03/2025</td>
                <td class="px-6 py-4 whitespace-nowrap">€950.00</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Payé</span>
                </td>
              </tr>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">#85211</td>
                <td class="px-6 py-4 whitespace-nowrap">Sophie Bernard</td>
                <td class="px-6 py-4 whitespace-nowrap">28/02/2025</td>
                <td class="px-6 py-4 whitespace-nowrap">€750.00</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Échoué</span>
                </td>
              </tr>
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