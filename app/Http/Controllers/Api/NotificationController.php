<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PARENT_API;
use App\Http\Resources\Api\CategoryAuctionsResource;
use App\Http\Resources\Api\CategoryResource;
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
        $notifications = Notification::where('user_id',$user->id)->get();
        return responseJson('200', trans('api.all_notifications'), $notifications);  //OK don-successfully
    }

}
