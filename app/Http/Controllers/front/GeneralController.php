<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\user\ContactRequest;
use App\Models\CommonQuestion;
use App\Models\Contact;
use App\Models\Setting;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function questions()
    {
        $data['questions'] = CommonQuestion::all();
        $about= 'about_app_'.app()->getLocale();
        $data['about_app'] = Setting::where('key',$about)->first()->value;
        return view('front.general.questions', $data);
    }
    public function about_app()
    {
        $about= 'about_app_'.app()->getLocale();
        $data['about_app'] = Setting::where('key',$about)->first()->value;
        return view('front.general.about_app', $data);
    }

    public function contact_us(ContactRequest $request)
    {
         Contact::create($request->all());
        return back()->with('success', trans('messages.added_success'));
    }
}
