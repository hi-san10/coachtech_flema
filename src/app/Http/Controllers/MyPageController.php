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
        $profile_id = Profile::where('user_id', Auth::id())->exists();

        if(!$profile_id)
        {
            return view('profile_setting', compact('profile_id'));
        }

        $profile = Profile::where('user_id', Auth::id())->first();
        return view('profile_setting', compact('profile_id', 'profile'));
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
        return redirect('/');
    }

    public function mypage(Request $request)
    {
        $user = Profile::where('user_id', $request->id)->first();

        return view('mypage', compact('user'));
    }

    public function update(Request $request)
    {
        $file_extension = $request->file('image')->getClientOriginalExtension();

        $user_image = $request->file('image')->storeAs('public/user_images', 'user_'.Auth::id().'.'.$file_extension);

        Profile::where('user_id', Auth::id())->update([
            'name' => $request->user_name,
            'post_code' => $request->post_code,
            'address' => $request->address,
            'building_name' => $request->building_name,
            'image' => 'storage/user_images/user_'.Auth::id().'.'.$file_extension
        ]);

        return redirect()->route('setting');
    }
}
