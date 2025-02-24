<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Nice;

class NiceController extends Controller
{
    public function nice(Request $request)
    {
        $nice = Nice::where('user_id', Auth::id())->where('item_id', $request->item_id)->exists();
        if(!$nice)
        {
            Nice::create([
                'user_id' => Auth::id(),
                'item_id' => $request->item_id
            ]);

            return back();
        }

        Nice::where('user_id', Auth::id())->where('item_id', $request->item_id)->delete();

        return back();

    }
}
