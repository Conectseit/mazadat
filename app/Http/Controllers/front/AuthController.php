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
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Ramsey\Uuid\Uuid;
use Tymon\JWTAuth\Facades\JWTAuth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class AuthController extends Controller
{

    public function showRegister()
    {
        return view('front.auth.register');
    }

    public function show_activation($mobile)
    {
      $user=User::where('mobile',$mobile)->first();
        $activation_code= $user->activation_code;

        return view('front.auth.activation', compact('mobile'),compact('activation_code'));
    }

    public function checkCode(Request $request)
    {
        if ($request->activation_code == null)
            return back()->with('error', trans('messages.activation_code_required'));

        $user = User::where('activation_code', $request->activation_code)->first();

        if (!$user) return back()->with('error', trans('messages.wrong_code'));

        if (!$user->update(['activation_code' => null, 'is_active' => 'active'])) return back()->with('error', 'حدث خطا, حاول مره اخري');

        Auth::login($user);
        return redirect()->route('front.home')->with('success', trans('messages.register_success_welcome_in_our_website'));

//        return redirect()->route('front.show_login')->with('success', trans('messages.register_success_welcome_in_our_website'));
    }

    public function resendSms($mobile)
    {
        try {
            $user = User::where('mobile', $mobile)->first();

            if (!$user) return back();

            $code = create_rand_numbers();

            $user->update(['activation_code' => $code,'send_at'=>now()]);


            SmsController::sendSms(($mobile), trans('messages.activation_code_is', ['code' => $code]));

//            SmsController::send_sms(($mobile), trans('messages.activation_code_is', ['code' => $activation_code]));

            //            return response()->json(['data' => [], 'status' => true, 'message' => 'تم إعادة إرسال الكود بنجاح']);
            return back()->with('message', 'تم إعادة إرسال الكود بنجاح');
        } catch (\Exception $e) {
            return response()->json(['data' => [], 'status' => false, 'message' => $e->getMessage()]);
        }

    }


    public function show_login()
    {
        $data['countries'] = Country::all();
        return view('front.auth.login', $data);
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
            return redirect()->route('front.show_activation', $user->mobile)
                ->with('error', trans('api.please_active_your_account_by_activation_code_first'));
//            return back()->withInput($request->only('email'))->with('error', trans('api.please_active_your_account_by_activation_code_first'));
        }
        if ($user->is_accepted == 0) {
            Auth::logout();
            return back()->withInput($request->only('email'))->with('error', trans('api.please_wait_your_account_not_activated_yet'));
        }
//
//        if ($user->is_completed == 0) {
//            return redirect()->route('front.show_complete_profile')
//                ->with('error', trans('api.please_complete_your_account_first'));
//        }
//
//        if ($user->is_verified == 0) {
//            return back()->with('error', trans('messages.please_wait_your_account_not_verified_to_participate_yet'));
//        }

        $jwt_token = JWTAuth::fromUser($user);
        auth()->user()->token->update(['jwt' => $jwt_token, 'fcm_web_token' => $request->fcm_web_token ?? 'none']);

        return redirect()->route('front.home');
    }


    public function logout()
    {
        auth()->user()->token->update(['jwt' => '', 'fcm_web_token' =>null]);
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


    public function nafath()
    {
        return view('front.auth.login_nafath');
    }


    public function nafathLogin(Request $request)
    {

        $request->validate([
            'nationalId' => 'required',
        ]);
        $requestId = Uuid::uuid4()->toString();

        $nafathData = [
            'nationalId' => $request->nationalId,
            'service' => 'Login',
        ];
        $local = app()->getLocale();


        $response = Http::withHeaders([
            'APP-ID' => '2896f9aa',
            'APP-KEY' => '8fdd84f548d5d4670e809b0d77eab976',
        ])->post("https://nafath.api.elm.sa/stg/api/v1/mfa/request?local={$local}&requestId={$requestId}", $nafathData);

        $responseBody = $response->body();
        $errorData = json_decode($responseBody, true);

        dd($errorData);
        // Check if the request was successful
        if ($response->successful()) {
            // Extract the transaction ID and random number from the response
            $nationalId = $response['nationalId'];
            $transId = $response['transId'];
            $random = $response['random'];

            // Redirect the user to the Nafath app using the deep link URL
            // Replace 'nafath://home' with the actual deep link URL provided by Nafath
            return redirect('nafath://home');
        } else {
            // Handle the case where the request failed
            return back()->with('error', 'Failed to initiate Nafath authentication');
        }
    }



//    public function handleNafathCallback(Request $request)
//    {
//        $token = $request->input('token');
//        $transId = $request->input('transId');
//        $requestId = $request->input('requestId');
//
//        try {
//            $decodedToken = JWTAuth::setToken($token)->getPayload();
//
//            $userNationalId = $decodedToken->get('national_id');
//
//            $user = User::where('national_id', $userNationalId)->first();
//
//            if ($user) {
//                Auth::login($user);
//                return redirect()->route('dashboard')->with('success', 'Logged in successfully');
//            } else {
//
//                return redirect()->route('register')->with('error', 'User not found. Please register.');
//            }
//        } catch (JWTException $e) {
//
//            return redirect()->route('login')->with('error', 'Failed to verify token. Please try again.');
//        }
//    }















//    public function redirectToNafathProvider()
//    {
//        return Socialite::driver('nafath')->redirect();
//    }
//
//    public function handleNafathCallback()
//    {
//        try {
//            $nafathUser = Socialite::driver('nafath')->user();
//        } catch (Exception $e) {
//            // Handle any potential errors, such as authentication failure
//            return redirect()->route('login')->with('error', 'Failed to authenticate with NaFath.');
//        }
//
//        // Check if the user exists in your database based on their unique identifier (e.g., email)
//        $user = User::where('email', $nafathUser->email)->first();
//
//        if (!$user) {
//            // If the user does not exist, create a new user record
//            $user = User::create([
//                'name' => $nafathUser->name,
//                'email' => $nafathUser->email,
//                // Additional user data if needed
//            ]);
//        }
//
//        // Log the user in
//        auth()->login($user);
//
//        // Redirect the user to the intended page after login
//        return redirect()->intended('/dashboard');
//
//    }


//    public function redirectToNafathProvider(Request $request)
//    {
//        $clientId = '2896f9aa';
//        $scopes = 'login';
//
//        // Redirect the user to the OAuth provider's authorization URL
//        $authorizationUrl = "https://nafath.api.elm.sa/oauth/authorize?client_id={$clientId}&response_type=code&scope={$scopes}";
//        return redirect()->away($authorizationUrl);
//    }
//
//    public function handleNafathCallback(Request $request)
//    {
//        $clientId = '2896f9aa';
//        $clientSecret = '8fdd84f548d5d4670e809b0d77eab976';
//        $redirectUri = 'https://nafath.api.elm.sa/stg/';
//
//        // Ensure the request has an authorization code
//        if (!$request->has('code')) {
//            return redirect()->route('login')->withErrors(['error' => 'Authorization code not provided.']);
//        }
//
//        // Exchange authorization code for an access token
//        $response = Http::post('https://nafath.api.elm.sa/oauth/token', [
//            'grant_type' => 'authorization_code',
//            'client_id' => $clientId,
//            'client_secret' => $clientSecret,
//            'redirect_uri' => $redirectUri,
//            'code' => $request->input('code'),
//        ]);
//
//        // Check if the request was successful
//        if ($response->successful()) {
//            $accessToken = $response->json()['access_token'];
//
//            // Store the access token securely, e.g., in session or database
//            session(['access_token' => $accessToken]);
//
//            return redirect()->route('dashboard')->with('success', 'Authenticated successfully.');
//        } else {
//            // Handle authentication errors
//            $error = $response->json()['error'] ?? 'Unknown error occurred.';
//            return redirect()->route('login')->withErrors(['error' => $error]);
//        }
//    }
//



}

