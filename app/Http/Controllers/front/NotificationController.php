<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function my_notification()
    {

        $notifications = Notification::whereNull('user_id')->latest()->get();
        $data['_notifications'] = $notifications->merge(auth()->user()->notifications);


//        $data['notifications'] =  auth()->user()->notifications()->get();
        return view('front.user.my_notifications',$data);
    }
}


