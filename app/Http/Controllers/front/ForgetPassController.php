<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;

use App\Http\Controllers\SmsController;
use App\Http\Requests\Front\user\ForgetPassRequest;
use App\Http\Requests\Front\user\resetPasswordRequest;
use App\Mail\ConfirmCode;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class ForgetPassController extends Controller
{


// =========== reset password ===========================
    public function forget_pass(ForgetPassRequest $request)
    {
        $user = User::where('mobile', $request->mobile)->first();

        if (!$user) {
            return back()->with('error', trans('messages.messages.invalid_mobile'));
        }

        $code = create_rand_numbers();

        $user->update(['reset_password_code' => $code]);
        SmsController::send_sms(($request->mobile), trans('messages.activation_code_is', ['code' => $code]));
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








/// send rest by email ????

//public function forget_pass(ForgetPassRequest $request)
//{
//    $user = User::where('email', $request->email)->first();
//
//    if (!$user) {
//        return back()->with('error', trans('messages.invalid_email'));
//    }
//
////        if ($user->is_active != 'active') return back()->with('error', 'عفوا هذا الحساب غير مفعل من قبل الادارة');
//
//    $code = create_rand_numbers();
//
//    $user->update(['reset_password_code' => $code]);
//
//    Mail::to($request->email)->send(new ConfirmCode($code));
//
//    Log::info($code);
//    return redirect()->route('front.reset-code-page', $request->email);
////        return view('front.auth.resetCodePage', compact('email'));
//}











// ======= test =======
//public function checkCode(Request $request)
//{
////        if ($request->code1 == null || $request->code2 == null || $request->code3 == null || $request->code4 == null)
////            return back()->with('error', trans('messages.activation_code_required'));
////
////        $code = $request->code4 . $request->code3 . $request->code2 . $request->code1;
////
////        $user = User::where('activation_code', $code)->first();
//}
