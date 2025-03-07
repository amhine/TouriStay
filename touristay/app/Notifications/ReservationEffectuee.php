<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\Reservation;

class ReservationEffectuee extends Notification
{
    use Queueable;

    public $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nouvelle réservation !')
            ->greeting('Bonjour ' . $notifiable->name . ',')
            ->line('Un touriste vient de réserver votre hébergement : ' . $this->reservation->annonce->titre)
            ->line('Date de début : ' . $this->reservation->datedebut)
            ->line('Date de fin : ' . $this->reservation->datefin)
            ->action('Voir la réservation', url('/reservations/' . $this->reservation->id))
            ->line('Merci d’utiliser notre plateforme !');
    }

    public function toArray($notifiable)
    {
        return [
            'annonce' => $this->reservation->annonce->titre,
            'datedebut' => $this->reservation->datedebut,
            'datefin' => $this->reservation->datefin,
            'reservation_id' => $this->reservation->id,
        ];
    }
}
