<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class MyPageController extends Controller
{
    public function setting(Request $request)
    {
        $image = Profile::all();
        // dd($image);
        return view('profile_setting', compact('image'));
    }

    public function set_up(Request $request)
    {
        $file_extension = $request->file('image')->getClientOriginalExtension();

        $user_image = $request->file('image')->storeAs('public/user_images', 'user_'.Auth::id().'.'.$file_extension);

        Profile::create([
            'user_id' => Auth::id(),
            'name' => $request->user_name,
            'post_code' => $request->post_code,
            'address' => $request->address,
            'building_name' => $request->building_name,
            'image' => 'storage/user_images/user_'.Auth::id().'.'.$file_extension
        ]);
        return redirect('/mypage/profile');
    }
}
