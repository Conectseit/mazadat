<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PARENT_API;
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

        DB::beginTransaction();
        try {
            $request_data = $request->except(['image','commercial_register_image']);

            if ($request->image) {
                $request_data['image'] = $request_data['image'] =  uploaded($request->image,'user');
            }
            if ($request->commercial_register_image) {
                $request_data['commercial_register_image'] = $request_data['commercial_register_image'] =  uploaded($request->commercial_register_image,'user');
            }

//            if ($request->image) $request_data['image'] =  uploaded($request->image, 'user');
//            if ($request->commercial_register_image) $request_data['commercial_register_image'] =  uploaded($request->commercial_register_image, 'user');

            $user = User::create($request_data + ['type' => 'buyer']);
            if ($user) {
                $jwt_token = JWTAuth::fromUser($user);
                Token::create(['jwt' => $jwt_token, 'user_id' => $user->id,]);
            }

            DB::commit();
            return responseJson('200', trans('api.register_user_successfully'), new AuthResource($user)); //OK
        } catch (\Exception $e) {
            return responseJson('500', $e->getMessage());
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            if (!$token = JWTAuth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return responseJson('400', trans('api.sorry_invalid_email_or_password'), []);
            }
            $user = auth()->user();
            if ($user->is_accepted == 0) {
                return responseJson('403', trans('api.please_wait_your_account_not_activated_yet'), []);
            }

            auth()->user()->token->update(['jwt' => $token]);
            return responseJson('200', trans('api.login_successfully'), new AuthResource(auth()->user()));  //OK
        } catch (\Exception $e) {
            return responseJson('500', $e->getMessage(), []);
        }
    }


    public function logout(Request $request)
    {
        auth()->user()->token->update(['jwt' => '']);
        auth()->logout();
        return responseJson('200', trans('api.logout_successfully'), []); //OK
    }


    public function showProfile()
    {
        return responseJson('200', trans('api.user_profile'), new AuthResource(auth('api')->user()));  //OK
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
         $request_data = $request->except(['image']);
        if ($request->image) {
            $request_data['image'] = $request_data['image'] =  uploaded($request->image,'user');
        }
        $user = $request->user();
        if (!$user) {
            return responseJson('400', 'The user has been found but it is not a buyer...', []); //BAD_REQUEST
        }
        $user->update($request_data);
//        $user->update($request->only(['full_name', 'user_name', 'email', 'mobile', 'password']));
        return responseJson('200', trans('api.request_done_successfully'), new AuthResource($user)); //ACCEPTED
    }







    public function add_additional_contact(AdditionalContactRequest $request)
    {
        $user=auth()->user();
        if (!$user) {
            return responseJson('400', 'The user has been found but it is not a buyer...', []); //BAD_REQUEST
        }
        $request_data = $request->all();
//        $request_data['user_id'] = auth()->user()->id;
        $additional_contact = AdditionalUserContact::create($request_data + ['user_id' => $user->id]);
        return responseJson('200', trans('api.request_done_successfully'),$additional_contact); //ACCEPTED
    }





    public function changepassword(ChangePasswordRequest $request){

        if (auth()->check()) {
            if (\Hash::check($request->current_password, auth()->user()->password)) {
                $user = auth()->user();
                $user->update(['password' => $request->password]);
                return responseJson('200', trans('api.updated_successfully'),[]); //ACCEPTED
            } else {
                return responseJson('400', trans('api.wrong_old_password'),[]); //ACCEPTED
            }
        }
    }







//    public function updateProfileImage(UpdateProfileImageRequest $request)
//    {
//        $user = $request->user();
//        if (!$user) {
//            return responseJson('400', 'The user has been found but it is not a buyer...', []); //BAD_REQUEST
//        }
////            File::delete('uploads/users/' . $request->image);
////                unlink('uploads/users/' . $request->image);
//        $request['image'] = uploaded($request->image, 'user');
//
//        $user->update($request->only('image'));
//        return responseJson('200', trans('api.request_done_successfully'), new AuthResource($user)); //ACCEPTED
//    }







//    /**
//     * Create a new AuthController instance.
//     *
//     * @return void
//     */
//    public function __construct()
//    {
//        $this->middleware('auth:api', ['except' => ['login', 'register']]);
//    }
//
//    /**
//     * Get a JWT via given credentials.
//     *
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function login(Request $request)
//    {
//        $validator = Validator::make($request->all(), [
//            'email' => 'required|email',
//            'password' => 'required|string|min:6',
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json($validator->errors(), 422);
//        }
//
//        if (!$token = Auth::guard('api')->attempt($validator->validated())) {
//            return response()->json(['error' => 'Unauthorized'], 401);
//        }
//
//        return $this->createNewToken($token);
//    }
//
//    /**
//     * Register a User.
//     *
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function register(Request $request)
//    {
//        $validator = Validator::make($request->all(), [
//            'full_name' => 'required|string|between:2,100',
//            'email' => 'required|string|email|max:100|unique:users',
//            'password' => 'required|string|confirmed|min:6',
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json($validator->errors()->toJson(), 400);
//        }
//
//        $user = User::create(array_merge(
//            $validator->validated(),
//            ['password' => $request->password]
//        ));
//
//        return response()->json([
//            'message' => 'User successfully registered',
//            'user' => $user
//        ], 201);
//    }
//
//
//    /**
//     * Log the user out (Invalidate the token).
//     *
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function logout()
//    {
//        auth()->logout();
//
//        return response()->json(['message' => 'User successfully signed out']);
//    }
//
//    /**
//     * Refresh a token.
//     *
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function refresh()
//    {
//        return $this->createNewToken(auth()->refresh());
//    }
//
//    /**
//     * Get the authenticated User.
//     *
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function userProfile()
//    {
//        return response()->json(auth()->user());
//    }
//
//    /**
//     * Get the token array structure.
//     *
//     * @param string $token
//     *
//     * @return \Illuminate\Http\JsonResponse
//     */
//    protected function createNewToken($token)
//    {
//        return response()->json([
//            'access_token' => $token,
//            'token_type' => 'bearer',
//            'expires_in' => auth()->factory()->getTTL() * 60,
//            'user' => auth()->user()
//        ]);
//    }

}
