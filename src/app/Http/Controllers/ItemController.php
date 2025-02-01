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

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $word = $request->search_word;
        $prm = $request->page;

        if(!$request->page)
        {
            $items = Item::select('id', 'name', 'image', 'storage_image', 'is_sold')
            ->when($word, fn ($query) => $query->where('name', 'like', '%'.$word.'%'))
            ->when(Auth::check(), fn ($query) => $query->where('user_id', '!=', Auth::id()))->get();

            return view('item_all', compact('items', 'prm'));
        }elseif(!Auth::check())
        {
            return view('list_none');
        }
            $items = Item::select('id', 'name', 'image', 'storage_image', 'is_sold')
            ->when($word, fn ($query) => $query->where('name', 'like', '%'.$word.'%'))
            ->whereHas('nices', fn ($query) => $query->where('user_id', Auth::id()))->get();

            return view('item_all', compact('items', 'prm'));
    }

    public function item_detail(Request $request)
    {
        $item_id = $request->item_id;
        $item = Item::with('condition', 'category')->whereId($item_id)->first();

        $categories = $item->category->all();

        $nice = Nice::where('item_id', $item_id)->count();
        $comment_count = Comment::where('item_id', $item_id)->count();

        $comment = Comment::where('item_id', $item_id)->select('user_id', 'comment')->inRandomOrder()->first();
        $user = Profile::when($comment, fn ($query) => $query->where('user_id', $comment->user_id)->select('name', 'image'))->first();

        return view('item', compact('item', 'categories', 'nice', 'comment_count', 'comment', 'user'));
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

    public function sell(Request $request)
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
        $item = Item::find($request->item_id)->first();
        $user = Profile::where('user_id', Auth::id())->first();

        if(is_null($user))
        {
            return back();
        }

        return view('purchase', compact('item', 'user'));
    }

    public function address_change_top(Request $request)
    {
        $user = Profile::where('user_id', Auth::id())->first();
        $item = Item::find($request->item_id)->first();

        return view('address_change', compact('user', 'item'));
    }

    public function search(Request $request)
    {
        $items = Item::select('id', 'name', 'image', 'storage_image', 'is_sold')->ItemSearch($request->search_word)->get();

        return view('item_all', compact('items'));
    }

}
