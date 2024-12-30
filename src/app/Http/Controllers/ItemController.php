<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::select('id', 'name', 'image')->get();
        return view('item_all', compact('items'));
    }

    public function item_detail(Request $request)
    {
        // $item = Item::find($request->item_id)->first();
        $item = Item::with('condition')->whereId($request->item_id)->first();
        // dd($item->condition->condition);
        return view('item', compact('item'));
    }

}
