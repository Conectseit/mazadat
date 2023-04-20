<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PARENT_API;
use App\Http\Resources\Api\CountriesResource;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends PARENT_API
{
    public function countries()
    {
        $countries = Country::all();
        return responseJson(true, trans('api.all_countries'),CountriesResource::collection($countries) );  //OK don-successfully
    }

}
