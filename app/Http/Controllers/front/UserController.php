<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\ComplteProfileRequest;
use App\Http\Requests\Front\updatePersonalBioRequest;
use App\Http\Requests\Front\updatePersonalImageRequest;
use App\Http\Requests\Front\updateProfileRequest;
use App\Http\Requests\Front\user\AdditionalAddressRequest;
use App\Http\Requests\Front\user\AvailableLimitRequest;
use App\Http\Requests\Front\user\UploadDocumentRequest;
use App\Http\Requests\Front\user\UploadPassportRequest;
use App\Models\AuctionBuyer;
use App\Models\City;
use App\Models\Country;
use App\Models\Document;
use App\Models\Nationality;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserController extends Controller
{
    public function showProfile()
    {
        $data['user'] = User::where('id', auth()->user()->id)->first();
        return view('front.user.my_profile', $data);
    }
    public function showCompleteProfile()
    {
        $data['user'] = User::where('id', auth()->user()->id)->first();
        $data['nationalities'] = Nationality::all();
        $data['cities'] = City::where('country_id',auth()->user()->country_id)->get();
        $data['countries'] = Country::all();
        return view('front.user.complete_profile', $data);
    }


    public function show_account_statement()
    {
        $data['user'] = User::where('id', auth()->user()->id)->first();
        $data['person_bids'] = AuctionBuyer::where('buyer_id',auth()->user()->id)->get();
        return view('front.user.my_account_statement', $data);
    }


    public function show_my_addresses()
    {
        $data['user_addresses'] = UserAddress::where('user_id',auth()->user()->id)->get();
        return view('front.user.my_addresses', $data);
    }



    public function showEditProfile()
    {
//        $data['cities'] = City::where('country_id',auth()->user()->country_id)->get();
        $data['countries'] = Country::all();
        return view('front.user.edit_profile',$data);
    }


    public function completeProfile(ComplteProfileRequest $request)
    {
        $user = auth()->user();
        $request_data = $request->except(['passport_image']);

        if ($request->passport_image) {
            $request_data['passport_image']  = uploaded($request->passport_image, 'user');
        }
        $user->update($request_data+['is_completed'=>1,'is_verified'=>1]);
         return redirect()->route('front.my_profile')->with('success', trans('messages.complete_profile_success'));
    }

    public function updateProfile(updateProfileRequest $request)
    {
        $request_data = $request->except([ 'password', 'password_confirmation','phone_code','mobile','commercial_register_image','company_authorization_image','image','submit']);
        if ($request->mobile) {
            $request_data['mobile'] =$request->phone_code. $request->mobile ;
        }
        if ($request->phone_code) {
            $country=Country::where('phone_code',$request->phone_code)->first();
            $request_data['country_id'] =$country->id ;
        }

//        if ($request->mobile) {
//            $country=Country::find(auth()->user()->country_id);
//
//            $request_data['mobile'] =$country->phone_code. $request->mobile ;
//        }
        if ($request->image) {
            $request_data['image']  = uploaded($request->image, 'user');
        }
        if ($request->hasFile('commercial_register_image')) {
            $request_data['commercial_register_image'] = uploaded($request->commercial_register_image, 'user');
        }
        if ($request->hasFile('company_authorization_image')) {
            $request_data['company_authorization_image'] = uploaded($request->company_authorization_image, 'user');
        }
        if(!is_null($request->password))
        {
            $request_data['password'] = $request->password;
        }
        auth()->user()->update($request_data);
//        $user->update($request_data + ['country_id'=>$country->id]);

        return back()->with('success', trans('messages.updated_success'));
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

    public function show_add_address()
    {
        $data['user'] = User::where('id', auth()->user()->id)->first();
        return view('front.user.show_add_address', $data);
    }
    public function addAddress(AdditionalAddressRequest $request)
    {
        $user = auth()->user();
         UserAddress::create($request->all() + ['user_id' => $user->id]);
        return redirect()->route('front.show_my_addresses')->with('success', trans('messages.added_success'));
    }


// =============== user wallete ===========================================
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




