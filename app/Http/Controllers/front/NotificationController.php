<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function my_notification()
    {
        $data['notifications'] =  auth()->user()->notifications()->get();
        return view('front.user.my_notifications',$data);
    }
}


