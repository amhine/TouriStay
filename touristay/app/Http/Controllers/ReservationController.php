<?php
namespace App\Http\Controllers;
use App\Models\Reservation;
use App\Models\Annonce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // public function show($id){
    //             $annonce = Annonce::where('id', $id)->first();
    //             return view('touriste.showreservation', compact('annonce'));
    //         }
          
     public function create(Annonce $annonce)
    {
        $reservations = Reservation::where('annonce_id', $annonce->id)->get();
        $dates_indisponibles = [];
        foreach ($reservations as $reservation) {
            $current = new \DateTime($reservation->datedebut);
            $end = new \DateTime($reservation->datefin);
            while ($current <= $end) {
                $dates_indisponibles[] = $current->format('Y-m-d');
                $current->modify('+1 day');
            }
        }
        $dates_indisponibles = array_unique($dates_indisponibles);
        
        
        return view('touriste.showreservation', compact('annonce', 'dates_indisponibles'));
    }

    public function store(Request $request, Annonce $annonce)
    {
                    $request->validate([
                        'date_debut' => ['required', 'date', 'after:'.$annonce->disponibilite],
                        'date_fin'   => ['required', 'date', 'after:date_debut'],
                    ]);
                
                    $existingReservation = Reservation::where('annonce_id', $annonce->id)
                        ->where(function($query) use ($request) {
                            $query->whereBetween('datedebut', [$request->date_debut, $request->date_fin])
                                  ->orWhereBetween('datefin', [$request->date_debut, $request->date_fin])
                                  ->orWhere(function($subQuery) use ($request) {
                                      $subQuery->where('datedebut', '<=', $request->date_debut)
                                               ->where('datefin', '>=', $request->date_fin);
                                  });
                        })
                        ->exists();
                
                    if ($existingReservation) {
                        return redirect()->back()->with('error', 'Les dates que vous avez sélectionnées sont déjà réservées.');
                    }
                
                    $reservation = Reservation::create([
                        'touriste_id' => Auth::id(),
                        'annonce_id'  => $annonce->id,
                        'datedebut'   => $request->date_debut,
                        'datefin'     => $request->date_fin,
                        'status'      => 'en attente',
                    ]);
                
                    return redirect()->route('paiement', ['reservationId' => $reservation->id])->with('success', 'Réservation effectuée avec succès!');

                }


            }
            