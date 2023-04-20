<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PARENT_API;
use App\Http\Resources\Api\NationalityResource;
use App\Models\Nationality;
use Illuminate\Http\Request;

class NationalityController extends PARENT_API
{
    public function nationalities()
    {
        $nationalities = Nationality::all();
        return responseJson(true, trans('api.all_nationalities'),NationalityResource::collection($nationalities) );  //OK don-successfully
    }

}
