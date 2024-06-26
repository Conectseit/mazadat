<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;

use App\Http\Controllers\SmsController;
use App\Http\Requests\Front\user\ForgetPassRequest;
use App\Http\Requests\Front\user\resetPasswordRequest;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class ForgetPassController extends Controller
{
// =========== reset password ===========================
    public function forget_pass(ForgetPassRequest $request)
    {
        $country = Country::find($request->country_id);
        $request_data['mobile'] = $country->phone_code . $request->mobile;
        
        $user = User::where('mobile', $request_data['mobile'])->first();


        if (!$user) {
            return back()->with('error', trans('messages.messages.invalid_mobile'));
        }

        $code = create_rand_numbers();
        $user->update(['reset_password_code' => $code]);
        $mobile = preg_replace('/^\+/', '',  $user->mobile);
        SmsController::sendSms(($mobile), trans('messages.activation_code_is', ['code' => $code]));

//        MalthSmsController::send_sms(($request->mobile), trans('messages.activation_code_is', ['code' => $code]));
        return redirect()->route('front.reset-code-page', $request->mobile);
    }


    public function resetCodePage($email)
    {
        return view('front.auth.resetCodePage', compact('email'));
    }
    public function checkResetCode(Request $request)
    {
        if (!$request->code) return back()->withInput($request->only('mobile'))->with('error', 'عفوا كود التفعيل مطلوب');

        $user = User::where('reset_password_code', $request->code)->first();

        if (!$user) return back()->withInput($request->only('mobile'))->with('error', 'عفوا الكود التحقق غير صحيح');
        $user->update(['reset_password_code' => null]);
        auth()->login($user);
        return redirect()->route('front.change-password-page');
    }


//    public function resendCode($email)
//    {
//        $user = User::where('email', $email)->first();
//
//        $code = create_rand_numbers();
//
//        $user->update(['reset_code' => $code]);
//
//        Mail::to($email)->send(new ConfirmCode($code));
//
//        return back()->with('success', 'تم إعادة إرسال الكود بنجاح');
//    }

    public function changePasswordPage()
    {
        return view('front.auth.changePass');
    }

    public function resetPassword(resetPasswordRequest $request)
    {
        $user = auth()->user();
        $user->update(['password' => $request->password]);

        auth()->logout();

        return redirect()->route('front.home');
    }

// =========== End reset password =================

}
