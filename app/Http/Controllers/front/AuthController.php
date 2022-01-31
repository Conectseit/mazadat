<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SmsController;
use App\Http\Requests\Front\LoginRequest;
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
        $data['cities'] = City::all();
        $data['countries'] = Country::all();
        $data['nationalities'] = Nationality::all();
        return view('front.auth.register', $data);
    }

    public function register(RegisterRequest $request)
    {
        $activation_code = random_int(0000, 9999);
        DB::beginTransaction();
        try {
            $request_data = $request->except(['commercial_register_image']);

            if ($request->commercial_register_image) {
                $request_data['commercial_register_image'] = $request_data['commercial_register_image'] = uploaded($request->commercial_register_image, 'user');
            }
            $user = User::where('mobile', $request->mobile)->first();
            if ($user) return back()->withInput($request->only('mobile'))->with('error', 'عفوا رقم الجوال مسجل من قبل');

            $user = User::where('email', $request->email)->first();
            if ($user) return back()->withInput($request->only('email'))->with('error', 'عفوا الايميل  مسجل من قبل');

            $user = User::create($request_data + ['activation_code' => $activation_code, 'country_id' => '1']);
            if ($user) {
                $jwt_token = JWTAuth::fromUser($user);
                Token::create(['jwt' => $jwt_token, 'user_id' => $user->id,]);
            }
            DB::commit();
            SmsController::send_sms(removePhoneZero($request->mobile,'966'), trans('messages.activation_code_is', ['code' => $activation_code]));
            return redirect()->route('front.show_activation');
        } catch (\Exception $e) {
            return redirect()->route('front.show_activation');
        }
    }

    public function show_activation()
    {
        return view('front.auth.activation');
    }

    public function checkCode(Request $request)
    {
//        if ($request->code1 == null || $request->code2 == null || $request->code3 == null || $request->code4 == null)
//            return back()->with('error', trans('messages.activation_code_required'));
//
//        $code = $request->code4 . $request->code3 . $request->code2 . $request->code1;
//
//        $user = User::where('activation_code', $code)->first();

        if ($request->activation_code == null)
            return back()->with('error', trans('messages.activation_code_required'));

        $user = User::where('activation_code', $request->activation_code)->first();

        if (!$user) return back()->with('error', trans('messages.wrong_code'));

        if (!$user->update(['activation_code' => null, 'is_active' => 'active'])) return back()->with('error', 'حدث خطا, حاول مره اخري');
        return redirect()->route('front.show_register')->with('success', trans('messages.register_success'));
    }


    public function login(LoginRequest $request)
    {
        Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        if (!auth()->user()) return back()->withInput($request->only('email'))->with('error', 'عفوا بيانات الاعتماد الخاصة بك غير متطابقة مع التي لدينا');

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
        return redirect()->route('front.home');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('front.home');
    }





    public function forget_pass(ForgetPassRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user->is_active != 'active') return back()->with('error', 'عفوا هذا الحساب غير مفعل من قبل الادارة');

        $code = create_rand_numbers();

        $user->update(['reset_password_code' => $code]);

        Mail::to($request->email)->send(new ConfirmCode($code));
//$email=$request->email;
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
    public function resendCode($email)
    {
        $user = User::where('email', $email)->first();

        $code = create_rand_numbers();

        $user->update(['reset_code' => $code]);

        Mail::to($email)->send(new ConfirmCode($code));

        return back()->with('success', 'تم إعادة إرسال الكود بنجاح');
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




    public function get_cities_by_country_id(Request $request)
    {
        $country = Country::find($request->country_id);

        if (!$country) return response()->json(['status' => false], 500);

        return response()->json(['cities' => $country->cities, 'status' => true], 200);
    }
}
