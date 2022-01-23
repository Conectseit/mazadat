<?php

namespace App\Http\Controllers\Api\payment;

use App\Http\Controllers\PARENT_API;
use App\Http\Requests\Api\user\AmountRequest;
use App\Http\Requests\Api\user\UploadPaymentReceiptRequest;
use App\Models\Payment;
use App\Pay\UrwayPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PaymentController extends PARENT_API
{

    public function upload_payment_receipt(UploadPaymentReceiptRequest $request)
    {
        $request_data = $request->except(['image']);
        if ($request->image) {
            $request_data['image'] = $request_data['image'] = uploaded($request->image, 'payments');
        }
        $user = auth()->user();
        $payment = Payment::create($request_data + ['user_id' => $user->id,'payment_type'=>'bank_deposit']);
        return responseJson(true, trans('api.upload_receipt_successfully'), null); //ACCEPTED
    }

    public function sendPayment(AmountRequest $request)
    {
        $data = UrwayPayment::getUrwayChargeData([
            'trackid' => auth()->user()->id ?? "0",
            'email' =>  "test@test.com",
            'amount' => (int)$request->amount ?? 0, // temp
        ]);

        $response = Http::post(UrwayPayment::base(), $data)->object();
        $url = UrwayPayment::paymentUrl($response);
        return responseJson(true, trans('api.paid_success'), $url); //ACCEPTED

    }

    public function successPayment(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $request_data = $request->only(['amount']);

            // in case of failure
            if($request['Result'] != 'Successful')
                return responseJson(false, trans('api.paid_fail'), null); //ACCEPTED

            $request_data['payment_type'] = 'online';

            auth()->user()->payments()->create($request_data);

            auth()->user()->update(['wallet' => (int)(auth()->user()->wallet + round($request['amount']))]);

            DB::commit();

            return responseJson(true, trans('api.paid_success'), null); //ACCEPTED
        } catch (\Exception $e)
        {
            dd($e->getMessage());
            //return back();
        }
    }


}
