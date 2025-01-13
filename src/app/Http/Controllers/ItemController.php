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
    public function index()
    {
        if(Auth::check())
        {
            $id = Auth::id();
            $items = Item::where('user_id', '!=', Auth::id())->get();
            return view('item_all', compact('items'));
        }

        $items = Item::select('id', 'name', 'image', 'storage_image', 'is_sold')->get();
        return view('item_all', compact('items'));
    }

    public function item_detail(Request $request)
    {
        $item_id = $request->item_id;
        $item = Item::with('condition', 'category')->whereId($item_id)->first();

        $categories = $item->category->all();

        $nice = Nice::where('item_id', $item_id)->count();

        $comment = Comment::with('user', 'item')->where('user_id', Auth::id())->where('item_id', $item_id)->exists();
        $comment_user = Comment::with('user', 'item')->where('user_id', Auth::id())->where('item_id', $item_id)->first();
        $comment_count = Comment::where('item_id', $item_id)->count();

        $user = Profile::where('user_id', Auth::id())->first();
        // if($user)
        // {
        //     $user_img = $user->image;

        //     return view('item', compact('item', 'categories', 'nice', 'comment', 'comment_user', 'comment_count','user', 'user_img'));
        // }
        return view('item', compact('item', 'categories', 'nice', 'comment', 'comment_user', 'comment_count', 'user'));
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

}
