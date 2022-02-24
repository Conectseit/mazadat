<?php

namespace App\Http\Controllers\Api\advertisemen;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\advertisement\AdvertisementResource;
use App\Models\Advertisement;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function advertisements()
    {
        $advertisements = Advertisement::all();
        return responseJson(true, trans('api.all_advertisements'),AdvertisementResource::collection($advertisements) );  //OK don-successfully
    }
}
