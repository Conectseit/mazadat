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
        $notifications = Notification::whereNull('user_id')->latest()->get();

        $_notifications = $notifications->merge(auth()->guard('api')->user()->notifications);

        return responseJson(true, trans('api.all_notifications'),NotificationsResource::collection($_notifications) );  //OK don-successfully
    }

}
