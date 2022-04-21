<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PARENT_API;
use App\Http\Controllers\SmsController;
use App\Http\Requests\Api\ActivationCodeRequest;
use App\Http\Requests\Api\AdditionalContactRequest;
use App\Http\Requests\Api\ChangePasswordRequest;
use App\Http\Requests\Api\ForgetPasswordRequest;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\ResetPasswordRequest;
use App\Http\Requests\Api\user\AddAddressRequest;
use App\Http\Requests\Api\user\ResendSmsRequest;
use App\Http\Requests\Api\VerficationTokenRequest;
use App\Http\Resources\Api\auth\AdditionalAddressResource;
use App\Http\Resources\Api\auth\PersonResource;
use App\Http\Resources\Api\AuthResource;
use App\Models\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;


class AuthController extends PARENT_API
{


    public function resendSms(ResendSmsRequest $request)
    {

        $user = User::where('mobile', $request->mobile)->first();
        if (!$user) {
            return responseJson(false, 'The user not found...', null); //
        }
        $activation_code = create_rand_numbers();

        $user->update(['activation_code' => $activation_code,'send_at'=>now()]);

        SmsController::send_sms(($request->mobile), trans('messages.activation_code_is', ['code' => $activation_code]));

        return responseJson(true, trans('api.please_check_your_mobile_activation_code_has_Resend'), $activation_code); //OK


    }


    public function addAddress(AddAddressRequest $request)
    {
        $user = $request->user();
        if (!$user) {
            return responseJson(false, 'The user not found...', null); //
        }
        $user->update($request->all());
        return responseJson(true, trans('api.request_done_successfully'), null);
    }

    public function additionalAddress(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return responseJson(false, 'The user not found...', null); //
        }
        return responseJson(true, trans('api.additional_address'), new AdditionalAddressResource($user));  //OK

    }


    public function activation(ActivationCodeRequest $request)
    {
//        $user = User::where(['mobile' => $request->mobile])->first();
//        if (!$user) {
//            return responseJson(false, trans('api.The_user_not_found'), null); //BAD_REQUEST
//        }

        $user = User::where('activation_code', $request->activation_code)->first();
        if ($user) {
            $user->update(['is_active' => 'active', 'activation_code' => '']);
            return responseJson(true, trans('api.activation_done'), null);  //OK
        }
        return responseJson(false, trans('api.sorry_wrong_activation_code_try_again'), null);

    }


    public function login(LoginRequest $request)
    {
        try {
//            $col = self::is_email($request->email) ? 'email' : 'user_name';
            $col = self::is_email($request->email) ? 'email' : 'mobile';

            if (!$token = JWTAuth::attempt([$col => $request->email, 'password' => $request->password])) {
                return responseJson(false, trans('api.sorry_invalid_email_or_password'), null);
            }
            $user = auth()->user();
            if ($user->ban == 1) {
                return responseJson(false, trans('api.sorry_your_account_is_baned_from_admin_contact_with_customer_service_team'), null);
            }
            if ($user->is_active == 'deactive') {
                return responseJson(true, trans('api.please_active_your_account_by_activation_code_first'), new AuthResource(auth()->user()));  //OK
            }
            if ($user->is_accepted == 0) {
                return responseJson(false, trans('api.please_wait_until_admin_accept_your_data_yet'), null);
            }

//            if ($user->is_completed == 0) {
//                return responseJson(false, trans('api.please_complete_your_account_first'), null);
//            }

//
//            if ($user->is_verified == 0) {
//                return responseJson(false, trans('api.please_wait_your_account_not_verified_to_participate_yet'), null);
//            }

            auth()->user()->token->update(['jwt' => $token, 'fcm' => $request->fcm]);
            return responseJson(true, trans('api.login_successfully'), new AuthResource(auth()->user()));  //OK
        } catch (\Exception $e) {
            return responseJson('500', $e->getMessage(), null);
        }
    }

    public function is_email($value)
    {
//        return preg_match('/^([a-zA-Z0-9_.]*)@.*\.com$/i', $value);
        return preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i', $value);
    }


    public function logout(Request $request)
    {
        auth()->user()->token->update(['jwt' => '', 'fcm' =>null]);

        auth()->logout();
        return responseJson(true, trans('api.logout_successfully'), null); //OK
    }


    public function changePassword(ChangePasswordRequest $request)
    {
        if (auth()->check()) {
            if (\Hash::check($request->current_password, auth()->user()->password)) {
                $user = auth()->user();
                $user->update(['password' => $request->password]);
                return responseJson(true, trans('api.updated_successfully'), null); //ACCEPTED
            } else {
                return responseJson(false, trans('api.wrong_old_password'), null); //ACCEPTED
            }
        }
    }


// ====================== forget_password ============================
    public function forget_password(ForgetPasswordRequest $request)
    {

        $user = User::where('mobile', $request->mobile)->first();
        $code = create_rand_numbers();

        $user->update(['reset_password_code' => $code]);
        SmsController::send_sms(($request->mobile), trans('messages.activation_code_is', ['code' => $code]));
        return responseJson(true, trans('api.send_token'), $code); //
    }


    public function verify(VerficationTokenRequest $request)
    {

        if ($user = User::where('reset_password_code', $request->code)->first()) {
            auth()->login($user);
            return responseJson(true, trans('api.updated_successfully'), null); //
        }
        return responseJson(false, trans('api.wrong_code'), null); //
    }


    public function passwordReset(ResetPasswordRequest $request)
    {
        $user = User::where('mobile', $request['mobile'])->first();
        $user->update(['password' => $request['password']]);

        return responseJson(true, trans('api.updated_successfully'), null); //

    }



//    public function forget_password(ForgetPasswordRequest $request)
//    {
//        $token = $this->generateRandomString(5);
//
//        $resetModel = PasswordReset::create(['email' => $request['email'], 'token' => $token]);
//
//        if(App::environment('production')) $this->sendResetLinkEmail($resetModel['email'], $resetModel['token']);
//
//        Log::info($token);
//
//        $data = ['token' =>  $resetModel['token'],];
//        return responseJson(true, trans('api.send_token'), $data); //
//    }


//    public function sendResetLinkEmail($email, $token)
//    {
//        ini_set('max_execution_time', 300); //300 seconds = 5 minutes
//        $data = array('token' => $token);
//        Mail::send('mails.reset', $data, function ($message) use ($email) {
//            $message->to($email)->subject('تطبيق  | Reset Password');
//            $message->from(env('MAIL_FROM_ADDRESS'), 'تطبيق  Mazadat');
//        });
//    }


//    public function verify(VerficationTokenRequest $request)
//    {
////        if (PasswordReset::where(['email' => $request['email'], 'token' => $request['token']])->first())
//        if (PasswordReset::where([ 'token' => $request['token']])->first())
//        {
////            \DB::table('password_resets')->where(['email' => $request->email ])->delete();
//
//            return responseJson(true, trans('api.updated_successfully'), null); //
//        }
//        return responseJson(false, trans('api.wrong_code'), null); //
//    }


//    public function passwordReset(ResetPasswordRequest $request)
//    {
//        if (PasswordReset::where(['email' => $request['email']])->first()) {
//            $user = User::where('email', $request['email'])->first();
//            $user->update(['password' => $request['password']]);
//            return responseJson(true, trans('api.updated_successfully'), null); //
//
//        }
//        return responseJson(false, trans('api.wrong_'), null); //
//
//    }


//    function generateRandomString($length = 10)
//    {
//        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//        $charactersLength = strlen($characters);
//        $randomString = '';
//        for ($i = 0; $i < $length; $i++) {
//            $randomString .= $characters[rand(0, $charactersLength - 1)];
//        }
//        return $randomString;
//    }


}

//
//    public function update_personal_image(UpdatePersonalImageRequest $request)
//    {
//        $request_data = $request->except(['image']);
//        if ($request->image) {
//            $request_data['image'] = $request_data['image'] = uploaded($request->image, 'user');
//        }
//        $user = $request->user();
//        if (!$user) {
//            return responseJson(false, 'The user has been found but it is not a buyer...', null); //
//        }
//        $user->update($request_data);
//
//        return responseJson(true, trans('api.request_done_successfully'), new AuthResource($user)); //ACCEPTED
//    }


//public function add_additional_contact(AdditionalContactRequest $request)
//{
//    $user = auth()->user();
//    if (!$user) {
//        return responseJson(false, 'The user has been found but it is not a buyer...', null); //BAD_REQUEST
//    }
//    $request_data = $request->all();
//    if($request_data!=null){
//        $additional_contact = AdditionalUserContact::create($request_data + ['user_id' => $user->id]);
//        return responseJson(true, trans('api.added_successfully'), $additional_contact); //ACCEPTED
//    }
//    else
//        return responseJson(false, trans('api.no_document_added'), null); //ACCEPTED
//
////        $request_data['user_id'] = auth()->user()->id;
//}
