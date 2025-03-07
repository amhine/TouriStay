<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Reservation;
use App\Models\User;
use App\Models\paiement;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Affiche le tableau de bord admin avec les statistiques
     */
    public function index()
    {
        // Récupérer les données des annonces, réservations et transactions
        $annonces = Annonce::all();
        $reservations = Reservation::all();
        $users = User::all();
        
        // Calculer les statistiques mensuelles
        $annoncesMoisDernier = Annonce::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->count();
        $annoncesMoisActuel = Annonce::whereMonth('created_at', '=', Carbon::now()->month)->count();
        
        $reservationsMoisDernier = Reservation::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->count();
        $reservationsMoisActuel = Reservation::whereMonth('created_at', '=', Carbon::now()->month)->count();
        
        // Calculer le taux de conversion (réservations/vues des annonces)
        // Cette partie dépend de la façon dont vous suivez les vues
        // Ici c'est juste un exemple statique
        $tauxConversion = 5.7;
        
        // Calculer le total des revenus
        $paiements = paiement::where('status', 'payé')->get();
        $totalRevenu = $paiements->sum('amount');
        
        // Calculer les variations en pourcentage
        $variationAnnonces = $annoncesMoisDernier > 0 ? 
            round((($annoncesMoisActuel - $annoncesMoisDernier) / $annoncesMoisDernier) * 100, 1) : 0;
        
        $variationReservations = $reservationsMoisDernier > 0 ? 
            round((($reservationsMoisActuel - $reservationsMoisDernier) / $reservationsMoisDernier) * 100, 1) : 0;
        
        // Passer ces données à la vue
        return view('dashbordadmin', [
            'annonces' => $annonces,
            'reservations' => $reservations,
            'users' => $users,
            'totalRevenu' => $totalRevenu,
            'variationAnnonces' => $variationAnnonces,
            'variationReservations' => $variationReservations,
            'tauxConversion' => $tauxConversion
        ]);
    }
    
    /**
     * Affiche la liste des annonces
     */
    public function annonces()
    {
        $annonces = Annonce::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.annonces', compact('annonces'));
    }
    
    /**
     * Affiche la liste des réservations
     */
    public function reservations()
    {
        $reservations = Reservation::with('annonce', 'user')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.reservations', compact('reservations'));
    }
    
    /**
     * Affiche la liste des utilisateurs
     */
    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.users', compact('users'));
    }
    
    /**
     * Affiche la liste des paiements
     */
    public function paiements()
    {
        $paiements = paiement::with('reservation')->orderBy('datepaiement', 'desc')->paginate(10);
        return view('admin.paiements', compact('paiements'));
    }
/**
 * Supprime une réservation
 */
public function destroyReservation($id)
{
    $reservation = Reservation::findOrFail($id);
    $reservation->delete();
    
    return redirect()->route('admin.reservations')
                   ->with('success', 'Réservation annulée avec succès');
}
/**
 * Affiche les détails d'une réservation
 */
public function showReservation($id)
{
    $reservation = Reservation::with(['annonce', 'user', 'paiements'])->findOrFail($id);
    return view('admin.reservation-details', compact('reservation'));
}
}