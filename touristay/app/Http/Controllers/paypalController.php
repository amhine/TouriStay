<?php

// namespace App\Http\Controllers;

// use App\Models\paiement;
// use App\Notifications\PaymentFacture;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Http\Request;
// use App\Models\payment;
// use Omnipay\PayPal\RestGateway;
// use Omnipay\Omnipay;
// use app\Models\Reservation;
// use PharIo\Manifest\Url;
// use Illuminate\Support\Facades\Notification;

// class paypalController extends Controller
// {
//     private $gateway;
    
//     public function __construct()
//     {
//         $this->gateway = Omnipay::create(RestGateway::class);
//         $this->gateway->initialize([
//             'clientId'  => env('PAYPAL_CLIENT_ID'),
//             'secret'    => env('PAYPAL_CLIENT_SECRET'),
//             'testMode'  => true, 
//         ]);
//     }
    
//     // public function pay(Request $request)
//     // {
//     //     try {
//     //         $response = $this->gateway->purchase([
//     //             'amount' => $request->amount,
//     //             'currency' => 'USD',
//     //             'returnUrl' => route('paypal.success'),
//     //             'cancelUrl' => route('paypal.error'),
//     //         ])->send();
            
//     //         if ($response->isRedirect()) {
//     //             $data = $response->getData();
//     //             if (isset($data['links']) && is_array($data['links'])) {
//     //                 foreach ($data['links'] as $link) {
//     //                     if (isset($link['rel']) && $link['rel'] === 'approval_url') {
//     //                         return redirect()->away($link['href']);
//     //                     }
//     //                 }
//     //             }
                
//     //             if (isset($data['approvalUrl'])) {
//     //                 return redirect()->away($data['approvalUrl']);
//     //             }
                
//     //             return back()->with('error', 'Could not determine redirect URL');
//     //         } else {
//     //             return back()->with('error', $response->getMessage());
//     //         }
            
//     //     } catch (\Throwable $th) {
//     //         return back()->with('error', $th->getMessage());
//     //     }
//     // }

//     public function pay(Request $request, $reservationId)
//     {
//         try {
//             // Récupérer la réservation par ID
//             $reservation = Reservation::findOrFail($reservationId);
            
//             // Calculer le nombre de nuits à partir des dates de la réservation
//             $dateDebut = new \DateTime($reservation->dateDebut);
//             $dateFin = new \DateTime($reservation->dateFin);
//             $nombreDeNuits = $dateFin->diff($dateDebut)->days;
            
//             // S'assurer que le nombre de nuits est au moins 1
//             $nombreDeNuits = max(1, $nombreDeNuits);
            
//             // Calculer le montant total
//             $amount = $reservation->annonce->prixparnuit * $nombreDeNuits;
    
//             // Si vous avez des variables comme $prixTotal ou $nombreDeNuits dans votre vue, vous devez les envoyer via votre formulaire.
            
//             // Configurer les URLs de retour pour PayPal
//             $response = $this->gateway->purchase([
//                 'amount' => $amount,
//                 'currency' => 'USD', // Ou la devise appropriée
//                 'returnUrl' => route('paypal.success', ['reservationId' => $reservationId]),
//                 'cancelUrl' => route('paypal.error', ['reservationId' => $reservationId]),
//             ])->send();
            
//             // Si la réponse de PayPal indique une redirection
//             if ($response->isRedirect()) {
//                 return redirect()->away($response->getRedirectUrl()); // redirige vers l'URL PayPal
//             } else {
//                 return back()->with('error', $response->getMessage()); // En cas d'erreur
//             }
            
//         } catch (\Throwable $th) {
//             return back()->with('error', $th->getMessage());
//         }
//     }
    
//     public function success(Request $request)
//     {
//         if ($request->input('paymentId') && $request->input('PayerID')) {
//             $transaction = $this->gateway->completePurchase([
//                 'payer_id' => $request->input('PayerID'),
//                 'transactionReference' => $request->input('paymentId'),
//             ])->send();
            
//             $response = $transaction->getData();
            
//             if ($transaction->isSuccessful()) {
//                 $arr = $response;
                
//                 $payment = new paiement();
//                 $payment->payment_id = $arr['id'];
//                 $payment->payer_id = $arr['payer']['payer_info']['payer_id'];
//                 $payment->status = $arr['state'];
//                 $payment->amount = $arr['transactions'][0]['amount']['total'];
//                 $payment->save();
                
//                 $user = auth()->user();
//                 if ($user) {
//                     Notification::send($user, new PaymentFacture($payment));
//                 }
                
//                 session()->flash('success','Payment successful');
                
//                 return to_route('annonce');
//             } else {
//                 session()->flash('error',$transaction->getMessage());
//                 return to_route('annonce');
//             }
//         } else {
//             session()->flash('error', 'Payment declined');
//             return to_route('annonce');
//         }
//     }
    
//     public function error()
//     {
//         session()->flash('error','user declined the payment');
//         return to_route('annonce');
//     }
// }




namespace App\Http\Controllers;

use App\Models\paiement;
use App\Models\Reservation;
use App\Notifications\PaymentFacture;
use Illuminate\Http\Request;
use Omnipay\Omnipay;
use Omnipay\PayPal\RestGateway;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\Mailer\Test\Constraint\EmailCount;

class paypalController extends Controller
{
    //
    private $gateway;
    public function __construct()
    {
        $this->gateway = Omnipay::create(RestGateway::class);
        $this->gateway->initialize([
            'clientId'  => 'AfjsJwTjeUizR7aq30pI5uH1kVoh4lD2q2pKdF82truEj57hR6wWap3gQ9_rcGmPLYPNeCnb2Tpfds7l',
            'secret'    => 'EEgN5dVRhpehCR_CmPlzHe5HPNpqXK6J6b76wxVc_Zx8t0UbMW2eQDBt5d_Z1jJzKFnQ-JleeZOc3HBh',
            'testMode'  => true,
        ]);
    }
    
    public function pay(Request $request, $reservationId)
    {
        try {
            $reservation = Reservation::findOrFail($reservationId);
            $dateDebut = new \DateTime($reservation->dateDebut);
            $dateFin = new \DateTime($reservation->dateFin);
            $nombreDeNuits = $dateFin->diff($dateDebut)->days;
            $nombreDeNuits = max(1, $nombreDeNuits);
            $amount = $reservation->annonce->prixparnuit * $nombreDeNuits;
    
            session(['reservation_id' => $reservationId]);
    
            $response = $this->gateway->purchase([
                'amount' => $amount,
                'currency' => 'USD',
                'returnUrl' => route('paypal.success', ['reservationId' => $reservationId]),
                'cancelUrl' => route('paypal.error', ['reservationId' => $reservationId]),
            ])->send();

            // dd($response->getData());
            if ($response->isRedirect()) {
                $data = $response->getData();
                if (isset($data['links']) && is_array($data['links'])) {
                    foreach ($data['links'] as $link) {
                        if (isset($link['rel']) && $link['rel'] === 'approval_url') {
                            return redirect()->away($link['href']);
                        }
                    }
                }
                return back()->with('error', 'Impossible de déterminer l\'URL de redirection');
            } else {
                return back()->with('error', $response->getMessage());
            }
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    
    
    

   
    public function success(Request $request)
{
    if ($request->input('paymentId') && $request->input('PayerID')) {
        $transaction = $this->gateway->completePurchase([
            'payer_id' => $request->input('PayerID'),
            'transactionReference' => $request->input('paymentId'),
        ])->send();
        
        $response = $transaction->getData();
        
        if ($transaction->isSuccessful()) {
            $arr = $response;
            
            $reservationId = session('reservation_id');
            
            if (!$reservationId) {
                session()->flash('error', 'Reservation ID is missing in session.');
                return to_route('annonce.err');
            }
            
            $payment = new paiement();
            $payment->reservation_id = $reservationId; 
            $payment->datepaiement = now(); 
            $payment->id_touriste = auth()->id();
            $payment->status = $arr['state'];
            $payment->amount = $arr['transactions'][0]['amount']['total'];
            
            $payment->save();
            
            $reservation = Reservation::find($reservationId);
            if ($reservation) {
                $reservation->status = 'payé';
                $reservation->save();
            }
            session()->flash('success', 'Paiement réussi');
            return to_route('annonce');
        } else {
            session()->flash('error', $transaction->getMessage());
            return to_route('annonce.err');
        }
    } else {
        session()->flash('error', 'Paiement refusé');
        return to_route('annonce.err');
    }
}

    
    public function error()
    {
        session()->flash('error', 'Le paiement a été annulé');
        return to_route('annonce');
    }
}