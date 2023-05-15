<?php

namespace App\Http\Controllers\Dashboard;

use App\Firebase\Firebase;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SmsController;
use App\Http\Requests\Dashboard\users\NotifyRequest;
use App\Models\Message;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function send_notify_to_all_users(NotifyRequest $request)
    {
        $message = Message::where('text', $request->text)->first();
        $users = User::where(['is_company' => 'person'])->get();
        if ($users->count() <= 0) {
            return back()->with('class', 'error')->with('message', trans('messages.messages.user_not_found'));
        } else {
            foreach ($users as $user) {
                if ($user->token->fcm != null) {
                    Firebase::send([
                        'title' => $message->title,
                        'text' => $request->text,
                        'auction_id' => '',
                        'fcm_tokens' => $user->token->fcm
                    ]);
                }
                Firebase::createWebCurl($user->token->fcm_web_token, [
                    'title' => $message->title,
                    'body' => $request->text,
                    'icon' => 'https://mzadat.com.sa/Front/assets/imgs/mini-logo.svg'
                ]);
                Notification::create([
                    'user_id' => $user->id,
                    'title' => $message->title,
                    'text' => $request->text,
                ]);
                SmsController::sendSms($user->mobile, $request->text);
            }
            return back()->with('class', 'success')->with('message', trans('messages.messages.send_successfully'));
        }
    }

    public function send_notify_to_all_companies(NotifyRequest $request)
    {
        $message = Message::where('text', $request->text)->first();
        $users = User::where(['is_company' => 'company'])->get();
        if ($users->count() <= 0) {
            return back()->with('class', 'error')->with('message', trans('messages.messages.user_not_found'));
        } else {
            foreach ($users as $user) {
                if ($user->token->fcm != null) {
                    Firebase::send([
                        'title' => $message->title,
                        'text' => $request->text,
                        'auction_id' => '',
                        'fcm_tokens' => $user->token->fcm
                    ]);
                }
                Firebase::createWebCurl($user->token->fcm_web_token, [
                    'title' => $message->title,
                    'body' => $request->text,
                    'icon' => 'https://mzadat.com.sa/Front/assets/imgs/mini-logo.svg'
                ]);
                Notification::create([
                    'user_id' => $user->id,
                    'title' => $message->title,
                    'text' => $request->text,
                ]);
                SmsController::sendSms($user->mobile, $request->text);
            }
            return back()->with('class', 'success')->with('message', trans('messages.messages.send_successfully'));
        }
    }


    public function send_single_notify(NotifyRequest $request)
    {
        $message = Message::where('text', $request->text)->first();
        $user = User::find($request->user_id);
        if (is_null($user)) {
            return back()->with('class', 'success')->with('message', trans('messages.messages.user_not_found'));
        }
        if ($user->token->fcm != null) {
            Firebase::send([
                'title' => $message->title,
                'text' => $request->text,
                'auction_id' => $request->auction_id,
                'fcm_tokens' => $user->token->fcm
            ]);
        }
        Firebase::createWebCurl($user->token->fcm_web_token, [
            'title' => $message->title,
            'body' => $request->text,
            'icon' => 'https://mzadat.com.sa/Front/assets/imgs/mini-logo.svg'
        ]);
//        Notification::create($request->all() + ['user_id' => $request->user_id]);
        Notification::create([
            'user_id' => $request->user_id,
            'title' => $message->title,
            'text' => $request->text,
        ]);

        SmsController::sendSms($user->mobile, $request->text);
        return back()->with('class', 'success')->with('message', trans('messages.messages.send_successfully'));
    }
}
