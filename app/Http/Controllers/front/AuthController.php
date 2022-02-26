<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SmsController;
use App\Http\Requests\Front\LoginRequest;
use App\Http\Requests\Front\RegisterCompanyRequest;
use App\Http\Requests\Front\RegisterRequest;
use App\Http\Requests\Front\user\ForgetPassRequest;
use App\Http\Requests\Front\user\resetPasswordRequest;
use App\Mail\ConfirmCode;
use App\Models\City;
use App\Models\Country;
use App\Models\Nationality;
use App\Models\PasswordReset;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function show_register()
    {
        return view('front.auth.register');
    }


    public function show_activation()
    {
        return view('front.auth.activation');
    }

    public function checkCode(Request $request)
    {
        if ($request->activation_code == null)
            return back()->with('error', trans('messages.activation_code_required'));

        $user = User::where('activation_code', $request->activation_code)->first();

        if (!$user) return back()->with('error', trans('messages.wrong_code'));

        if (!$user->update(['activation_code' => null, 'is_active' => 'active'])) return back()->with('error', 'حدث خطا, حاول مره اخري');
        return redirect()->route('front.home')->with('success', trans('messages.register_success_welcome_in_our_website'));
    }

    public function show_login()
    {
        $data['countries'] = Country::all();
        return view('front.auth.login',$data);
    }

    public function login(LoginRequest $request)
    {
        $col = self::is_email($request->email) ? 'email' : 'user_name';

        Auth::attempt([$col => $request->email, 'password' => $request->password]);

        if (!auth()->user()) return back()
//            ->withInput($request->only('email'))
            ->with('error', trans('messages.sorry_invalid_email_or_password'));

        $user = auth()->user();

        if ($user->is_active == 'deactive') {
            Auth::logout();
            return redirect()->route('front.show_activation')
                ->with('error', trans('api.please_active_your_account_by_activation_code_first'));
//            return back()->withInput($request->only('email'))->with('error', trans('api.please_active_your_account_by_activation_code_first'));
        }
        if ($user->is_accepted == 0) {
            Auth::logout();
            return back()->withInput($request->only('email'))->with('error', trans('api.please_wait_your_account_not_activated_yet'));
        }

        if ($user->is_completed == 0 ) {
            return redirect()->route('front.edit_profile')
                ->with('error', trans('api.please_complete_your_account_first'));
        }

        $jwt_token = JWTAuth::fromUser($user);
        auth()->user()->token->update(['jwt' => $jwt_token,'fcm_web_token'=>$request->fcm_web_token]);

        return redirect()->route('front.home');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('front.home');
    }



// =========== reset password ===========================
    public function forget_pass(ForgetPassRequest $request)
    {
        $user = User::where('email', $request->email)->first();

//        if ($user->is_active != 'active') return back()->with('error', 'عفوا هذا الحساب غير مفعل من قبل الادارة');

        $code = create_rand_numbers();

        $user->update(['reset_password_code' => $code]);

        Mail::to($request->email)->send(new ConfirmCode($code));

        Log::info($code);
        return redirect()->route('front.reset-code-page', $request->email);
//        return view('front.auth.resetCodePage', compact('email'));
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
    public function resendCode($email)
    {
        $user = User::where('email', $email)->first();

        $code = create_rand_numbers();

        $user->update(['reset_code' => $code]);

        Mail::to($email)->send(new ConfirmCode($code));

        return back()->with('success', 'تم إعادة إرسال الكود بنجاح');
    }


    public function get_cities_by_country_id(Request $request)
    {
        $country = Country::find($request->country_id);

        if (!$country) return response()->json(['status' => false], 500);

        return response()->json(['cities' => $country->cities, 'status' => true], 200);
    }

    public function is_email($value)
    {
//        return preg_match('/^([a-zA-Z0-9_.]*)@.*\.com$/i', $value);
        return preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i', $value);
    }
}




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
