<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Condition;
use Illuminate\Support\Facades\Auth;
use App\Models\Nice;
use App\Models\Profile;
use App\Models\Comment;
use App\Http\Requests\ExhibitionRequest;
use App\Models\ShippingAddress;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $word = $request->search_word;
        $prm = $request->page;
        $items = null;

        if(Auth::check() && $prm == 'mylist') {
            $items = Item::select('id', 'name', 'image', 'storage_image', 'shipping_address_id')
                ->ItemSearch($word)->Nice(Auth::id())->get();
        } else {
            $items = Item::select('id', 'name', 'image', 'storage_image', 'shipping_address_id')
                ->ItemSearch($word)->ExcludeUser(Auth::id())->get();
        }
            return view('item_all', compact('items', 'prm', 'word'));
    }

    public function item_detail(Item $item)
    {
        $item->load('condition', 'category');

        $categories = $item->category->all();

        $nice = Nice::where([
            ['user_id', Auth::id()],
            ['item_id', $item->id]
        ])->exists();

        $nice_count = Nice::where('item_id', $item->id)->count();
        $comment_count = Comment::where('item_id', $item->id)->count();

        $comments = Comment::where('item_id', $item->id)->join('profiles', 'comments.user_id', '=', 'profiles.user_id')->get();

        return view('item', compact('item', 'categories', 'nice', 'nice_count', 'comment_count', 'comments'));
    }

    public function sell_top()
    {
        $profile = Profile::where('user_id', Auth::id())->exists();
        if(!$profile)
        {
            return redirect('/mypage/profile');
        }

        $categories = Category::all();
        $conditions = Condition::all();

        return view('sell', compact('categories', 'conditions'));
    }

    public function sell(ExhibitionRequest $request)
    {
        $sellItem = Item::create([
            'user_id' => Auth::id(),
            'condition_id' => $request->condition_id,
            'name' => $request->item_name,
            'price' => $request->price,
            'brand_name' => $request->brand_name,
            'detail' => $request->detail,
        ]);

        $file_extension = $request->file('image')->getClientOriginalExtension();
        $file = $request->file('image');

        if(config('app.env') == 'local')
        {
            $file->storeAs('public/item_images', 'user_' . Auth::id() . '.' . $request->item_name . '.' . $file_extension);
            $sellItem->update([
                'storage_image' => 'storage/item_images/user_' . Auth::id() . '.' . $request->item_name . '.' . $file_extension
            ]);
        }else{
            $dir = 'flema_item';
            $uploadFile = Storage::disk('s3')->putFileAs($dir, $file, 'flema_'.Auth::id().'.'.$file_extension);

            $sellItem->update([
                'storage_image' => $uploadFile
            ]);
        }

        $items = Item::where('user_id', Auth::id())->latest('id')->first();
        $items->category()->sync($request->categories);

        return redirect('/')->with('sell_message', '商品の出品が完了しました');
    }

    public function purchase_top(Item $item)
    {
        $user = Profile::where('user_id', Auth::id())->first();
        $shipping_addresses = ShippingAddress::where('profile_id', Auth::id())->get();

        if(is_null($user))
        {
            return back();
        }

        return view('purchase', compact('item', 'user', 'shipping_addresses'));
    }

    public function address_change_top(Item $item)
    {
        $user = Profile::where('user_id', Auth::id())->first();

        return view('address_change', compact('user', 'item'));
    }

}
