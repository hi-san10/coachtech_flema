<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Item;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\AddressRequest;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;
use App\Models\ShippingAddress;
use App\Http\Requests\AddressChangeRequest;
use App\Models\Transaction;
use App\Models\TransactionMessage;
use App\Models\Evaluation;
use Illuminate\Support\Facades\DB;

class MyPageController extends Controller
{
    public function setting(Request $request)
    {
        $profile_id = Profile::where('user_id', Auth::id())->exists();

        if(!$profile_id)
        {
            return view('profile_setting', compact('profile_id'));
        }

        $profile = Profile::where('user_id', Auth::id())->first();

        return view('profile_setting', compact('profile_id', 'profile'));
    }

    public function image_set_up(ProfileRequest $request)
    {
        $file_extension = $request->file('image')->getClientOriginalExtension();

        $request->file('image')->storeAs('public/user_images', 'user_'.Auth::id().'.'.$file_extension);

        Profile::create([
            'user_id' => Auth::id(),
            'image' => 'storage/user_images/user_'.Auth::id().'.'.$file_extension
        ]);

        return redirect()->route('setting');
    }

    public function mypage(Request $request)
    {
        $user_id = Auth::id();
        $profile = Profile::where('user_id', $user_id)->first();
        $prf_id = $profile->id;
        $prm = $request->page;

        if(!$profile)
        {
            return redirect('/mypage/profile');
        }elseif ($prm == 'buy'){
            $items = Item::where('shipping_address_id', $prf_id)->get();
            $total_message = Transaction::where([['buyer_id', $prf_id], ['buyer_completion', 'false']])
                ->orWhere([['seller_id', $profile->id], ['seller_completion', 'false']])
                ->whereHas('transaction_messages', function ($query) {
                    $query->where('user_id', '!=', Auth::id());
                })->count();
        }elseif ($prm == 'transaction'){
            $baseQuery = DB::table('Transactions')
                ->where([['buyer_id', $prf_id], ['buyer_completion', 'false']])
                ->orWhere([['seller_id', $prf_id], ['seller_completion', 'false']])
                ->join('transaction_messages', 'transactions.id', '=', 'transaction_messages.transaction_id')
                ->join('items', 'transactions.item_id', '=', 'items.id')
                ->select(
                    'transactions.*',
                    'transaction_messages.created_at as message_created_at',
                    'items.name as name',
                    'items.shipping_address_id as shipping_address_id',
                    'items.image as image',
                    'items.storage_image as storage_image',
                    DB::raw("SUM(CASE WHEN transaction_messages.user_id != {$user_id} THEN 1 ELSE 0 END)
                    OVER (PARTITION BY transactions.id) AS other_user_message_count") ,
                    DB::raw('ROW_NUMBER() OVER (PARTITION BY transactions.item_id ORDER BY transaction_messages.created_at DESC) as row_num')
                );

            $items = DB::table(DB::raw("({$baseQuery->toSql()}) as sub"))
                ->mergeBindings($baseQuery)
                ->where('row_num', 1)
                ->orderBy('message_created_at', 'desc')
                ->get();
            $total_message = $items->sum('other_user_message_count');
        }else{
            $items = Item::where('user_id', $user_id)->get();
            $total_message = Transaction::where([['buyer_id', $prf_id], ['buyer_completion', 'false']])
                ->orWhere([['seller_id', $profile->id], ['seller_completion', 'false']])
                ->whereHas('transaction_messages', function ($query)
                {
                    $query->where('user_id', '!=', Auth::id());
                })->count();
        }

        $message_count = Transaction::withCount('transaction_messages')
            ->where([['buyer_id', $prf_id], ['buyer_completion', 'false']])
            ->orWhere([['seller_id', $prf_id], ['seller_completion', 'false']])->get();

        $evaluation = Evaluation::where('profile_id', $prf_id)->get();
        $evaluation_point = $evaluation->avg('point');
        $evaluation_average_point = round($evaluation_point);

        return view('mypage', compact('profile', 'items', 'prm', 'message_count', 'total_message', 'evaluation_average_point'));
    }

    public function image_update(ProfileRequest $request)
    {
        $user = Profile::where('user_id', Auth::id())->first();

        $user_image = $user->image;
        $path = substr($user_image, 20);
        Storage::disk('public')->delete('user_images/'.$path);

        $file_extension = $request->file('image')->getClientOriginalExtension();

        $user_image = $request->file('image')->storeAs('public/user_images', 'user_'.Auth::id().'.'.$file_extension);

        Profile::where('user_id', Auth::id())->update([
            'image' => 'storage/user_images/user_'.Auth::id().'.'.$file_extension
        ]);

        return redirect()->route('setting');
    }

    public function update(AddressRequest $request)
    {
        Profile::where('user_id', Auth::id())->update([
            'name' => $request->user_name,
            'post_code' => $request->post_code,
            'address' => $request->address,
            'building_name' => $request->building_name,
        ]);

        $profile = Profile::where('user_id', Auth::id())->first();

        ShippingAddress::create([
            'profile_id' => $profile->id,
            'post_code' => $profile->post_code,
            'address' => $profile->address,
            'building_name' => $profile->building_name
        ]);

        return redirect('/');
    }

    public function comment(CommentRequest $request)
    {
        $comment = Comment::with('user', 'item')->where([
            ['user_id', Auth::id()],
            ['item_id', $request->item_id]
        ])->exists();

        Comment::create([
            'user_id' => Auth::id(),
            'item_id' => $request->item_id,
            'comment' => $request->comment
        ]);

        if($comment)
        {
            return back()->with('message', 'コメントを更新しました');
        }

        return back();
    }

    public function change_shipping_address(AddressChangeRequest $request)
    {
        $profile = Profile::where('user_id', Auth::id())->first();

        ShippingAddress::create([
            'profile_id' => $profile->id,
            'post_code' => $request->post_code,
            'address' => $request->address,
            'building_name' => $request->building_name,
            'item_id' => '1'
        ]);

        $user = ShippingAddress::where('profile_id', $profile->id)->latest('id')->first();
        $item = Item::whereId($request->item_id)->first();

        return view('purchase', compact('user', 'item'));
    }
}
