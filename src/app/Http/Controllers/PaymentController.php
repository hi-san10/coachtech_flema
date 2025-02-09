<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\stripe;
use Stripe\Customer;
use Stripe\Charge;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function charge(Request $request)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $customer = Customer::create(array(
                'email' => $request->stripeEmail,
                'source' => $request->stripeToken
            ));

            $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount' => $request->price,
                'currency' => 'jpy'
            ));

            Item::where('id', $request->item_id)->update([
                'is_sold' => Auth::id()
            ]);


            return redirect('/');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
