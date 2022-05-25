<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SmsController;
use App\Http\Requests\Dashboard\SellerRequest;
use App\Http\Requests\Dashboard\users\PersonRequest;
use App\Http\Requests\Dashboard\users\WalletRequest;
use App\Models\Auction;
use App\Models\AuctionBuyer;
use App\Models\City;
use App\Models\Country;
use App\Models\Nationality;
use App\Models\Payment;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{


    public function ban($id)
    {
        $user = User::findOrFail($id);
        $user->update(['ban'=> 1]);
        SmsController::send_sms($user->mobile, 'تم حظر حسابك  من ادرة موقع مزادات' );
        return back()->with('success',  trans('messages.ban_user_and_send_SMS_successfully'));

    }
    public function not_ban($id)
    {
        $user = User::findOrFail($id);
        $user->update(['ban'=> 0]);
        SmsController::send_sms($user->mobile, 'تم رفع الحظر وتفعيل حسابك  من ادرة موقع مزادات' );
        return back()->with('success',  trans('messages.active_user_again_and_send_SMS_successfully'));
    }




    public function add_balance(WalletRequest $request,$id)
    {
        $user = User::findOrFail($id);

//        $user->update(['wallet'=> $request->wallet +$user->wallet]);

        $payment= Payment::Create([
                    'user_id'     => $user->id,
                    'date'        => $user->updated_at,
                    'amount'      => $request->wallet,
                    'payment_type'=> 'cash'
                ]);

// ===========================================================
        activity()
            ->performedOn($user)
            ->causedBy(auth()->guard('admin')->user())
            ->log('قام المشرف'.auth()->guard('admin')->user()->full_name.''.' باضافة رصيد الي محفظة العميل  '.''.($user->user_name).'' .'بمقدار'.$payment->amount.' '.'ريال سعودي');
// ===========================================================

        return back()->with('message', trans('messages.messages.added_balance_successfully'));
    }



//
//    public function verified($id)
//    {
//        $person = User::findOrFail($id);
//        $person->update(['is_verified'=> 1]);
//        SmsController::send_sms($person->mobile, 'تم الموافقة علي بيانات حسابك من ادارة موقع مزادات' );
//        return back()->with('success',  trans('messages.active_user_and_send_SMS_successfully'));
//    }
//    public function not_verified($id)
//    {
//        $person = User::findOrFail($id);
//        $person->update(['is_verified'=> 0]);
//        SmsController::send_sms($person->mobile, 'هناك خطأ في تكملة بيانات حسابك في موقع مزادات من فضلك ارسلها مرة اخري' );
//        return back()->with('success',  trans('messages.not_verified_yet_and_send_SMS'));
//    }


}
