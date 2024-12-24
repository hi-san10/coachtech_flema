<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemDetailController extends Controller
{
    public function item_detail(Request $request)
    {
        $item = Item::find($request->item_id)->first();

        return view('item', compact('item'));
    }
}
