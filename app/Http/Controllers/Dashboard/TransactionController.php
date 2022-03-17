<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CityRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Payment;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function index()
    {
        $data['transactions'] = Payment::get();
        $data['online_transactions'] = Payment::where(['payment_type'=> 'online'])->get();
        $data['bank_deposit_transactions'] = Payment::where(['payment_type'=> 'bank_deposit'])->get();
        $data['cash_transactions'] = Payment::where(['payment_type'=> 'cash'])->get();

        return view('Dashboard.transactions.index', $data);
    }



//    public function store(Request $request)
//    {
//        $user=User::where('id',$request->user_id)->first();
//        Payment::create($request->all());
//
//        $user->update(['wallet' => ($user->wallet + ($request['amount']))]);
//
//        return back()->with('message', trans('messages.messages.added_successfully'));
//    }



//
//    public function destroy(Request $request)
//    {
//        $city = Payment::find($request->id);
//        if (!$city) return response()->json(['deleteStatus' => false, 'error' => 'Sorry, City is not exists !!']);
//        try {
//            $city->delete();
//            return response()->json(['deleteStatus' => true, 'message' => 'تم الحذف  بنجاح']);
//        } catch (Exception $e) {
//            return response()->json(['deleteStatus' => false, 'error' => 'Server Internal Error 500']);
//        }
//    }


    public function accept($id)
    {
        $transaction = Payment::find($id);
        $user = User::where('id',$transaction->user_id)->first();

        $user->update(['wallet'=> $transaction->amount +$user->wallet]);
        $transaction->update(['is_accepted'=> 1]);

        // ===========================================================
        activity()
            ->performedOn($user)
            ->causedBy(auth()->guard('admin')->user())
            ->log('قام المشرف'.auth()->guard('admin')->user()->full_name.' بقبول الايداع البنكي للمستخدم'.($user->user_name));
// ======================
        return back()->with('class', 'danger')->with('message', trans('messages.messages.accept_payment_recipt'));

    }

}
