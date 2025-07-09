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

        $transaction_message_id = Transaction::where('item_id', $item->id)->first();
        $transaction_messages = TransactionMessage::with('user.profile')->where('transaction_id', $transaction_message_id)->get();

        return view('transaction_top', compact('item', 'shipping_address', 'transaction_items', 'transaction_messages'));
    }
}
