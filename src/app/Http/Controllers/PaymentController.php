<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\stripe;
use Stripe\Customer;
use Stripe\Charge;
use App\Models\Item;
use App\Models\Transaction;
use App\Models\TransactionMessage;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function charge(Request $request)
    {
        try {
            // $intent = \Stripe\PaymentIntent::create([
            //     'amount' => $request->price,
            //     'currency' => 'jpy',
            // ]);

            // stripe.confirmCardPayment(
            //     INTENT_SECRET_FROM_STEP_1,
            //     {
            //       payment_method: {card: cardElement}
            //     }
            //   ).then(function(result) {
            //     if (result.error) {
            //       // Display error.message in your UI.
            //     } else {
            //       // The payment has succeeded
            //       // Display a success message
            //     }
            //   });

            // Set your secret key. Remember to switch to your live secret key in production.
            // See your keys here: https://dashboard.stripe.com/apikeys
            $stripe = new \Stripe\StripeClient('sk_test_51QFoY301NmQJN50w0GqgtG3vFYdzr0qRnbJ5I4NCoO751TzT4g0j8Cei15tN5mE1zjMOyocVxmY42BLBmfFbGi7i00EW8JdKpj');
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $customer = Customer::create(array(
                'email' => $request->stripeEmail,
                'source' => $request->stripeToken
            ));

            $paymentIntent = $stripe->paymentIntents->create([
                'amount' => $request->price,
                'currency' => 'jpy',
                'payment_method_types' => ['card'],
                'setup_future_usage' => 'off_session',
                'customer' => $customer->id
            ]);


            // $charge = Charge::create(array(
            //     'customer' => $customer->id,
            //     'amount' => $request->price,
            //     'currency' => 'jpy'
            // ));

            Item::where('id', $request->item_id)->update([
                'shipping_address_id' => $request->shipping_address_id
            ]);

            $seller = Item::with('user.profile')->where('id', $request->item_id)->first();
            $transaction = Transaction::create([
                'item_id' => $request->item_id,
                'buyer_id' => $request->shipping_address_id,
                'seller_id' => $seller->user->profile->id
            ]);

            TransactionMessage::create([
                'transaction_id' => $transaction->id,
                'user_id' => Auth::id(),
                'message' => '商品を購入しました'
            ]);

            return redirect('/');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
