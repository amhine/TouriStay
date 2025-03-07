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
        return ['mail']; // Envoie par email
    }

    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('Your payment has been successfully processed.')
    //                 ->line('Amount: $' . $this->payment->amount)
    //                 ->action('View Payment', url('/payments/' . $this->payment->payment_id))
    //                 ->line('Thank you for using our application!');
    // }

    // public function toMail($notifiable) {
    //     $amount = number_format($this->payment->amount, 2);
    //     $date = $this->payment->datepaiement->format('d/m/Y à H:i');
        
    //     // Générer un ID lisible à partir de l'ID de paiement de la base de données
    //     $displayId = 'PAY-' . str_pad($this->payment->id, 8, '0', STR_PAD_LEFT);
        
    //     return (new MailMessage)
    //         ->subject('Confirmation de votre paiement #' . $displayId)
    //         ->greeting('Bonjour ' . $notifiable->name . ',')
    //         ->line('Nous vous remercions pour votre confiance. Votre paiement a été traité avec succès.')
    //         ->line('Voici les détails de votre transaction :')
    //         ->line('<div style="background-color: #f7f9fc; border-radius: 8px; padding: 20px; margin: 20px 0; border: 1px solid #e0e7ff;">
    //                 <div style="font-size: 20px; font-weight: bold; color: #2d3748; margin-bottom: 16px;">Détails de la transaction</div>
    //                 <div style="margin-bottom: 12px;">
    //                     <span style="color: #4a5568; font-size: 14px;">Numéro de transaction :</span>
    //                     <span style="color: #2d3748; font-size: 14px; font-weight: bold; float: right;">' . $displayId . '</span>
    //                 </div>
    //                 <div style="margin-bottom: 12px;">
    //                     <span style="color: #4a5568; font-size: 14px;">Date :</span>
    //                     <span style="color: #2d3748; font-size: 14px; float: right;">' . $date . '</span>
    //                 </div>
    //                 <div style="margin-bottom: 12px;">
    //                     <span style="color: #4a5568; font-size: 14px;">Montant :</span>
    //                     <span style="color: #38b2ac; font-size: 16px; font-weight: bold; float: right;">$' . $amount . ' USD</span>
    //                 </div>
    //                 <div style="margin-bottom: 12px;">
    //                     <span style="color: #4a5568; font-size: 14px;">Statut :</span>
    //                     <span style="color: #2d3748; font-size: 14px; float: right;">
    //                         <span style="background-color: #c6f6d5; color: #2f855a; padding: 4px 12px; border-radius: 20px; font-size: 12px;">
    //                             ' . ucfirst($this->payment->status) . '
    //                         </span>
    //                     </span>
    //                 </div>
    //             </div>')
    //         ->action('Voir le détail de la transaction', url('/payments/' . $this->payment->id))
    //         ->line('Si vous avez des questions concernant votre paiement, notre équipe d\'assistance est à votre disposition.')
    //         ->salutation('Cordialement,<br>L\'équipe ' . config('app.name'));
    // }
    
    public function toMail($notifiable) {
        $amount = number_format($this->payment->amount, 2);
        $date = $this->payment->datepaiement->format('d/m/Y à H:i');
        
        // Générer un ID lisible à partir de l'ID de paiement de la base de données
        $displayId = 'PAY-' . str_pad($this->payment->id, 8, '0', STR_PAD_LEFT);
        
        // Données à passer à la vue
        $data = [
            'notifiable' => $notifiable, // L'utilisateur notifié
            'displayId' => $displayId, // ID de transaction formaté
            'date' => $date, // Date formatée
            'amount' => $amount, // Montant formaté
            'status' => ucfirst($this->payment->status), // Statut du paiement
            'paymentUrl' => url('/payments/' . $this->payment->id), // URL des détails du paiement
        ];
    
        // Retourner l'e-mail avec le template Blade
        return (new MailMessage)
            ->subject('Confirmation de votre paiement #' . $displayId)
            ->view('touriste.email', $data); // Utiliser le template Blade
    }
}

