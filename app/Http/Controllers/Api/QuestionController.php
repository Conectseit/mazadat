<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PARENT_API;
use App\Http\Resources\Api\CategoryAuctionsResource;
use App\Http\Resources\Api\CategoryResource;
use App\Models\Auction;
use App\Models\Category;
use App\Models\CommonQuestion;
use Illuminate\Http\Request;

class QuestionController extends PARENT_API
{
    public function index()
    {
        $questions = CommonQuestion::all();
        return responseJson('200', trans('api.all_questions'), $questions);  //OK don-successfully
    }

}
