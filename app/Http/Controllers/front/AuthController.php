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

    public function show_activation($mobile)
    {
        return view('front.auth.activation', compact('mobile'));
    }

    public function checkCode(Request $request)
    {
        if ($request->activation_code == null)
            return back()->with('error', trans('messages.activation_code_required'));

        $user = User::where('activation_code', $request->activation_code)->first();

        if (!$user) return back()->with('error', trans('messages.wrong_code'));

        if (!$user->update(['activation_code' => null, 'is_active' => 'active'])) return back()->with('error', 'حدث خطا, حاول مره اخري');
        return redirect()->route('front.show_login')->with('success', trans('messages.register_success_welcome_in_our_website'));
    }

    public function resendSms($mobile)
    {
        try
        {
            $user = User::where('mobile', $mobile)->first();

            $activation_code = create_rand_numbers();

            $user->update(['activation_code' => $activation_code]);

           SmsController::send_sms(($mobile), trans('messages.activation_code_is', ['code' => $activation_code]));
//            return response()->json(['data' => [], 'status' => true, 'message' => 'تم إعادة إرسال الكود بنجاح']);
            return back()->with('message' , 'تم إعادة إرسال الكود بنجاح');
        }
        catch (\Exception $e)
        {
//            return response()->josn(['data' => [], 'status' => false, 'message' => $e->getMessage()]);
        }

    }



    public function show_login()
    {
        $data['countries'] = Country::all();
        return view('front.auth.login',$data);
    }

    public function login(LoginRequest $request)
    {
        $col = self::is_email($request->email) ? 'email' : 'mobile';

        Auth::attempt([$col => $request->email, 'password' => $request->password]);

        if (!auth()->user()) return back()
//            ->withInput($request->only('email'))
            ->with('error', trans('messages.sorry_invalid_email_or_password'));

        $user = auth()->user();
        if ($user->ban == 1) {
            return back()->with('error', trans('messages.sorry_your_account_is_baned_from_admin_contact_with_customer_service_team'));
        }

        if ($user->is_active == 'deactive') {
            Auth::logout();
            return redirect()->route('front.show_activation',$user->mobile)
                ->with('error', trans('api.please_active_your_account_by_activation_code_first'));
//            return back()->withInput($request->only('email'))->with('error', trans('api.please_active_your_account_by_activation_code_first'));
        }
        if ($user->is_accepted == 0) {
            Auth::logout();
            return back()->withInput($request->only('email'))->with('error', trans('api.please_wait_your_account_not_activated_yet'));
        }

        if ($user->is_completed == 0 ) {
            return redirect()->route('front.show_complete_profile')
                ->with('error', trans('api.please_complete_your_account_first'));
        }

        if ($user->is_verified == 0) {
            return back()->with('error', trans('messages.please_wait_your_account_not_verified_to_participate_yet'));
        }

        $jwt_token = JWTAuth::fromUser($user);
        auth()->user()->token->update(['jwt' => $jwt_token,'fcm_web_token'=>$request->fcm_web_token ?? 'none']);

        return redirect()->route('front.home');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('front.home');
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

