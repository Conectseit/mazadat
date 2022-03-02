<?php

namespace App\Http\Controllers\front\company;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SmsController;
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
        $data['countries'] = Country::all();
//        $data['nationalities'] = Nationality::all();
        return view('front.auth.register_company', $data);
    }

    public function register_company(RegisterCompanyRequest $request)
    {
        $activation_code = random_int(0000, 9999);
        DB::beginTransaction();
        try {
            $request_data = $request->except(['phone_code','mobile','commercial_register_image','company_authorization_image']);
            $country=Country::find($request->country_id);

            if(!$country) return back()->with('error','عفوا كود الدولة غير صحيح');

            if ($request->hasFile('commercial_register_image')) {
                $request_data['commercial_register_image'] = uploaded($request->commercial_register_image, 'user');
            }
            if ($request->hasFile('company_authorization_image')) {
                $request_data['company_authorization_image'] = uploaded($request->company_authorization_image, 'user');
            }

            if ($request->mobile) {
                $request_data['mobile'] =$request->phone_code. $request->mobile ;
            }
            $user = User::create($request_data + ['activation_code' => $activation_code,'type'=>'buyer','is_appear_name'=>1,'is_company'=>'company','accept_app_terms'=>'yes',]);
//            if ($user) {
//                $jwt_token = JWTAuth::fromUser($user);
//                Token::create(['jwt' => $jwt_token, 'user_id' => $user->id,
////                    'fcm_web_token'=>$request->fcm_web_token
//                ]);
//            }
            DB::commit();
//            SmsController::send_sms(($request->mobile), trans('messages.activation_code_is', ['code' => $activation_code]));
            return redirect()->route('front.show_activation');
        } catch (\Exception $e) {
            return redirect()->route('front.show_activation');
        }
    }

}
