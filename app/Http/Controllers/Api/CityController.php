<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PARENT_API;
use App\Http\Requests\Api\user\CountryIdRequest;
use App\Http\Resources\Api\CitiesResource;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends PARENT_API
{
    public function cities()
    {
        $cities = City::all();
        return responseJson(true, trans('api.all_cities'),CitiesResource::collection($cities) );  //OK don-successfully
    }

    public function cities_by_country_id(CountryIdRequest $request)
    {
        $cities = City::where('country_id',$request->country_id)->get();
        return responseJson(true, trans('api.all_cities'),CitiesResource::collection($cities) );  //OK don-successfully
    }

}
