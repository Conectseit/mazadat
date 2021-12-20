<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PARENT_API;
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
        return responseJson('200', trans('api.updated_successfully'),[]); //ACCEPTED
    }

    public function getPreferredLanguage(Request $request)
    {
        $preferred_language = User::select('preferred_language')->where('id',  auth()->user()->id)->first();
//        $preferred_language =  auth()->user()->select('preferred_language')->first();
        return responseJson('200', trans('api.request_done_successfully'),$preferred_language); //ACCEPTED
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
//        return responseJson('200', trans('api.updated_successfully'),[]); //ACCEPTED
//    }
}
