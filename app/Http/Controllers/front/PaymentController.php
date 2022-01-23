<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Setting;
use App\Models\Transaction;
use App\Pay\UrwayPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function cheque_payment()
    {
        $data['mobile'] = Setting::where('key', 'mobile')->first()->value;
        $data['email'] = Setting::where('key', 'email')->first()->value;
        $data['fax'] = Setting::where('key', 'fax')->first()->value;
        $data['address'] = Setting::where('key', 'address')->first()->value;
        return view('front.user.payment.cheque', $data);
    }

    public function bank_deposit()
    {

        $bank_name = 'bank_name_' . app()->getLocale();
        $data['bank_name'] = Setting::where('key', $bank_name)->first()->value;

        $data['account_name'] = Setting::where('key', 'account_name')->first()->value;
        $data['account_number'] = Setting::where('key', 'account_number')->first()->value;
        $data['branch'] = Setting::where('key', 'branch')->first()->value;
        $data['iban'] = Setting::where('key', 'iban')->first()->value;
        return view('front.user.payment.bank_deposit', $data);
    }

    public function online_payment()
    {
        return view('front.user.payment.online');
    }

    public function sendPayment(Request $request)
    {
        $request->validate(['amount' => ['required', 'numeric']]);

        $data = UrwayPayment::getUrwayChargeData([
            'trackid' => auth()->user()->id ?? "0",
            'email' =>  "test@test.com",
            'amount' => (int)$request->amount ?? 0, // temp
        ]);

        $response = Http::post(UrwayPayment::base(), $data)->object();

        $url = UrwayPayment::paymentUrl($response);

        return $url == '' ? back() : redirect()->to($url);
    }

    public function successPayment(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $request_data = $request->only(['amount']);

            // in case of failure
            if($request['Result'] != 'Successful') return redirect()->to('/online_payment');

            $request_data['payment_type'] = 'online';

            auth()->user()->payments()->create($request_data);

            auth()->user()->update(['wallet' => (int)(auth()->user()->wallet + round($request['amount']))]);

            DB::commit();

            return redirect()->to('/')->with('success', trans('messages.paid_success'));
        } catch (\Exception $e)
        {
            dd($e->getMessage());
            //return back();
        }
    }
}
