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

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function build()
    {
        return $this->subject('Nouvelle réservation sur votre hébergement')
            ->view('emails.reservation_proprietaire')
            ->with([
                'nomClient' => $this->reservation->user->name,
                'titreAnnonce' => $this->reservation->annonce->titre,
                'dateDebut' => $this->reservation->date_debut,
                'dateFin' => $this->reservation->date_fin,
                'prixTotal' => $this->reservation->prix_total,
            ]);
    }
}
