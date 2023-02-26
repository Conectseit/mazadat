<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MalthSmsController extends Controller
{


    public static function send_sms($mobile, $message)
    {
        $requestData = self::malathData('mzadat', 'Sa@@123456', $mobile, 'MZADAT', $message);

        $response = Http::get('https://sms.malath.net.sa/httpSmsProvider.aspx', $requestData);

        $code = (int)str_replace(" ", "", $response);

//        Log::info(self::get_malath_message_by_code($code));

        return ['code' => $code, 'message' => self::get_malath_message_by_code($code)];
    }

    public static function get_malath_message_by_code($code)
    {
        switch ($code)
        {
            case 0:
                return "Message send successfully";
                break;

            case 101:
                return "Parameter are missing";
                break;

            case 104:
                return "Either user name or password are missing or your Account is on hold.";
                break;

            case 105:
                return "Credit are not available.";
                break;

            case 106:
                return "Wrong Unicode.";
                break;

            case 107:
                return "Blocked Sender Name.";
                break;

            case 108:
                return "Missing Sender name.";
                break;

            case 1010:
                return "SMS Text Grater that 6 part .";
                break;

            default:
                return "Unknown Error !.";
        }
    }

//    public function malathErrorCodes()
//    {
//        return [101, 104, 105, 106, 107, 108, 1010];
//    }

    public static function malathData($username, $password, $number, $sms_sender, $message)
    {
        return [
            'username' => $username,
            'password' => $password,
            'mobile'   => $number,
            'unicode'  => 'none',
            'message'  => (string)$message,
            'sender'   => $sms_sender,
        ];
    }
}

//966546130952
//966546130952
//966505980169
//
//
//  function createSendMessage(
//      $appSid,
//      $senderID,
//      $body,
//      $recipient,
//      $responseType = null,
//      $correlationID = null,
//      $baseEncode = null,
//      $statusCallback = null,
//      $async = false)
//  {
//
//  }


//    https://el.cloud.unifonic.com/rest/SMS/messages?AppSid=6v253153s1g7831s5&SenderID=sender&Body=Test&Recipient=966546130952&responseType=JSON&CorrelationID=CorrelationID&baseEncode=true&statusCallback=sent&async=false
