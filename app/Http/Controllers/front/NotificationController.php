<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function my_notification()
    {
//        $notifications = Notification::whereNull('user_id')->latest()->get();
//        $data['_notifications'] = $notifications->merge(auth()->user()->notifications)->sortDesc();

        $data['_notifications'] =  auth()->user()->notifications()->latest()->get();

        foreach ($data['_notifications'] as $notification) {
            $notification->update(['is_seen' => 1]);
        }
        return view('front.user.my_notifications',$data);
    }
}


