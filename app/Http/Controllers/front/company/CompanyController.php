<?php

namespace App\Http\Controllers\front\company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\RegisterCompanyRequest;
use App\Models\Country;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class CompanyController extends Controller
{
    public function show_register_company()
    {
//        $data['cities'] = City::all();
        $data['countries'] = Country::all();
//        $data['nationalities'] = Nationality::all();
        return view('front.auth.register_company', $data);
    }

    public function register_company(RegisterCompanyRequest $request)
    {
        $activation_code = random_int(0000, 9999);
        DB::beginTransaction();
        try {
            $request_data = $request->except(['mobile','commercial_register_image','company_authorization_image']);

            if ($request->commercial_register_image) {
                $request_data['commercial_register_image'] = uploaded($request->commercial_register_image, 'user');
            }
            if ($request->company_authorization_image) {
                $request_data['company_authorization_image'] = uploaded($request->company_authorization_image, 'user');
            }
//            $user = User::where('mobile', $request->mobile)->first();
//            if ($user) return back()->withInput($request->only('mobile'))->with('error', 'عفوا رقم الجوال مسجل من قبل');
//
//            $user = User::where('email', $request->email)->first();
//            if ($user) return back()->withInput($request->only('email'))->with('error', 'عفوا الايميل  مسجل من قبل');



            if ($request->mobile) {
                $request_data['mobile'] =$request->phone_code. $request->mobile ;
            }

            $user = User::create($request_data + ['activation_code' => $activation_code,'type'=>'buyer','is_appear_name'=>1,'is_company'=>'company','accept_app_terms'=>'yes']);

            if ($user) {
                $jwt_token = JWTAuth::fromUser($user);
                Token::create(['jwt' => $jwt_token, 'user_id' => $user->id,'fcm_web_token'=>$request->fcm_web_token
                ]);
            }
            DB::commit();
//            SmsController::send_sms(removePhoneZero($request->mobile,'966'), trans('messages.activation_code_is', ['code' => $activation_code]));
            return redirect()->route('front.show_activation');
        } catch (\Exception $e) {
            return redirect()->route('front.show_activation');
        }
    }

}
