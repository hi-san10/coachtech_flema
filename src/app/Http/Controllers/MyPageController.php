<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Item;
use App\Models\Nice;

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
        $user = Profile::where('user_id', Auth::id())->first();

        if(!$request->file('image'))
        {
            $user->update([
                'name' => $request->user_name,
                'post_code' => $request->post_code,
                'address' => $request->address,
                'building_name' => $request->building_name,
                'image' => $user->image
            ]);

            return redirect('/');
        }

        $user_image = $user->image;
        $path = substr($user_image, 20, 50);
        Storage::disk('public')->delete('user_images/'.$path);

        $file_extension = $request->file('image')->getClientOriginalExtension();

        $user_image = $request->file('image')->storeAs('public/user_images', 'user_'.Auth::id().'.'.$file_extension);

        Profile::where('user_id', Auth::id())->update([
            'name' => $request->user_name,
            'post_code' => $request->post_code,
            'address' => $request->address,
            'building_name' => $request->building_name,
            'image' => 'storage/user_images/user_'.Auth::id().'.'.$file_extension
        ]);

        return redirect('/');
    }

    public function mylist()
    {
        $my_nices = Nice::with('item')->where('user_id', Auth::id())->get();

        return view('item_mylist', compact('my_nices'));
    }

    public function list_none()
    {
        return view('list_none');
    }
}
