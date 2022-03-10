<?php

namespace App\Firebase;

use Edujugon\PushNotification\PushNotification;
use Illuminate\Support\Facades\Http;

class Firebase
{
    // For mobile;

    public static function send($data)
    {
        $push = new PushNotification('fcm');

        $res = $push->setMessage(self::setPushNotificationData(self::getData($data)))

            ->setApiKey(env('FCM_SERVER_KEY'))

            ->setDevicesToken($data['fcm_tokens'])

            ->send();

        return $res->feedback;
    }

    private static function setPushNotificationData($data)
    {
        return ['data' => $data, 'notification' => $data, 'priority' => 'high'];
    }

    private static function getData($data)
    {
        return [
            'title'                 => $data['title'],
            'body'                  => $data['text'],
            'notificationable_type' => $data['type'] ?? 'dash',
            'auction_id'            => $data['auction_id'] ?? 0,
            'notificationable_id'   => $data['type_id'] ?? 0,
            'sound'                 => 'default',
//            'click_action'          => 'FCM_PLUGIN_ACTIVITY',
        ];
    }

    // For web;

    public static function createWebCurl($to, $data)
    {
        $fields = array('to' => $to, 'notification' => self::getWebData($data));

        return Http::withToken(env('FCM_SERVER_KEY'))->post(self::url(), $fields);
    }

    private static function url()
    {
        return 'https://fcm.googleapis.com/fcm/send';
    }

    private static function getWebData($data)
    {
        return [
            'title' => $data['title'],
            'body'  => $data['body'],
            'icon'  => $data['icon'],
        ];
    }
}
