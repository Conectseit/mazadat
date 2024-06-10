<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsController extends Controller
{
    public static function sendSms($recipient, $body)
    {
        $requestData = self::unifonic_parmeters('gcGmMrYf4gfgJNyoV4MBxwfIx6SjNp','MZADAT', $recipient, $body);
//        $requestData = self::unifonic_parmeters('hiiNptN0BgWapNhNVhtqx0P8N1XZD1','MZADAT', $recipient, $body);

        $response = Http::post('https://el.cloud.unifonic.com/rest/SMS/messages', $requestData);

        Log::info($response);

//        Log::info(self::get_unifonic_message_by_code($response));
        return ['code' => $response, 'message' => self::get_unifonic_message_by_code($response)];

    }


    public static function unifonic_parmeters( $appSid, $senderID, $recipient,$body, $responseType = null, $correlationID = null, $baseEncode = null, $statusCallback = null, $async = false)
    {
        return [
            'AppSid'     => $appSid,
            'SenderID'   => $senderID,
            'Recipient'  => $recipient,
            'Body'       => (string)$body,
        ];
    }


    public static function get_unifonic_message_by_code($response)
    {
        if ($response)
        {
            return $response;
//            return "Message send successfully";
        }
        return "Unknown Errorrr !.";
    }
}


//    https://el.cloud.unifonic.com/rest/SMS/messages?AppSid=6v253153s1g7831s5&SenderID=sender&Body=Test&Recipient=966546130952&responseType=JSON&CorrelationID=CorrelationID&baseEncode=true&statusCallback=sent&async=false
