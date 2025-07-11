<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Profile;
use App\Models\ShippingAddress;
use App\Models\Transaction;
use App\Models\TransactionMessage;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function transactionTop(Request $request)
    {
        $item = Item::with(['user.profile'])->where('id', $request->item_id)->first();
        $shipping_address = ShippingAddress::with('profile')->where('id', $request->shipping_id)->first();

        $profile = Profile::where('user_id', Auth::id())->first();
        $transaction_items = Item::where('shipping_address_id', $profile->id)->orWhere('user_id', Auth::id())->join('transactions', 'items.id', '=', 'transactions.item_id')->where('is_completion', 'false')->get();

        $transaction = Transaction::where('item_id', $item->id)->first();
        $last_message = TransactionMessage::with('user.profile')->where('transaction_id', $transaction->id)->latest()->first();
        // dd($last_message);
        if ($last_message){
            $transaction_messages = TransactionMessage::with('user.profile')->where('id', '<>', $last_message->id)->where('transaction_id', $transaction->id)->get();

        }else{
            $transaction_messages = null;
        }

        return view('transaction_top', compact('item', 'shipping_address', 'transaction_items', 'last_message', 'transaction_messages'));
    }

    public function post(Request $request)
    {
        $item = Item::where('id', $request->item_id)->first();
        $transaction = Transaction::where('item_id', $item->id)->first();

        TransactionMessage::create([
            'transaction_id' => $transaction->id,
            'user_id' => Auth::id(),
            'message' => $request->message,

        ]);

        return redirect()->route('transaction_top', ['item_id' => $item->id, 'shipping_id' => $item->shipping_address_id]);
    }

    public function update(Request $request)
    {
        TransactionMessage::where('id', $request->message_id)
            ->update(['message' => $request->update_message]);

        return redirect()->route('mypage', ['page' => 'transaction']);
    }

    public function delete(Request $request)
    {
        TransactionMessage::where('id', $request->message_id)
            ->delete();

        return redirect()->route('mypage', ['page' => 'transaction']);
    }
}
