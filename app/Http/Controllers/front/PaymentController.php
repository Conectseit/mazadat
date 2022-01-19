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
        return view('front.user.payment.bank_deposit');
    }
    public function online_payment()
    {
        return view('front.user.payment.online');
    }
}
