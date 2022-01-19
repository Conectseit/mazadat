<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function cheque_payment()
    {
        $data['mobile'] = Setting::where('key', 'mobile')->first()->value;
        $data['email'] = Setting::where('key', 'email')->first()->value;
        $data['fax'] = Setting::where('key', 'fax')->first()->value;
        $data['address'] = Setting::where('key', 'address')->first()->value;
        return view('front.user.payment.cheque',$data);
    }

    public function bank_deposit()
    {

        $bank_name= 'bank_name_'.app()->getLocale();
        $data['bank_name'] = Setting::where('key',$bank_name)->first()->value;

        $data['account_name'] = Setting::where('key', 'account_name')->first()->value;
        $data['account_number'] = Setting::where('key', 'account_number')->first()->value;
        $data['branch'] = Setting::where('key', 'branch')->first()->value;
        $data['iban'] = Setting::where('key', 'iban')->first()->value;
        return view('front.user.payment.bank_deposit',$data);
    }
    public function online_payment()
    {
        return view('front.user.payment.online');
    }
}
