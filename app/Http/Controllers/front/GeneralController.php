<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\user\AuthContactRequest;
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
//        $about= 'site_about_app_'.app()->getLocale();
//        $data['site_about_app'] = Setting::where('key',$about)->first()->value;
        return view('front.general.questions', $data);
    }


    public function about_app()
    {
        $site_about_app= 'site_about_app_'.app()->getLocale();
        $data['site_about_app'] = Setting::where('key',$site_about_app)->first()->value;
        return view('front.general.about_app', $data);
    }



    public function condition_and_terms()
    {
        $site_conditions_terms= 'site_conditions_terms_'.app()->getLocale();
        $data['site_conditions_terms'] = Setting::where('key',$site_conditions_terms)->first()->value;
        return view('front.general.condition_and_terms', $data);
    }



    public function privacy()
    {
        $site_privacy = 'site_privacy_' . app()->getLocale();
        $data['site_privacy'] = Setting::where('key', $site_privacy)->first()->value;
        return view('front.general.privacy', $data);
    }



    public function description()
    {
        $app_description= 'app_description_'.app()->getLocale();
        $data['app_description'] = Setting::where('key',$app_description)->first()->value;
        return view('front.general.description', $data);
    }



    public function contact_us(ContactRequest $request)
    {
         Contact::create($request->all());
        return back()->with('success', trans('messages.messages.send_successfully'));
    }

    public function auth_contact(AuthContactRequest $request)
    {
        $contact = Contact::create($request->all()+[
                'full_name'=>auth()->user()->full_name,
                'mobile'=>auth()->user()->mobile,
                'email'=>auth()->user()->email,
            ]);
        return back()->with('success', trans('messages.messages.send_successfully'));
    }
}
