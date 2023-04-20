<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PARENT_API;
use App\Http\Resources\Api\NotificationsResource;
use Illuminate\Http\Request;

class NotificationController extends PARENT_API
{
    public function my_notification()
    {
//        $notifications = Notification::whereNull('user_id')->latest()->get();
//
//        $_notifications = $notifications->merge(auth()->guard('api')->user()->notifications);

        $_notifications =  auth()->user()->notifications()->latest()->get();

        return responseJson(true, trans('api.all_notifications'),NotificationsResource::collection($_notifications) );  //OK don-successfully
    }

}
