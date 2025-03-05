<?php



namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Equipement;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnonceController extends Controller
{
    /**
     * Recherche d'annonces avec filtres (ville et disponibilité)
     */
    public function search(Request $request)
    {
        $annoncesQuery = Annonce::query();

        if ($request->filled('ville')) {
            $annoncesQuery->where('ville', 'like', '%' . $request->ville . '%');
        }

        if ($request->filled('disponibilite')) {
            $annoncesQuery->where('disponibilite', '>=', $request->disponibilite);
        }
        if ($request->filled('date_debut') && $request->filled('date_fin')) {
            $dateDebut = $request->date_debut;
            $dateFin = $request->date_fin;
    
            
            // $annoncesQuery->whereDoesntHave('reservations', function($query) use ($dateDebut, $dateFin) {
            //     $query->where(function($subQuery) use ($dateDebut, $dateFin) {
            //         $subQuery->whereBetween('datedebut', [$dateDebut, $dateFin])
            //                  ->orWhereBetween('datefin', [$dateDebut, $dateFin])
            //                  ->orWhere(function($subQuery2) use ($dateDebut, $dateFin) {
            //                      $subQuery2->where('datedebut', '<=', $dateDebut)
            //                                ->where('datefin', '>=', $dateFin);
            //                  });
            //     });
            // });
        }
        $annonces = $annoncesQuery->paginate(9);
        $equipement= Equipement::all();

        return view('touriste.annonceview', compact('annonces', 'equipement'));
    }

    /**
     * Affiche les annonces du propriétaire connecté
     */
    
    public function index()
    {
        $userId = Auth::id(); 
        $annonces = Annonce::where('id_proprietaire', $userId)->with('equipement')->get();
    
        return view('proprietaire.annonceview', compact('annonces'));
    }


    /**
     * Affiche le formulaire de création d'une annonce
     */
    public function afficherForm()
    {
        $equipement = Equipement::all(); 
        
        return view('proprietaire.form', compact('equipement'));
    }

    /**
     * Enregistre une nouvelle annonce
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour ajouter une annonce.');
        }

        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'prixparnuit' => 'required|numeric|min:0',
            'nbrchambre' => 'required|integer|min:0',
            'nbrsallesebain' => 'required|integer|min:0',
            'adress' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'image' => 'required|string',
            'disponibilite' => 'required|date',
            'equipement' => 'array', 
        ]);

        $userId = Auth::id();
        $annonce = Annonce::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'prixparnuit' => $request->prixparnuit,
            'nbrchambre' => $request->nbrchambre,
            'nbrsallesebain' => $request->nbrsallesebain,
            'adress' => $request->adress,
            'ville' => $request->ville,
            'image' => $request->image,
            'disponibilite' => $request->disponibilite,
            'id_proprietaire' => $userId,
        ]);

        if ($request->has('equipement')) {
            $annonce->equipement()->attach($request->equipement);
        }

        return redirect()->route('annonce.proprietaire')->with('success', 'Annonce ajoutée avec succès.');
    }

    /**
     * Affiche le formulaire de modification d'une annonce
     */
    public function edit($id)
    {
        $userId = Auth::id();
        
        $annonce = Annonce::where('id_proprietaire', $userId)->where('id', $id)->with('equipement') ->first(); 
        
        if (!$annonce) {
            return redirect()->route('annonce.proprietaire')->with('error', 'Annonce introuvable.');
        }
    
        $equipement = Equipement::all();
    
        $equipementsSelectionnes = $annonce->equipement ? $annonce->equipement->pluck('id')->toArray() : [];
    
        return view('proprietaire.editannonce', compact('annonce', 'equipement', 'equipementsSelectionnes'));
    }
    
    
    

    /**
     * Met à jour une annonce existante
     */
    public function update(Request $request, $id)
    {
        $annonce = Annonce::findOrFail($id);

        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'prixparnuit' => 'required|numeric|min:0',
            'nbrchambre' => 'required|integer|min:0',
            'nbrsallesebain' => 'required|integer|min:0',
            'adress' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'disponibilite' => 'required|date',
            'equipement' => 'array',
        ]);

        $annonce->update([
            'titre' => $request->titre,
            'prixparnuit' => $request->prixparnuit,
            'description' => $request->description,
            'nbrchambre' => $request->nbrchambre,
            'nbrsallesebain' => $request->nbrsallesebain,
            'adress' => $request->adress,
            'ville' => $request->ville,
            'disponibilite' => $request->disponibilite,
        ]);

        $annonce->equipement()->sync($request->equipement ?? []);

        return redirect()->route('annonce.proprietaire')->with('success', 'Annonce mise à jour avec succès.');
    }

    /**
     * Supprime une annonce
     */
   public function destroy($id)
{
    $annonce = Annonce::where('id', $id)->first();

    $annonce->delete();

    return redirect()->route('annonce.proprietaire');
}





public function toggleFavorite(Request $request, $id)
{
    $annonce = Annonce::findOrFail($id);
    $user = Auth::user();

    if ($user->favoris()->where('id_annonce', $id)->exists()) {
        $user->favoris()->detach($id);
        $message = 'Annonce retirée des favoris.';
    } else {
        $user->favoris()->attach($id);
        $message = 'Annonce ajoutée aux favoris.';
    }

    return redirect()->route('favoris.index')->with('success', $message);
}

    public function favoris()
    {
        $user = Auth::user(); 
    
        if (!$user) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour voir vos favoris.');
        }
    
        $annonces = $user->favoris()->paginate(9); 
    
        return view('touriste.favoris', compact('annonces'));
    }
    

    //  public function search(Request $request)
    // {
    //     $annoncesQuery = Annonce::query();
    
       
    //     if ($request->filled('ville')) {
    //         $annoncesQuery->where('ville', 'like', '%' . $request->ville . '%');
    //     }
    //     if ($request->filled('disponibilite')) {
    //                 $annoncesQuery->where('disponibilite', '>=', $request->disponibilite);
    //             }
    
    //     if ($request->filled('date_debut') && $request->filled('date_fin')) {
    //         $dateDebut = $request->date_debut;
    //         $dateFin = $request->date_fin;
    
            
    //         $annoncesQuery->whereDoesntHave('reservations', function($query) use ($dateDebut, $dateFin) {
    //             $query->where(function($subQuery) use ($dateDebut, $dateFin) {
    //                 $subQuery->whereBetween('datedebut', [$dateDebut, $dateFin])
    //                          ->orWhereBetween('datefin', [$dateDebut, $dateFin])
    //                          ->orWhere(function($subQuery2) use ($dateDebut, $dateFin) {
    //                              $subQuery2->where('datedebut', '<=', $dateDebut)
    //                                        ->where('datefin', '>=', $dateFin);
    //                          });
    //             });
    //         });
    //     }
    
    //     $annonces = $annoncesQuery->paginate(9);
    //     $equipement = Equipement::all();
    
    //     return view('touriste.annonceview', compact('annonces', 'equipement'));
    // }
    


}
