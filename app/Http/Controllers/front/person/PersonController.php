<?php

namespace App\Http\Controllers\front\person;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SmsController;
use App\Http\Requests\Front\RegisterRequest;
use App\Models\Country;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class PersonController extends Controller
{
    public function show_register_person()
    {
        $data['countries'] = Country::all();
        return view('front.auth.register_person', $data);
    }
    public function register_person(RegisterRequest $request)
    {
        $activation_code = random_int(0000, 9999);
        DB::beginTransaction();
        try {
            $request_data = $request->except(['image','phone_code','mobile']);
//            $country=Country::where('phone_code',$request->phone_code)->first();
//            if ($request->mobile) {
//                $request_data['mobile'] =$request->phone_code. $request->mobile ;
//            }
            $country=Country::find($request->country_id);
            if ($request->mobile) {
                $request_data['mobile'] =$country->phone_code. $request->mobile ;
            }

            if (User::where('mobile', $request_data['mobile'])->first()) {
                return back()->with('error', 'قيمة الجوال مستخدمة من قبل');
            }

            $user = User::create($request_data + ['activation_code' => $activation_code,'send_at'=>now(), 'is_accepted'=>'1', 'type'=>'buyer','country_id'=>$country->id]);
            if ($user) {
                $jwt_token = JWTAuth::fromUser($user);
                Token::create(['jwt' => $jwt_token, 'user_id' => $user->id,]);
            }
            DB::commit();
            SmsController::send_sms(($request->mobile), trans('messages.activation_code_is', ['code' => $activation_code]));

//            SmsController::send_sms(removePhoneZero($request->mobile,'966'), trans('messages.activation_code_is', ['code' => $activation_code]));
            return redirect()->route('front.show_activation', $request_data['mobile']);
        } catch (\Exception $e) {
            return back();
        }
    }
}




//            $user = User::where('mobile', $request->mobile)->first();
//            if ($user) return back()->withInput($request->only('mobile'))->with('error', 'عفوا رقم الجوال مسجل من قبل');
//
//            $user = User::where('email', $request->email)->first();
//            if ($user) return back()->withInput($request->only('email'))->with('error', 'عفوا الايميل  مسجل من قبل');
