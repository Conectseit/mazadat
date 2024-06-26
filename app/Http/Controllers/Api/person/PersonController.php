<?php

namespace App\Http\Controllers\Api\person;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SmsController;
use App\Http\Requests\Api\person\CompletePersonProfileRequest;
use App\Http\Requests\Api\person\RegisterUserRequest;
use App\Http\Requests\Api\person\UpdatePersonProfileRequest;
use App\Http\Resources\Api\auth\PersonResource;
use App\Mail\ConfirmCode;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Facades\JWTAuth;

class PersonController extends Controller
{

    public function register_person(RegisterUserRequest $request)
    {
        $code = random_int(0000, 9999);

        DB::beginTransaction();
        try {
            $request_data = $request->except(['image','phone_code','mobile']);

//            if ($request->image) {
//                $request_data['image'] = $request_data['image'] = uploaded($request->image, 'user');
//            }
            if ($request->mobile) {
                $request_data['mobile'] =$request->phone_code. $request->mobile ;
            }

            if (User::where('mobile', $request_data['mobile'])->first()) {
                return responseJson(false, 'قيمة الجوال مستخدمة من قبل', null);  //
            }

            $user = User::create($request_data + ['activation_code' => $code,'send_at'=>now(),'is_accepted'=>1,'type'=>'buyer','is_company'=>'person','accept_app_terms'=>'yes']);

            if ($user) {
                $jwt_token = JWTAuth::fromUser($user);
                Token::create(['jwt' => $jwt_token, 'user_id' => $user->id]);
            }

            DB::commit();

            if ($request->activation_by == 'email') {
                Mail::to($request->email)->send(new ConfirmCode($code));
            }

            if ($request->activation_by == 'mobile') {
                SmsController::sendSms(($request_data['mobile']), trans('messages.activation_code_is', ['code' => $code]));
            }
//            SmsController::sendSms(($request->mobile), trans('messages.activation_code_is', ['code' => $code]));
//            SmsController::send_sms(removePhoneZero($request->mobile,'966'), trans('messages.activation_code_is', ['code' => $code]));

            return responseJson(true, trans('api.please_check_your_mobile_activation_code_has_sent'),$code); //OK

        } catch (\Exception $e) {
            return responseJson(false, $e->getMessage());
        }
    }

    public function person_profile()
    {
        $user = auth()->user();
        if (!$user) {
            return responseJson(false, trans('api.The_user_not_found'), null); //
        }
        if ($user->ban == 1) {
            return responseJson(true, trans('api.user_profile'), new PersonResource($user));  //OK
        }
        return responseJson(true, trans('api.user_profile'), new PersonResource($user));  //OK
    }

    public function update_person_profile(UpdatePersonProfileRequest $request)
    {
        $user = $request->user();

        if (!$user) {
            return responseJson(false, 'The user not found...', null); //
        }
        $request_data = $request->except(['image','phone_code','mobile']);
        if ($request->mobile) {
            $request_data['mobile'] =$request->phone_code. $request->mobile ;
        }
        if ($request->image) {
            $request_data['image']  = uploaded($request->image, 'user');
        }

        if ( $update_user=User::where('mobile', $request_data['mobile'])->first()) {
            if($update_user->id == $user->id) {
                $user->update($request_data +['mobile'=>$request->phone_code. $request->mobile]);
                return responseJson(true, trans('api.request_done_successfully'), new PersonResource($user)); //ACCEPTED
            }
            return responseJson(false, 'قيمة الجوال مستخدمة من قبل', null);  //
        }

        $user->update($request_data+['mobile'=>$request->phone_code. $request->mobile]);
        return responseJson(true, trans('api.request_done_successfully'), new PersonResource($user)); //ACCEPTED

//        $user->update($request->only(['full_name', 'user_name', 'email', 'mobile', 'password']));
    }


    public function completePersonProfile(CompletePersonProfileRequest $request)
    {

        $request_data = $request->except(['passport_image']);

        if ($request->passport_image) {
            $request_data['passport_image']  = uploaded($request->passport_image, 'user');
        }

        $user = $request->user();
        if (!$user) {
            return responseJson(false, 'The user not found...', null); //
        }
        $user->update($request_data+['is_completed'=>1,'is_verified'=>1]);
//        $user->update($request->only(['full_name', 'user_name', 'email', 'mobile', 'password']));
        return responseJson(true, trans('api.request_done_successfully_wait_until_admin_accept_you'), new PersonResource($user)); //ACCEPTED
    }



}
