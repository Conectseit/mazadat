<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PARENT_API;
use App\Http\Controllers\SmsController;
use App\Http\Requests\Api\AdditionalContactRequest;
use App\Http\Requests\Api\ChangePasswordRequest;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterUserRequest;
use App\Http\Requests\Api\UpdateProfileImageRequest;
use App\Http\Requests\Api\UpdateProfileRequest;
use App\Http\Resources\Api\AuthResource;
use App\Models\AdditionalUserContact;
use App\Models\Token;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;


class AuthController extends PARENT_API
{


    public function register(RegisterUserRequest $request)
    {
        $activation_code = random_int(0000, 9999);
        DB::beginTransaction();
        try {
            $request_data = $request->except(['image','commercial_register_image']);

            if ($request->image) {
                $request_data['image'] = $request_data['image'] =  uploaded($request->image,'user');
            }
            if ($request->commercial_register_image) {
                $request_data['commercial_register_image'] = $request_data['commercial_register_image'] =  uploaded($request->commercial_register_image,'user');
            }

            $user = User::create($request_data + ['type' => 'buyer','activation_code'=>$activation_code]);
            if ($user) {
                $jwt_token = JWTAuth::fromUser($user);
                Token::create(['jwt' => $jwt_token, 'user_id' => $user->id,]);
            }

            DB::commit();

            (new SmsController())->send_sms('966'.$request->mobile,trans('messages.activation_code_is'.$activation_code));

            return responseJson('true', trans('api.register_user_successfully'), new AuthResource($user)); //OK
        } catch (\Exception $e) {
            return responseJson('false', $e->getMessage());
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            if (!$token = JWTAuth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return responseJson('false', trans('api.sorry_invalid_email_or_password'), []);
            }
            $user = auth()->user();
            if ($user->is_accepted == 0) {
                return responseJson('403', trans('api.please_wait_your_account_not_activated_yet'), []);
            }

            auth()->user()->token->update(['jwt' => $token]);
            return responseJson('true', trans('api.login_successfully'), new AuthResource(auth()->user()));  //OK
        } catch (\Exception $e) {
            return responseJson('500', $e->getMessage(), []);
        }
    }


    public function logout(Request $request)
    {
        auth()->user()->token->update(['jwt' => '']);
        auth()->logout();
        return responseJson('true', trans('api.logout_successfully'), []); //OK
    }


    public function showProfile()
    {
        $user = auth()->user();
        if (!$user) {return responseJson('false', trans('api.The_user_not_found'), []); //BAD_REQUEST
        }
        return responseJson('true', trans('api.user_profile'), new AuthResource($user));  //OK
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
         $request_data = $request->except(['image']);
        if ($request->image) {
            $request_data['image'] = $request_data['image'] =  uploaded($request->image,'user');
        }
        $user = $request->user();
        if (!$user) {
            return responseJson('false', 'The user has been found but it is not a buyer...', []); //BAD_REQUEST
        }
        $user->update($request_data);
//        $user->update($request->only(['full_name', 'user_name', 'email', 'mobile', 'password']));
        return responseJson('true', trans('api.request_done_successfully'), new AuthResource($user)); //ACCEPTED
    }







    public function add_additional_contact(AdditionalContactRequest $request)
    {
        $user=auth()->user();
        if (!$user) {
            return responseJson('false', 'The user has been found but it is not a buyer...', []); //BAD_REQUEST
        }
        $request_data = $request->all();
//        $request_data['user_id'] = auth()->user()->id;
        $additional_contact = AdditionalUserContact::create($request_data + ['user_id' => $user->id]);
        return responseJson('true', trans('api.request_done_successfully'),$additional_contact); //ACCEPTED
    }





    public function changepassword(ChangePasswordRequest $request){

        if (auth()->check()) {
            if (\Hash::check($request->current_password, auth()->user()->password)) {
                $user = auth()->user();
                $user->update(['password' => $request->password]);
                return responseJson('true', trans('api.updated_successfully'),[]); //ACCEPTED
            } else {
                return responseJson('false', trans('api.wrong_old_password'),[]); //ACCEPTED
            }
        }
    }

}
