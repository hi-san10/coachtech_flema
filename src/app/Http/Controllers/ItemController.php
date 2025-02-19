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

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $word = $request->search_word;
        $prm = $request->page;
        $items = null;

        if(Auth::check() && $prm == 'mylist')
        {
            $items = Item::select('id', 'name', 'image', 'storage_image', 'is_sold')
                ->when($word, fn ($query) => $query->where('name', 'like', '%'.$word.'%'))
                ->whereHas('nices', fn ($query) => $query->where('user_id', Auth::id()))->get();
        }else{
            $items = Item::select('id', 'name', 'image', 'storage_image', 'is_sold')
                ->when($word, fn ($query) => $query->where('name', 'like', '%'.$word.'%'))
                ->when(Auth::check(), fn ($query) => $query->where('user_id', '!=', Auth::id()))->get();
        }
            return view('item_all', compact('items', 'prm', 'word'));
    }

    public function item_detail(Request $request)
    {
        $item_id = $request->item_id;
        $item = Item::with('condition', 'category')->whereId($item_id)->first();

        $categories = $item->category->all();

        $nice = Nice::where([
            ['user_id', Auth::id()],
            ['item_id', $item_id]
        ])->exists();

        $nice_count = Nice::where('item_id', $item_id)->count();
        $comment_count = Comment::where('item_id', $item_id)->count();

        $comments = Comment::where('item_id', $item_id)->join('profiles', 'comments.user_id', '=', 'profiles.user_id')->get();

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
        $file_extension = $request->file('image')->getClientOriginalExtension();
        $item_image = $request->file('image')->storeAs('public/item_images', 'user_'.Auth::id().'.'.$request->item_name.'.'.$file_extension);

        $item = Item::create([
            'user_id' => Auth::id(),
            'condition_id' => $request->condition_id,
            'name' => $request->item_name,
            'price' => $request->price,
            'brand_name' => $request->brand_name,
            'detail' => $request->detail,
            'storage_image' => 'storage/item_images/user_'.Auth::id().'.'.$request->item_name.'.'.$file_extension
        ]);

        $items = Item::where('user_id', Auth::id())->latest('id')->first();
        $items->category()->sync($request->categories);

        return redirect('/')->with('sell_message', '商品の出品が完了しました');
    }

    public function purchase_top(Request $request)
    {
        $item = Item::where('id', $request->item_id)->first();
        $user = Profile::where('user_id', Auth::id())->first();
        $shipping_addresses = ShippingAddress::where('profile_id', Auth::id())->get();

        if(is_null($user))
        {
            return back();
        }

        return view('purchase', compact('item', 'user', 'shipping_addresses'));
    }

    public function address_change_top(Request $request)
    {
        $user = Profile::where('user_id', Auth::id())->first();
        $item = Item::find($request->item_id)->first();

        return view('address_change', compact('user', 'item'));
    }

}
