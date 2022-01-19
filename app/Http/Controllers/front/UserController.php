<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\updatePersonalBioRequest;
use App\Http\Requests\Front\updatePersonalImageRequest;
use App\Http\Requests\Front\updateProfileRequest;
use App\Http\Requests\Front\user\AvailableLimitRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showProfile()
    {
        $data['user'] = User::where('id', auth()->user()->id)->first();
        return view('front.user.my_profile', $data);
    }
    public function editProfile()
    {
        return view('front.user.edit_profile');
    }
    public function update_personal_image(updatePersonalImageRequest $request)
    {
        $request_data = $request->except(['image']);
        if ($request->image) {
            $request_data['image'] = $request_data['image'] = uploaded($request->image, 'user');
        }
        $user = auth()->user();
        $user->update($request_data);
        return back()->with('success', trans('messages.updated_success'));
    }
    public function update_personal_bio(updatePersonalBioRequest $request)
    {
        $user = auth()->user();
        $user->update($request->all());
        return back()->with('success', trans('messages.updated_success'));
    }
    public function updateProfile(updateProfileRequest $request)
    {
        $user = auth()->user();
        $user->update($request->all());
        return back()->with('success', trans('messages.updated_success'));
    }
    public function choose_available_limit(AvailableLimitRequest$request)
    {
        $user = auth()->user();
        if ($request->available_limit >= $user->wallet) {
            return back()->with('error', trans('messages.Sorry_you_cant_increase_more_your_wallet_less_than_this_value'));
        }
        $user->update($request->all());
        return back()->with('success', trans('messages.updated_success'));
    }

    public function my_wallet()
    {
        $data['user'] = User::where('id', auth()->user()->id)->first();
        return view('front.user.my_wallet', $data);
    }

}
