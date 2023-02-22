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
use Illuminate\Support\Facades\Http;
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


//
//            $body = trans('messages.activation_code_is'( $activation_code));
//
//            $recipient = (int) ($request_data['mobile']);
//            $appSid = config('sms.unifonic.app_sid');
//            $senderID = config('sms.unifonic.sender');
//            $username = config('sms.unifonic.username');
//            $password = config('sms.unifonic.password');
//            $client = new UnifonicNextGenClient($username, $password);
//
//
//            $response = $client->getRest()->createSendMessage($appSid, $senderID, $body, $recipient);





//            Http::get("http://api.unifonic.com/wrapper/sendSMS.php?userid=admin&password=pass&msg={$activation_code}&sender=f&to={$request_data['mobile']}&encoding=utf-8”)->throw();




            SmsController::sendSms(($request_data['mobile']), trans('messages.activation_code_is', ['code' => $activation_code]));

//            SmsController::sendSms(($request->mobile), trans('messages.activation_code_is', ['code' => $activation_code]));
            DB::commit();

//            SmsController::send_sms(removePhoneZero($request->mobile,'966'), trans('messages.activation_code_is', ['code' => $activation_code]));
            return redirect()->route('front.show_activation', $request_data['mobile']);
        } catch (\Exception $e) {
            return back();
        }
    }
}
