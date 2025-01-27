<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Item;
use App\Models\Nice;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\AddressRequest;
use App\Models\Comment;

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

    public function set_up(ProfileRequest $request)
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
        $profile = Profile::where('user_id', $request->id)->exists();

        if(!$profile)
        {
            return redirect('/mypage/profile');
        }

        $user = Profile::where('user_id', $request->id)->first();

        $items = Item::where('user_id', Auth::id())->get();

        return view('mypage', compact('user', 'items'));
    }

    public function update(AddressRequest $request)
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
        $path = substr($user_image, 20);
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

    public function list_none(Request $request)
    {
        return view('item_all');
    }

    public function comment(Request $request)
    {
        $comment = Comment::with('user', 'item')->where('user_id', Auth::id())->where('item_id', $request->item_id)->exists();

        if($comment)
        {
            return back()->with('message', 'コメント済みです');
        }

        Comment::create([
            'user_id' => Auth::id(),
            'item_id' => $request->item_id,
            'comment' => $request->comment
        ]);

        return back();
    }

    public function address_change(AddressRequest $request)
    {
        $item = Item::find($request->item_id)->first();
        $user = Profile::where('user_id', Auth::id())->first();
        $user->update([
            'post_code' => $request->post_code,
            'address' => $request->address,
            'building_name' => $request->building_name
        ]);

        return view('purchase', compact('item', 'user'));
    }
}
