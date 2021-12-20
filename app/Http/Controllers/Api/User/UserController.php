<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PARENT_API;
use App\Http\Requests\Api\TrafficFileNumberRequest;
use App\Models\TrafficFileNumber;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends PARENT_API
{
    public function updatePreferredLanguage(Request $request)
    {
        $user =  auth()->user();
//        dd($user->preferred_language);
        if( $user->preferred_language  == 'arabic')
        {
            $user->update(['preferred_language' => 'english']);
        }else{
            $user->update(['preferred_language' => 'arabic']);
        }
        return responseJson('true', trans('api.updated_successfully'),[]); //ACCEPTED
    }

    public function getPreferredLanguage(Request $request)
    {
        $preferred_language = User::select('preferred_language')->where('id',  auth()->user()->id)->first();
//        $preferred_language =  auth()->user()->select('preferred_language')->first();
        return responseJson('true', trans('api.request_done_successfully'),$preferred_language); //ACCEPTED
    }

    public function add_traffic_file_number(TrafficFileNumberRequest $request)
    {
        $traffic_file_number = TrafficFileNumber::create($request->all()+['user_id'=> auth()->user()->id]);
        return responseJson('true', trans('api.added_successfully'),$traffic_file_number); //ACCEPTED
    }



//    public function togglePreferredLanguage(Request $request)
//    {
//        $user =  auth()->user();
////        dd($user->preferred_language);
//        if( $user->preferred_language  == 'arabic')
//        {
//            $user->update(['preferred_language' => 'english']);
//        }else{
//            $user->update(['preferred_language' => 'arabic']);
//        }
//        return responseJson('true', trans('api.updated_successfully'),[]); //ACCEPTED
//    }



}
