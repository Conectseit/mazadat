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
use App\Http\Requests\Api\RegisterUserRequest;
use App\Http\Requests\Api\ResetPasswordRequest;
use App\Http\Requests\Api\UpdatePersonalImageRequest;
use App\Http\Requests\Api\UpdateProfileRequest;
use App\Http\Requests\Api\VerficationTokenRequest;
use App\Http\Resources\Api\AuthResource;
use App\Models\AdditionalUserContact;
use App\Models\PasswordReset;
use App\Models\Token;
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

    public function register(RegisterUserRequest $request)
    {
        $activation_code = random_int(0000, 9999);

        DB::beginTransaction();
        try {
            $request_data = $request->except(['image', 'commercial_register_image']);

//            if ($request->image) {
//                $request_data['image'] = $request_data['image'] = uploaded($request->image, 'user');
//            }
            if ($request->commercial_register_image) {
                $request_data['commercial_register_image'] = $request_data['commercial_register_image'] = uploaded($request->commercial_register_image, 'user');
            }
            $user = User::create($request_data + ['activation_code' => $activation_code,'country_id'=>'1']);
            if ($user) {
                $jwt_token = JWTAuth::fromUser($user);
                Token::create(['jwt' => $jwt_token, 'user_id' => $user->id,]);
            }
            DB::commit();

//            SmsController::send_sms(removePhoneZero($request->mobile,'966'), trans('messages.activation_code_is', ['code' => $activation_code]));

            return responseJson(true, trans('api.please_check_your_mobile_activation_code_has_sent')); //OK
        } catch (\Exception $e) {
            return responseJson(false, $e->getMessage());
        }
    }


    public function activation(ActivationCodeRequest $request)
    {
//        $user = User::where(['mobile' => $request->mobile])->first();
//        if (!$user) {
//            return responseJson(false, trans('api.The_user_not_found'), null); //BAD_REQUEST
//        }

        $user = User::where('activation_code', $request->activation_code)->first();
        if ($user) {
            $user->update(['is_active' => 'active']);
            return responseJson(true, trans('api.activation_done'), null);  //OK
        }
        return responseJson(false, trans('api.sorry_wrong_activation_code_try_again'), null);

    }


    public function login(LoginRequest $request)
    {
        try {
            if (!$token = JWTAuth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return responseJson(false, trans('api.sorry_invalid_email_or_password'), null);
            }
            $user = auth()->user();
            if ($user->is_active == 'deactive') {
                return responseJson(false, trans('api.please_active_your_account_by_activation_code_first'), null);
            }
            if ($user->is_accepted == 0) {
                return responseJson(false, trans('api.please_wait_your_account_not_activated_yet'), null);
            }
            auth()->user()->token->update(['jwt' => $token]);
            return responseJson(true, trans('api.login_successfully'), new AuthResource(auth()->user()));  //OK
        } catch (\Exception $e) {
            return responseJson('500', $e->getMessage(), null);
        }
    }


    public function logout(Request $request)
    {
        auth()->user()->token->update(['jwt' => '']);
        auth()->logout();
        return responseJson(true, trans('api.logout_successfully'), null); //OK
    }


    public function showProfile()
    {
        $user = auth()->user();
        if (!$user) {
            return responseJson(false, trans('api.The_user_not_found'), null); //BAD_REQUEST
        }
        return responseJson(true, trans('api.user_profile'), new AuthResource($user));  //OK
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $request_data = $request->except(['commercial_register_image']);
        if ($request->commercial_register_image) {
            $request_data['commercial_register_image'] = $request_data['commercial_register_image'] = uploaded($request->commercial_register_image, 'user');
        }
        $user = $request->user();
        if (!$user) {
            return responseJson(false, 'The user has been found but it is not a buyer...', null); //
        }
        $user->update($request_data);
//        $user->update($request->only(['full_name', 'user_name', 'email', 'mobile', 'password']));
        return responseJson(true, trans('api.request_done_successfully'), new AuthResource($user)); //ACCEPTED
    }

    public function update_personal_image(UpdatePersonalImageRequest $request)
    {
        $request_data = $request->except(['image']);
        if ($request->image) {
            $request_data['image'] = $request_data['image'] = uploaded($request->image, 'user');
        }
        $user = $request->user();
        if (!$user) {
            return responseJson(false, 'The user has been found but it is not a buyer...', null); //
        }
        $user->update($request_data);

        return responseJson(true, trans('api.request_done_successfully'), new AuthResource($user)); //ACCEPTED
    }


    public function add_additional_contact(AdditionalContactRequest $request)
    {
        $user = auth()->user();
        if (!$user) {
            return responseJson(false, 'The user has been found but it is not a buyer...', null); //BAD_REQUEST
        }
        $request_data = $request->all();
        if($request_data!=null){
            $additional_contact = AdditionalUserContact::create($request_data + ['user_id' => $user->id]);
            return responseJson(true, trans('api.added_successfully'), $additional_contact); //ACCEPTED
        }
        else
            return responseJson(false, trans('api.no_document_added'), null); //ACCEPTED

//        $request_data['user_id'] = auth()->user()->id;
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


    public function forget_password(ForgetPasswordRequest $request)
    {
        $token = $this->generateRandomString(5);

        $resetModel = PasswordReset::create(['email' => $request['email'], 'token' => $token]);

        if(App::environment('production')) $this->sendResetLinkEmail($resetModel['email'], $resetModel['token']);

        Log::info($token);

        $data = ['token' =>  $resetModel['token'],];
        return responseJson(true, trans('api.send_token'), $data); //
    }

    public function sendResetLinkEmail($email, $token)
    {
        ini_set('max_execution_time', 300); //300 seconds = 5 minutes
        $data = array('token' => $token);
        Mail::send('mails.reset', $data, function ($message) use ($email) {
            $message->to($email)->subject('تطبيق  | Reset Password');
            $message->from(env('MAIL_FROM_ADDRESS'), 'تطبيق  Mazadat');
        });
    }


    public function verify(VerficationTokenRequest $request)
    {
        if (PasswordReset::where(['email' => $request['email'], 'token' => $request['token']])->first())
        {
            return responseJson(true, trans('api.updated_successfully'), null); //
        }
        return responseJson(false, trans('api.wrong_code'), null); //

    }
    public function passwordReset(ResetPasswordRequest $request)
    {
        if (PasswordReset::where(['email' => $request['email']])->first())
        {
            $user = User::where('email', $request['email'])->first();
            $user->update(['password' => $request['password']]);
            return responseJson(true, trans('api.updated_successfully'), null); //
        }
        return responseJson(false, trans('api.wrong_'), null); //

    }


    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


}
