<?php
namespace App\Mail;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationProprietaireMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    /**
     * Create a new message instance.
     *
     * @param Reservation $reservation
     * @return void
     */
    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Make sure we have the correct property names based on your model
        // Adjust these field names if they're different in your database
        $dateDebut = $this->reservation->dateDebut ?? $this->reservation->date_debut;
        $dateFin = $this->reservation->dateFin ?? $this->reservation->date_fin;
        $prixTotal = $this->reservation->prix_total ?? $this->reservation->amount;
        
        // Calculate the price if it's not set
        if (!$prixTotal && $this->reservation->annonce) {
            $debut = new \DateTime($dateDebut);
            $fin = new \DateTime($dateFin);
            $nuits = $fin->diff($debut)->days;
            $nuits = max(1, $nuits);
            $prixTotal = $this->reservation->annonce->prixparnuit * $nuits;
        }
        
        return $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->subject('Nouvelle réservation sur votre hébergement - Touristay')
                    ->view('emails.reservation_proprietaire')
                    ->with([
                        'reservation' => $this->reservation,
                        'nomClient' => $this->reservation->user->name,
                        'emailClient' => $this->reservation->user->email,
                        'titreAnnonce' => $this->reservation->annonce->titre,
                        'dateDebut' => $dateDebut,
                        'dateFin' => $dateFin,
                        'prixTotal' => $prixTotal,
                        'annonce' => $this->reservation->annonce,
                        'proprietaire' => $this->reservation->annonce->user,
                    ]);
    }
}