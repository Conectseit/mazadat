<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PARENT_API;
use App\Http\Resources\Api\CategoryAuctionsResource;
use App\Http\Resources\Api\CategoryResource;
use App\Http\Resources\Api\NotificationsResource;
use App\Models\Auction;
use App\Models\Category;
use App\Models\CommonQuestion;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends PARENT_API
{
    public function index()
    {
        $user = auth('api')->user();
        $notifications = Notification::all();
//        $notifications = Notification::where('user_id',$user->id)->get();

        if ($notifications->count() <= 0) {
            return responseJson(false, trans('api.there_is_no_notifications_yet'), null);  //OK
        }
        return responseJson(true, trans('api.all_notifications'),NotificationsResource::collection($notifications) );  //OK don-successfully

    }

}
