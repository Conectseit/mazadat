<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\ComplteProfileRequest;
use App\Http\Requests\Front\updatePersonalBioRequest;
use App\Http\Requests\Front\updatePersonalImageRequest;
use App\Http\Requests\Front\updateProfileRequest;
use App\Http\Requests\Front\user\AvailableLimitRequest;
use App\Http\Requests\Front\user\UploadDocumentRequest;
use App\Http\Requests\Front\user\UploadPassportRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Document;
use App\Models\Nationality;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showProfile()
    {
        $data['user'] = User::where('id', auth()->user()->id)->first();
        return view('front.user.my_profile', $data);
    }

    public function user_documents()
    {
        return view('front.user.user_documents');
    }
    public function user_passport()
    {
        return view('front.user.user_passport');
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

    public function uploadPassport(uploadPassportRequest $request)
    {
        $request_data = $request->except(['passport_image']);
        if ($request->passport_image) {
            $request_data['passport_image'] = $request_data['passport_image'] = uploaded($request->passport_image, 'user');
        }
        $user = auth()->user();
        $user->update($request_data);
        return back()->with('success', trans('messages.upload_passport_success'));
    }
    public function uploadDocuments(UploadDocumentRequest $request)
    {
        $request_data = $request->except(['front_side_image', 'back_side_image']);
        if ($request->front_side_image) {
            $request_data['front_side_image'] = $request_data['front_side_image'] = uploaded($request->front_side_image, 'user');
        }
        $user = auth()->user();
        $document = Document::create($request_data + ['user_id' => $user->id]);
        return back()->with('success', trans('messages.upload_document_success'));
    }

//    public function update_personal_bio(updatePersonalBioRequest $request)
//    {
//        $user = auth()->user();
//        $user->update($request->all());
//        return back()->with('success', trans('messages.updated_success'));
//    }




    public function editProfile()
    {
        $data['nationalities'] = Nationality::all();
        $data['cities'] = City::all();
        $data['countries'] = Country::all();
        return view('front.user.edit_profile',$data);
    }
    public function completeProfile(ComplteProfileRequest $request)
    {
        $user = auth()->user();
        $user->update($request->all());
        return back()->with('success', trans('messages.updated_success'));
    }
    public function updateProfile(updateProfileRequest $request)
    {
//        $request_data = $request->except(['password', 'password_confirmation', 'submit']);

        $user = auth()->user();
        $user->update($request->all());
        return back()->with('success', trans('messages.updated_success'));
    }











    public function choose_available_limit(AvailableLimitRequest$request)
    {
        $user = auth()->user();
        if ($request->available_limit > $user->wallet) {
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
