<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PARENT_API;
use App\Http\Resources\Api\CategoryAuctionsResource;
use App\Http\Resources\Api\CategoryResource;
use App\Http\Resources\Api\CitiesResource;
use App\Http\Resources\Api\NationalityResource;
use App\Http\Resources\Api\QuestionsResource;
use App\Models\Auction;
use App\Models\Category;
use App\Models\City;
use App\Models\CommonQuestion;
use App\Models\Nationality;
use Illuminate\Http\Request;

class NationalityController extends PARENT_API
{
    public function nationalities()
    {
        $nationalities = Nationality::all();
        return responseJson('true', trans('api.all_nationalities'),NationalityResource::collection($nationalities) );  //OK don-successfully
    }

}
