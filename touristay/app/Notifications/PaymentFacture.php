<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\paiement;

class PaymentFacture extends Notification
{
    protected $payment;

    public function __construct(paiement $payment)
    {
        $this->payment = $payment;
    }

    public function via($notifiable)
    {
        return ['mail']; 
    }

   
    public function toMail($notifiable) {
        $amount = number_format($this->payment->amount, 2);
        $date = $this->payment->datepaiement->format('d/m/Y à H:i');
        
        $displayId = 'PAY-' . str_pad($this->payment->id, 8, '0', STR_PAD_LEFT);
        
        $data = [
            'notifiable' => $notifiable, 
            'displayId' => $displayId,
            'date' => $date, 
            'amount' => $amount, 
            'status' => ucfirst($this->payment->status), 
            'paymentUrl' => url('/payments/' . $this->payment->id), 
        ];
    
        return (new MailMessage)
            ->subject('Confirmation de votre paiement #' . $displayId)
            ->view('touriste.email', $data);
    }
}

