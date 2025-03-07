<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Annonce;
use App\Models\Reservation;
class PaiementController extends Controller
{
    
            public function paiement($reservationId)
        {
            $reservation = Reservation::with('annonce')->findOrFail($reservationId);

            $nombreDeNuits = \Carbon\Carbon::parse($reservation->datedebut)
                                ->diffInDays(\Carbon\Carbon::parse($reservation->datefin));

            $prixParNuit = $reservation->annonce->prixparnuit;
            $prixTotal = $nombreDeNuits * $prixParNuit;

            return view('touriste.paiement', compact('reservation', 'nombreDeNuits', 'prixTotal'));
        }


        public function Confirmation($reservationId)
        {
            return view('touriste.confirmation', compact('reservationId'));
        }


        public function processPaiement(Request $request)
        {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);
        return redirect()->route('annonce')->with('success', 'Paiement confirmé avec succès !');
        }


    

}
