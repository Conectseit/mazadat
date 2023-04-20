<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PARENT_API;
use App\Http\Resources\Api\BankResource;
use App\Http\Resources\Api\OfficersResource;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends PARENT_API
{
    public function index()
    {
        $user = auth('api')->user();
        $notifications = Setting::where('user_id',$user->id)->get();
        return responseJson(true, trans('api.all_notifications'), $notifications);  //OK don-successfully
    }

    public function about_app()
    {
        $about_app= 'about_app_'.app()->getLocale();

        if ($about_app = Setting::where('key',$about_app)->first()->value)
        {
            return responseJson(true, trans('api.request_done_successfully'), $about_app);  //OK don-successfully
        }
        return responseJson(false, trans('api.Page_not_found'),null);//NOT_FOUND
    }

    public function contact_us_number()
    {
        if ($mobile = Setting::where('key','mobile')->first()->value)
        {
            return responseJson(true, trans('api.request_done_successfully'), $mobile);  //OK don-successfully
        }
        return responseJson(false, trans('api.not_found'),null);//NOT_FOUND
    }
    public function conditions_terms()
    {
        $conditions_terms= 'conditions_terms_'.app()->getLocale();

        if ($conditions_terms = Setting::where('key',$conditions_terms)->first()->value)
        {
            return responseJson(true, trans('api.request_done_successfully'), $conditions_terms);  //OK don-successfully
        }
        return responseJson(false, trans('api.Page_not_found'),null);//NOT_FOUND
    }
    public function our_officers()
    {
        if ($our_officers = Setting::all())
        {
            return responseJson(true, trans('api.request_done_successfully') ,new OfficersResource ($our_officers));  //OK don-successfully
        }
        return responseJson(false, trans('api.Page_not_found'),null);//NOT_FOUND
    }


    public function bank()
    {
        if ($bank = Setting::all())
        {
            return responseJson(true, trans('api.request_done_successfully') ,new BankResource ($bank));  //OK don-successfully
        }
        return responseJson(false, trans('api.Page_not_found'),null);//NOT_FOUND
    }


    public function online_payment_conditions()
    {
        $online_payment_conditions= 'online_payment_conditions_'.app()->getLocale();

        if ($online_payment_conditions = Setting::where('key',$online_payment_conditions)->first()->value)
        {
            return responseJson(true, trans('api.request_done_successfully'), $online_payment_conditions);  //OK don-successfully
        }
        return responseJson(false, trans('api.Page_not_found'),null);//NOT_FOUND
    }


//
//    public function show($key)
//    {
//        if ($page = Setting::where('key', $key)->first()->value)
//        {
//            return responseJson(true, trans('api.request_done_successfully'), $page);  //OK don-successfully
//        }
//        return responseJson(false, trans('api.Page_not_found'),null);//NOT_FOUND
//    }

}
