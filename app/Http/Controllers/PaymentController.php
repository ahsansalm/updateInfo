<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Credit;
use App\Models\user_total_credit;
use Illuminate\Http\Request;
use App\Models\UserPayCreditsNoti;
use Illuminate\Support\Carbon;
use Omnipay\Omnipay;
use Auth;
use DB;
class PaymentController extends Controller
{
    private $gateway;

    public function __construct() {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true);
    }

    public function pay(Request $request)
    {
        

        
        try {

            $response = $this->gateway->purchase(array(
          
                'amount' => $request->amount,
                'credits' => $request->credits,
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => url('success'),
                'cancelUrl' => url('error')
            ))->send();

            if ($response->isRedirect()) {
                $response->redirect();
            }
            else{
                return $response->getMessage();
            }

        } catch (\Throwable $th) {
            return $th->getMessage();
        }
       
    }

    public function success(Request $request)
    
    {
       
        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
                'credits' => $request->input('credits'),
            ));

            $response = $transaction->send();

        if ($response->isSuccessful()) {
                
       

                $arr = $response->getData();
                $id = Auth::user()->id;
                $payment = new Payment();
                $payment->payment_id = $arr['id'];
                $payment->user_id = $id;
                $payment->payer_id = $arr['payer']['payer_info']['payer_id'];
                $payment->payer_email = $arr['payer']['payer_info']['email'];
                $payment->amount = $arr['transactions'][0]['amount']['total'];
                $payment->currency = env('PAYPAL_CURRENCY');
                $payment->payment_status = $arr['state'];
                $payment->save();

                $old_val =  user_total_credit::where('user_id' ,'=', $id)->first();
                $credits = $old_val->credits;
                $totalCredits =$old_val->totalCredits;
                $new_val =   $arr['transactions'][0]['amount']['total'] + $credits;
                $totalCreditsnew =   $arr['transactions'][0]['amount']['total'] + $totalCredits;

                user_total_credit::where('user_id',$id)->update([
                    'credits' => $new_val,
                    'totalCredits' => $totalCreditsnew,
                ]);


                DB::table('user_pay_credits_notis')->update(array('status' => 'Neuf'));
                UserPayCreditsNoti::insert([
                  'userId' => $id,
                  'productId' => $arr['transactions'][0]['amount']['total'] ,
                  'description' =>'Acheter des crédits',
                  'status' => 'Neuf',
                  'created_at' => Carbon::now(),
                ]);


                $notification = array(
                    'message' => 'Acheter des crédits avec succès.',
                    'alert_type' => 'success'
                );
                return Redirect('/SupportWallet')->with( $notification);



            }
            else{
                return $response->getMessage();
            }
        }
        else{
            $notification = array(
                'message' => 'Annulation du paiement.',
                'alert_type' => 'error'
            );
            return Redirect('/SupportWallet')->with($notification);
        }
    }

    public function error()
    {
        $notification = array(
                'message' => 'Lutilisateur refuse le paiement.',
                'alert_type' => 'error'
            );
            return Redirect('/SupportWallet')->with($notification);
        }
}

