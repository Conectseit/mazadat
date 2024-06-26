<?php

namespace App\Http\Controllers\Api\company;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SmsController;
use App\Http\Requests\Api\company\RegisterCompanyRequest;
use App\Http\Requests\Api\company\UpdateCompanyProfileRequest;
use App\Http\Resources\Api\auth\CompanyResource;
use App\Mail\ConfirmCode;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Facades\JWTAuth;

class CompanyController extends Controller
{
    public function register_company(RegisterCompanyRequest $request)
    {
        $code = random_int(0000, 9999);

        DB::beginTransaction();
        try {
            $request_data = $request->except(['commercial_register_image','company_authorization_image','phone_code','mobile']);

//
            if ($request->commercial_register_image) {
                $request_data['commercial_register_image'] = uploaded($request->commercial_register_image, 'user');
            }
            if ($request->company_authorization_image) {
                $request_data['company_authorization_image'] = uploaded($request->company_authorization_image, 'user');
            }

            if ($request->mobile) {
                $request_data['mobile'] =$request->phone_code. $request->mobile ;
            }

            if (User::where('mobile', $request_data['mobile'])->first()) {
                return responseJson(false, 'قيمة الجوال مستخدمة من قبل', null);  //
            }

            $user = User::create($request_data + ['activation_code' => $code,'send_at'=>now(),'type'=>'buyer','is_appear_name'=>1,'is_company'=>'company','accept_app_terms'=>'yes']);
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

    public function company_profile()
    {
        $user = auth()->user();
        if (!$user) {
            return responseJson(false, trans('api.The_user_not_found'), null); //
        }
        if ($user->ban == 1) {
            return responseJson(true, trans('api.user_profile'), new CompanyResource($user));  //OK
        }
        return responseJson(true, trans('api.user_profile'), new CompanyResource($user));  //OK
    }

    public function update_company_profile(UpdateCompanyProfileRequest $request)
    {

        $user = $request->user();
        if (!$user) {
            return responseJson(false, 'The user not found...', null); //
        }
        $request_data = $request->except(['image','commercial_register_image','company_authorization_image','phone_code','mobile']);
        if ($request->mobile) {
            $request_data['mobile'] =$request->phone_code. $request->mobile ;
        }

        if ($request->image) {
            $request_data['image'] = uploaded($request->image, 'user');
        }
        if ($request->commercial_register_image) {
            $request_data['commercial_register_image'] = uploaded($request->commercial_register_image, 'user');
        }
        if ($request->company_authorization_image) {
            $request_data['company_authorization_image'] = uploaded($request->company_authorization_image, 'user');
        }

        if ( $update_user=User::where('mobile', $request_data['mobile'])->first()) {
            if($update_user->id == $user->id) {
                $user->update($request_data+['is_completed'=>1,'mobile'=>$request->phone_code. $request->mobile]);
                return responseJson(true, trans('api.request_done_successfully'), new CompanyResource($user)); //ACCEPTED
            }
            return responseJson(false, 'قيمة الجوال مستخدمة من قبل', null);  //
        }

        $user->update($request_data+['mobile'=>$request->phone_code. $request->mobile]);
        return responseJson(true, trans('api.request_done_successfully'), new CompanyResource($user)); //ACCEPTED


//        $user->update($request->only(['full_name', 'user_name', 'email', 'mobile', 'password']));
    }





//    public function complete_company_Profile(CompletePersonProfileRequest $request)
//    {
//        $user = $request->user();
//        if (!$user) {
//            return responseJson(false, 'The user not found...', null); //
//        }
//        $user->update($request->all()+['is_completed'=>1]);
//
//        return responseJson(true, trans('api.request_done_successfully'), new CompanyResource($user)); //ACCEPTED
//    }

}
