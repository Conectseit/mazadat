<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\CommonQuestion;
use App\Models\Setting;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function questions()
    {
        $data['questions'] = CommonQuestion::all();
        return view('front.general.questions', $data);
    }
    public function about_app()
    {
        $about= 'about_app_'.app()->getLocale();
        $data['about_app'] = Setting::where('key',$about)->first()->value;
        return view('front.general.about_app', $data);
    }
}
