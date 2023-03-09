<?php

namespace App\Http\Controllers\front\person;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SmsController;
use App\Http\Requests\Front\RegisterRequest;
use App\Mail\ConfirmCode;
use App\Models\Country;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Facades\JWTAuth;

//use apimatic/unifonicnextgen;


class PersonController extends Controller
{
    public function show_register_person()
    {
        $data['countries'] = Country::all();
        return view('front.auth.register_person', $data);
    }

    public function register_person(RegisterRequest $request)
    {
        $code = random_int(0000, 9999);
        DB::beginTransaction();
        try {
            $request_data = $request->except(['image', 'phone_code', 'mobile']);
//            $country=Country::where('phone_code',$request->phone_code)->first();
//            if ($request->mobile) {
//                $request_data['mobile'] =$request->phone_code. $request->mobile ;
//            }
            $country = Country::find($request->country_id);

            if ($request->mobile) {
                $request_data['mobile'] = $country->phone_code . $request->mobile;
            }

            if (User::where('mobile', $request_data['mobile'])->first()) {
                return back()->with('error', 'قيمة الجوال مستخدمة من قبل');
            }

            $user = User::create($request_data + ['activation_code' => $code, 'send_at' => now(), 'is_accepted' => '1', 'type' => 'buyer', 'country_id' => $country->id]);
            if ($user) {
                $jwt_token = JWTAuth::fromUser($user);
                Token::create(['jwt' => $jwt_token, 'user_id' => $user->id,]);
            }

dd(env('AWS_SES_ACCESS_KEY_ID'));
            if ($request->activation_by == 'email') {
                Mail::to('elshenaweymona92@gmail.com')->send(new ConfirmCode());

//                Mail::to($request->email)->send(new ConfirmCode($code));
            }


//            if ($request->activation_by == 'mobile') {
//                SmsController::sendSms(($request_data['mobile']), trans('messages.activation_code_is', ['code' => $code]));
//            }
//


//            SmsController::sendSms(($request->mobile), trans('messages.activation_code_is', ['code' => $code]));
            DB::commit();

//            SmsController::send_sms(removePhoneZero($request->mobile,'966'), trans('messages.activation_code_is', ['code' => $code]));
            return redirect()->route('front.show_activation', $request_data['mobile']);
        } catch (\Exception $e) {
            return back();
        }
    }
}
