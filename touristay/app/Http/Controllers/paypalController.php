<?php




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
            'clientId'  => config('services.paypal.client_id'),
            'secret'    => config('services.paypal.secret'),
            'testMode'  => config('services.paypal.test_mode'),
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