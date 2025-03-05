
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Réservation - TouriStay</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Intégration de Flatpickr -->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-md">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Réserver l'annonce #{{ $annonce->id }}</h2>
    
    <!-- Détails de l'annonce -->
    <div class="card bg-white rounded-xl overflow-hidden shadow-lg">
      <div class="relative">
        <img src="{{ $annonce->image }}" alt="Appartement avec vue" class="w-full object-cover h-48">
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
        <p class="text-gray-600 mb-4">
          {{ $annonce->description }}
        </p>
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
            @foreach($annonce->equipement as $equip)
            <div class="amenity-icon text-center">
              <i class="fas fa-{{ $equip->icon }} text-purple-600 text-xl mb-1"></i>
              <p class="text-xs">{{ $equip->nom }}</p>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div> 
      
    <!-- Formulaire de réservation -->
    <form id="reservationForm" action="{{ route('reservation.store', $annonce->id) }}" method="POST" class="space-y-4 mt-4">
      @csrf
      <div>
        <label for="date_debut" class="block text-gray-700 mb-2">Date de début:</label>
        <input type="text" name="date_debut" id="date_debut" required 
               class="px-4 py-2 border rounded-lg w-full focus:ring-2 focus:ring-purple-500"
               placeholder="Sélectionnez une date">
      </div>
  
      <div>
        <label for="date_fin" class="block text-gray-700 mb-2">Date de fin:</label>
        <input type="text" name="date_fin" id="date_fin" required 
               class="px-4 py-2 border rounded-lg w-full focus:ring-2 focus:ring-purple-500"
               placeholder="Sélectionnez une date">
      </div>
  
      <button type="submit" class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition-colors">
        Réserver
      </button>
    </form>
  
    <a href="{{ route('annonce') }}" class="block text-center text-gray-600 mt-4 hover:underline">Retour aux annonces</a>
  </div>
  
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      flatpickr("#date_debut", {
        minDate: "{{ $annonce->disponibilite ?? 'today' }}",
        maxDate: "{{ $annonce->date_max ?? '' }}",
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d F Y",
        locale: {
          firstDayOfWeek: 1 
        },
        disable: [
          @if(isset($dates_indisponibles))
            @foreach($dates_indisponibles as $date)
              "{{ $date }}",
            @endforeach
          @endif
        ],
        onChange: function(selectedDates, dateStr) {
          // Met à jour la date minimale de l'input "date_fin"
          document.querySelector('#date_fin')._flatpickr.set('minDate', dateStr);
        }
      });
      
      flatpickr("#date_fin", {
        minDate: "{{ $annonce->disponibilite ?? 'today' }}",
        maxDate: "{{ $annonce->date_max ?? '' }}",
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d F Y",
        locale: {
          firstDayOfWeek: 1 
        },
        disable: [
          @if(isset($dates_indisponibles))
            @foreach($dates_indisponibles as $date)
              "{{ $date }}",
            @endforeach
          @endif
        ]
      });
    });
  </script>
</body>
</html>
