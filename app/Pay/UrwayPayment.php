<?php

namespace App\Pay;

use Illuminate\Support\Str;

class UrwayPayment
{
    public static function getUrwayChargeData($arr)
    {
        // the redirect url after sending request and pay;
        $redirect_url = request()->root() . '/' . app()->getLocale() . '/success-payment?orderId=' . $arr['trackid'];

        $api_response_url = request()->root() . '/api/success-payment?orderId=' . $arr['trackid'];

        $url = Str::contains(request()->url(),'api') ? $api_response_url : $redirect_url;

        return [
            'trackid'       => $arr['trackid'],
            'terminalId'    => config('pay.terminal_id'),
            'customerEmail' => $arr['email'],
            'action'        => "1",  // action is always 1
            'merchantIp'    => self::getServerIp(),
            'password'      => config('pay.urway_password'),
            'currency'      => "SAR",
            'country'       => "SA",
            'amount'        => $arr['amount'],
            "udf1"          => $arr['udf1'] ?? "",
            "udf2"          => $url, //Response page URL
            "udf3"          => $arr['udf3'] ?? "",
            "udf4"          => $arr['udf4'] ?? "",
            "udf5"          => $arr['udf5'] ?? "",
            'requestHash'   => self::generateHash($arr)  //generated Hash
        ];
    }

    public static function base()
    {
//        $local = 'https://payments-dev.urway-tech.com/URWAYPGService/transaction/jsonProcess/JSONrequest';
//        $live = 'https://payments.urway-tech.com/URWAYPGService/transaction/jsonProcess/JSONrequest';
//        return config('pay.status') == 'local' ? $local : $live;

        $live = ' https://payments.urway-tech.com/URWAYPG/URWAYPGService/transaction/jsonProcess/JSONrequest';

        return config('pay.status') == $live;
    }

    public static function paymentUrl($response)
    {
        return (isset($response->targetUrl) && isset($response->payid)) ? $response->targetUrl . '?paymentid=' . $response->payid : '';
    }

    private static function getServerIp()
    {
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    private static function generateHash($arr)
    {
        $txn_details  = $arr['trackid'];

        $txn_details .= '|'. config('pay.terminal_id');

        $txn_details .= '|'. config('pay.urway_password');

        $txn_details .= '|'. config('pay.merchant_secret_key');

        $txn_details .= '|'.$arr['amount'];

        $txn_details .= '|SAR';

        return hash('sha256', $txn_details);
    }
}
