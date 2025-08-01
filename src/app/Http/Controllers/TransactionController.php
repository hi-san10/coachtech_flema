<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Profile;
use App\Models\ShippingAddress;
use App\Models\Transaction;
use App\Models\TransactionMessage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TransactionMessageRequest;
use App\Models\Evaluation;
use Illuminate\Support\Facades\Mail;
use App\Mail\TransactionCompletedMail;

class TransactionController extends Controller
{
    public function transactionTop(Request $request)
    {
        $item = Item::with(['user.profile'])->where('id', $request->item_id)->first();
        $shipping_address = ShippingAddress::with('profile')->where('id', $request->shipping_id)->first();

        $profile = Profile::where('user_id', Auth::id())->first();

        $transaction_items = Item::join('transactions', 'items.id', '=', 'transactions.item_id')
            ->where([['seller_id', $profile->id], ['item_id', '!=', $item->id], ['buyer_completion', 'false']])
            ->orWhere([['buyer_id', $profile->id], ['buyer_completion', 'false'], ['item_id', '!=', $item->id]])
            ->get();

        $transaction = Transaction::with('item')->where('item_id', $item->id)->first();
        $last_message = TransactionMessage::with('user.profile')->where('transaction_id', $transaction->id)->latest()->first();
        if ($last_message){
            $transaction_messages = TransactionMessage::with('user.profile')->where('id', '<>', $last_message->id)->where('transaction_id', $transaction->id)->get();
        }else{
            $transaction_messages = null;
        }

        return view('transaction_top', compact('item', 'shipping_address', 'transaction_items', 'last_message', 'transaction_messages', 'transaction'));
    }

    public function post(TransactionMessageRequest $request)
    {
        $item = Item::where('id', $request->item_id)->first();
        $transaction = Transaction::where('item_id', $item->id)->first();

        $message = TransactionMessage::create([
            'transaction_id' => $transaction->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        if ($request->file('image')) {
            $file_extension = $request->file('image')->getClientOriginalExtension();

            $request->file('image')->storeAs('public/transaction_images', 'item_' . $item->id . '.' . $file_extension);

            $message->update([
                'image' => 'storage/transaction_images/item_' . $item->id . '.' . $file_extension
            ]);
        }

        return redirect()->route('transaction_top', ['item_id' => $item->id, 'shipping_id' => $item->shipping_address_id]);
    }

    public function update(Request $request)
    {
        TransactionMessage::where('id', $request->message_id)
            ->update(['message' => $request->update_message]);

        return back();
    }

    public function delete(Request $request)
    {
        TransactionMessage::where('id', $request->message_id)
            ->delete();

        return back();
    }

    public function transactionEnd(Request $request)
    {
        Transaction::where('id', $request->transaction_id)
            ->update(['buyer_completion' => true]);

        return redirect()->route('transaction_top', ['item_id' => $request->item_id, 'shipping_id' => $request->shipping_id]);
    }

    public function evaluation(Request $request)
    {
        $transaction = Transaction::find($request->transaction_id);

        $profile = Profile::with('user')->where('user_id', Auth::id())->first();
        $seller = Item::with('user')->where('id', $transaction->item_id)->first();

        if ($transaction->buyer_id == $profile->id) {
        Transaction::where('id', $transaction->id)
            ->update(['buyer_completion' => true]);

        Evaluation::create([
            'transaction_id' => $transaction->id,
            'profile_id' => $transaction->seller_id,
            'point' => $request->point
        ]);
        $user_email = $seller->user->email;

        Mail::to($user_email)->send(new TransactionCompletedMail($user_email));
        }else{
        Transaction::where('id', $transaction->id)
            ->update(['seller_completion' => true]);

        Evaluation::create([
            'transaction_id' => $transaction->id,
            'profile_id' => $transaction->buyer_id,
            'point' => $request->point
        ]);
        }

        return redirect('/');
    }
}
