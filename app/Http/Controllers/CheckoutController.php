<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Exception;
use Midtrans\Snap;
use Midtrans\Notification;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;

class CheckoutController extends Controller
{
     public function process(Request $request){
        // Simpan user data yeng melakuken checkout
        $user = Auth::user();
        $user->update($request->except('total_price'));

        // Proses checkout
        $code = 'STORE-' . mt_rand(000000,999999);
        $carts = Cart::with(['product','user'])
                    ->where('users_id', Auth::user()->id)
                    ->get();
                    

        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            'insurance_price' => $request->insurance,
            'shippinng_price' => $request->shipping,
            'total_price' =>(int) $request->input("totalbayar"),
            'transaction_status' => 'PENDING',
            'code' => $code,
            'pay_url' =>''

        ]);
        //  looping data yang ada di cart
        foreach ($carts as $cart) {
            $trx = 'TRX-' . mt_rand(0000,9999);

            TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'products_id' => $cart->product->id,
                'price' => $cart->product->price,
                'shipping_status' => 'PENDING',
                'resi' => '',
                'qty'=>$cart->qty,
                'code' => $trx,
            ]);
        }
        // Reset Cart After Checkout
         Cart::with(['product','user'])
                ->where('users_id', Auth::user()->id)
                ->delete();


        // konfigurasi midtrans
        // Set your Merchant Server Key
        Config::$serverKey = config('services.midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = config('services.midtrans.isProduction');
        // Set sanitization on (default)
        Config::$isSanitized = config('services.midtrans.isSanitized ');
        // Set 3DS transaction for credit card to true
        Config::$is3ds = config('services.midtrans.is3ds');


        // data array yang akan dikirim ke midtrans
        $midtrans = array(
            'transaction_details' => array(
                'order_id' =>  $code,
                'gross_amount' => (int) $request->input("totalbayar"),
            ),
            'customer_details' => array(
                'first_name'    => Auth::user()->name,
                'email'         =>  Auth::user()->email,
            ),
            'enabled_payments' => array('permata_va',
                'bca_va', 'bni_va', 'bri_va', 'other_va', 'gopay', 'indomaret',
                'shopeepay','bank_transfer'),
            'vtweb' => array()
        );

        
        try {
        // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;
            $transaction = Transaction::where('id',  $transaction->id) ->update([
                            'pay_url' => $paymentUrl,
                        ]);
        // Redirect to Snap Payment Page
            return redirect($paymentUrl);
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
		
       
    }
    

    public function callback(Request $request)
    {
        // Set konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // Buat instance midtrans notification
        $notification = new Notification();

    
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;


        if ($status == 'capture') {
            if ($type == 'credit_card'){
                if($fraud == 'challenge'){
                    $transaction = Transaction::where('code', $order_id)->update([
                            'transaction_status' => 'PENDING'
                        ]);
                }
                else {
                    $transaction = Transaction::where('code', $order_id)->update([
                            'transaction_status' => 'SUCCESS'
                        ]);
                }
            }
        }
        else if ($status == 'settlement'){
             $transaction = Transaction::where('code', $order_id)->update([
                            'transaction_status' => 'SUCCESS'
                        ]);
        }
        else if($status == 'pending'){
             $transaction = Transaction::where('code', $order_id)->update([
                            'transaction_status' => 'PENDING'
                        ]);
        }
        else if ($status == 'deny') {
             $transaction = Transaction::where('code', $order_id)->update([
                            'transaction_status' => 'CANCELLED'
                        ]);
        }
        else if ($status == 'expire') {
            $transaction = Transaction::where('code', $order_id)->update([
                            'transaction_status' => 'CANCELLED'
                        ]);
        }
        else if ($status == 'cancel') {
            $transaction = Transaction::where('code', $order_id)->update([
                            'transaction_status' => 'CANCELLED'
                        ]);
        }

        // Simpan transaksi

       return $transaction;
    }
}
