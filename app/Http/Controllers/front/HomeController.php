<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $about= 'about_app_'.app()->getLocale();
        $data['about_app'] = Setting::where('key',$about)->first()->value;
        $data['categories'] = Category::all();
        return view('front.home',$data);
    }
}
