<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PARENT_API;
use App\Http\Resources\Api\CategoryAuctionsResource;
use App\Http\Resources\Api\CategoryResource;
use App\Http\Resources\Api\QuestionsResource;
use App\Models\Auction;
use App\Models\Category;
use App\Models\CommonQuestion;
use Illuminate\Http\Request;

class QuestionController extends PARENT_API
{
    public function index()
    {
        $questions = CommonQuestion::all();
        return responseJson('true', trans('api.all_questions'),QuestionsResource::collection($questions) );  //OK don-successfully
    }

}
