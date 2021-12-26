<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsController extends Controller
{
    private $username = 'mzadat';
    private $password = 'Sa@@123456';
    private $sender_name = 'mzadat';

    public function send_sms($mobile, $message)
    {
//        $date = date('Y-m-d');
//        $time = date("H:i");

        $requestData = self::malathData($this->username, $this->password, $mobile, $this->sender_name, $message);

        $result = Http::get('https://sms.malath.net.sa/httpSmsProvider.aspx', $requestData);

        $code = (int)str_replace(" ", "", $result);

//        Log::info(self::get_malath_message_by_code($code));

        return ['code' => $code, 'message' => self::get_malath_message_by_code($code)];

//        $url = "https://sms.malath.net.sa/httpSmsProvider.aspx?" .
//            "username=" . $this->username .
//            "&password=" . $this->password .
//            "&mobile=" . $mobile .
//            "&sender=" . $this->sender_name .
//            "&message=" . $message  ;
//            "&date=" . date('Y-m-d') . "&time=" . date('H:i') . "";
    }

    public function get_malath_message_by_code($code)
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
            'unicode'  => 'U',
            'message'  => $message,
            'sender'   => $sms_sender,
        ];
    }
}