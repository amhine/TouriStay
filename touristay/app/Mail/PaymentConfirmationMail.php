<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->subject('Confirmation de paiement - Votre réservation Touristay')
                    ->view('emails.payment_confirmation')
                    ->with([
                        'reservation' => $this->reservation,
                        'proprietaire' => $this->reservation->annonce->proprietaire
                    ]);
    }
}
