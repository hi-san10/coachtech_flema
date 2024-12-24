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

}
