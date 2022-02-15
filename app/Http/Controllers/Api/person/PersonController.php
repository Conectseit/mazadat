<?php

namespace App\Http\Controllers\Api\person;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\person\CompletePersonProfileRequest;
use App\Http\Requests\Api\person\UpdatePersonProfileRequest;
use App\Http\Resources\Api\auth\PersonResource;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function person_profile()
    {
        $user = auth()->user();
        if (!$user) {
            return responseJson(false, trans('api.The_user_not_found'), null); //BAD_REQUEST
        }
        return responseJson(true, trans('api.user_profile'), new PersonResource($user));  //OK
    }

    public function update_person_profile(UpdatePersonProfileRequest $request)
    {
        $request_data = $request->except(['image']);
        if ($request->image) {
            $request_data['image'] = $request_data['image'] = uploaded($request->image, 'user');
        }
        $user = $request->user();
        if (!$user) {
            return responseJson(false, 'The user not found...', null); //
        }
        $user->update($request_data);
//        $user->update($request->only(['full_name', 'user_name', 'email', 'mobile', 'password']));
        return responseJson(true, trans('api.request_done_successfully'), new PersonResource($user)); //ACCEPTED
    }


    public function completePersonProfile(CompletePersonProfileRequest $request)
    {

        $user = $request->user();
        if (!$user) {
            return responseJson(false, 'The user not found...', null); //
        }
        $user->update($request->all());
//        $user->update($request->only(['full_name', 'user_name', 'email', 'mobile', 'password']));
        return responseJson(true, trans('api.request_done_successfully'), new PersonResource($user)); //ACCEPTED
    }

}
