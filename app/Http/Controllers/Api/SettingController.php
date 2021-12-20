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
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends PARENT_API
{
    public function index()
    {
        $user = auth('api')->user();
        $notifications = Setting::where('user_id',$user->id)->get();
        return responseJson('200', trans('api.all_notifications'), $notifications);  //OK don-successfully
    }


    public function show($key)
    {
        if ($page = Setting::where('key', $key)->first()->value)
        {
            return responseJson('200', trans('api.request_done_successfully'), $page);  //OK don-successfully
        }
        return responseJson('400', trans('api.Page_not_found'), []);//NOT_FOUND
    }
    public function our_officers()
    {
        if ($our_officers = Setting::all())
        {
            return responseJson('200', trans('api.request_done_successfully'), $our_officers);  //OK don-successfully
        }
        return responseJson('400', trans('api.Page_not_found'), []);//NOT_FOUND
    }

}
