<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SmsController;
use App\Http\Requests\Dashboard\CityRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Payment;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class FinancialReviewsController extends Controller
{

    public function index()
    {
        $data['financial_reviews'] = Payment::where(['is_accepted'=>1,'is_verified'=>0])->get();
        $data['bank_deposit_transactions'] = Payment::where(['is_accepted'=>1,'is_verified'=>0,'payment_type'=> 'bank_deposit'])->latest()->get();
        $data['cash_transactions'] = Payment::where(['is_verified'=>0,'payment_type'=> 'cash'])->latest()->get();
        return view('Dashboard.financial_reviews.index', $data);
    }


    public function destroy(Request $request)
    {
        $city = Payment::find($request->id);
        if (!$city) return response()->json(['deleteStatus' => false, 'error' => 'Sorry, City is not exists !!']);
        try {
            $city->delete();
            return response()->json(['deleteStatus' => true, 'message' => 'تم الحذف  بنجاح']);
        } catch (Exception $e) {
            return response()->json(['deleteStatus' => false, 'error' => 'Server Internal Error 500']);
        }
    }


    public function verify($id)
    {
        $transaction = Payment::find($id);
        $user = User::where('id',$transaction->user_id)->first();
        $user->update(['wallet'=> $transaction->amount +$user->wallet]);
        $transaction->update(['is_verified'=> 1]);
        SmsController::send_sms($user->mobile, 'تم قبول الايداع البنكي  واضافة رصيد الي محفظتك في موقع مزادات' );

// ===========================================================
        activity()
            ->performedOn($user)
            ->causedBy(auth()->guard('admin')->user())
            ->log('قام المشرف'.auth()->guard('admin')->user()->full_name.' بقبول الايداع البنكي للمستخدم'.($user->user_name).''.$transaction->amount.''.'ريال سعودي');
// ======================
        return back()->with('message', trans('messages.messages.verify_payment_receipt'));
    }


    public function not_verify($id)
    {
        $transaction = Payment::findOrFail($id);
        $transaction->update(['is_accepted'=> 0,'is_verified'=> 0]);
        $user = User::where('id',$transaction->user_id)->first();

        SmsController::send_sms($user->mobile, 'هناك خطأ في  بيانات فاتورة الايداع البنكي في موقع مزادات من فضلك ارسلها مرة اخري' );
        return back()->with('danger',  trans('messages.messages.not_accept_deposit_receipt_and_send_SMS'));
    }



    public function verify_cash($id)
    {

        $transaction = Payment::find($id);
        $user = User::where('id',$transaction->user_id)->first();
        $user->update(['wallet'=> $transaction->amount +$user->wallet]);
        $transaction->update(['is_verified'=> 1]);
            SmsController::send_sms($user->mobile, 'تم اضافة رصيد كاش الي محفظتك في موقع مزادات' );

// ===========================================================
        activity()
            ->performedOn($user)
            ->causedBy(auth()->guard('admin')->user())
            ->log('قام المشرف'.auth()->guard('admin')->user()->full_name.' باضافة رصيد كاش الي محفظة المستخدم'.($user->user_name).''.$transaction->amount.''.'ريال سعودي');
// ======================
//        return back()->with('message', trans('messages.messages.verify_cash'));
        return ['status' => 'true', 'message' => trans('messages.messages.verify_cash')];

    }

}
