<?php

namespace App\Http\Controllers\Dashboard;

use App\Firebase\Firebase;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function send_single_notify(Request $request){

        $user=User::find($request->user_id);
        if (is_null($user)){
            return back()->with('class', 'success')->with('message', trans('messages.messages.user_not_found'));
        }
        if ($user->token->fcm != null ) {
            Firebase::send([
                'title'      => $request->title,
                'text'       => $request->text,
                'fcm_tokens' => $user->token->fcm
            ]);

            Firebase::createWebCurl($user->token->web_fcm, [
                'title' => $request->title,
                'body' => $request->text,
                'icon' => ''
            ]);
        }
        Notification::create($request->all() + ['user_id' => $request->user_id]);
//        Notification::create([
////            'user_id' => $request->user_id,
////            'title' => $request->title,
////            'text' => $request->text,
//        ]);
        return back()->with('class', 'success')->with('message', trans('messages.messages.send_successfully'));
    }

//    protected function sendFCM($token, $data)
//    {
//        $optionBuilder = new OptionsBuilder();
//        $optionBuilder->setTimeToLive(60 * 20);
//
//        $notificationBuilder = new PayloadNotificationBuilder($data['title']);//Title
//        $notificationBuilder->setBody($data['message'])//Body
//        ->setSound('default');
//
//        $dataBuilder = new PayloadDataBuilder();
//        $dataBuilder->setData($data);
//        //$dataBuilder->addData($data);
//
//        $option = $optionBuilder->build();
//        $notification = $notificationBuilder->build();
//        $data = $dataBuilder->build();
//
//        //$token = '';
//        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
//
//
////        dd($downstreamResponse);
//        //$downstreamResponse->numberSuccess();
//        //$downstreamResponse->numberFailure();
//    }
}
