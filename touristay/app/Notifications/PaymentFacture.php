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

    public function toMail($notifiable)
{
    $amount = number_format($this->payment->amount, 2);
    $date = now()->format('d/m/Y à H:i');
    
    return (new MailMessage)
        ->subject('Confirmation de votre paiement #' . substr($this->payment->payment_id, 0, 8))
        ->greeting('Merci pour votre paiement, ' . $notifiable->name . '!')
        ->line('Votre transaction a été traitée avec succès.')
        ->lineIf($this->payment->payer_email, 'Compte PayPal: ' . $this->payment->payer_email)
        ->line('<div style="background-color: #f8f9fa; border-radius: 8px; padding: 20px; margin: 15px 0;">
            <div style="color: #495057; font-size: 16px; margin-bottom: 10px;">Détails de la transaction:</div>
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="padding: 8px 5px; color: #6c757d;">Numéro de transaction</td>
                    <td style="padding: 8px 5px; text-align: right; font-weight: bold;">' . $this->payment->payment_id . '</td>
                </tr>
                <tr>
                    <td style="padding: 8px 5px; color: #6c757d;">Date</td>
                    <td style="padding: 8px 5px; text-align: right;">' . $date . '</td>
                </tr>
                <tr>
                    <td style="padding: 8px 5px; color: #6c757d;">Montant</td>
                    <td style="padding: 8px 5px; text-align: right; font-size: 18px; font-weight: bold; color: #28a745;">$' . $amount . ' USD</td>
                </tr>
                <tr>
                    <td style="padding: 8px 5px; color: #6c757d;">Statut</td>
                    <td style="padding: 8px 5px; text-align: right;"><span style="background-color: #d4edda; color: #155724; padding: 4px 8px; border-radius: 4px; font-size: 14px;">' . ucfirst($this->payment->status) . '</span></td>
                </tr>
            </table>
        </div>')
        ->action('Voir le détail de la transaction', url('/payments/' . $this->payment->payment_id))
        ->line('Si vous avez des questions concernant votre paiement, n\'hésitez pas à contacter notre équipe d\'assistance.')
        ->salutation('Cordialement,<br>L\'équipe ' . config('app.name'));
}

}

