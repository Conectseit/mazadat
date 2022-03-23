<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('Dashboard.Settings.index');
    }

    public function update(Request $request)
    {

        if ($request->project_name_ar)
            Setting::where('key', 'project_name_ar')->update(['value' => $request->project_name_ar]);
        if ($request->project_name_en)
            Setting::where('key', 'project_name_en')->update(['value' => $request->project_name_en]);
        if ($request->app_description_ar)
            Setting::where('key', 'app_description_ar')->update(['value' => $request->app_description_ar]);
        if ($request->app_description_en)
            Setting::where('key', 'app_description_en')->update(['value' => $request->app_description_en]);
        if ($request->mobile)
            Setting::where('key', 'mobile')->update(['value' => $request->mobile]);
        if ($request->email)
            Setting::where('key', 'email')->update(['value' => $request->email]);
        if ($request->fax)
            Setting::where('key', 'fax')->update(['value' => $request->fax]);
        if ($request->address)
            Setting::where('key', 'address')->update(['value' => $request->address]);

        if ($request->latitude)
            Setting::where('key', 'latitude')->update(['value' => $request->latitude]);
        if ($request->longitude)
            Setting::where('key', 'longitude')->update(['value' => $request->longitude]);



        if ($request->bank_name_ar)
            Setting::where('key', 'bank_name_ar')->update(['value' => $request->bank_name_ar]);
        if ($request->bank_name_en)
            Setting::where('key', 'bank_name_en')->update(['value' => $request->bank_name_en]);
        if ($request->account_name)
            Setting::where('key', 'account_name')->update(['value' => $request->account_name]);
        if ($request->account_number)
            Setting::where('key', 'account_number')->update(['value' => $request->account_number]);
        if ($request->iban)
            Setting::where('key', 'iban')->update(['value' => $request->iban]);
        if ($request->branch)
            Setting::where('key', 'branch')->update(['value' => $request->branch]);
        if ($request->branch)
            Setting::where('key', 'swift_code')->update(['value' => $request->swift_code]);
        if ($request->branch)
            Setting::where('key', 'routing_number')->update(['value' => $request->routing_number]);





        if ($request->facebook_url)
            Setting::where('key', 'facebook_url')->update(['value' => $request->facebook_url]);
        if ($request->twitter_url)
            Setting::where('key', 'twitter_url')->update(['value' => $request->twitter_url]);
        if ($request->youtube_url)
            Setting::where('key', 'youtube_url')->update(['value' => $request->youtube_url]);
        if ($request->instagram_url)
            Setting::where('key', 'instagram_url')->update(['value' => $request->instagram_url]);
        if ($request->whatsapp_phone)
            Setting::where('key', 'whatsapp_phone')->update(['value' => $request->whatsapp_phone]);
        if ($request->about_app_ar)
            Setting::where('key', 'about_app_ar')->update(['value' => $request->about_app_ar]);
        if ($request->about_app_en)
            Setting::where('key', 'about_app_en')->update(['value' => $request->about_app_en]);
        if ($request->conditions_terms_ar)
            Setting::where('key', 'conditions_terms_ar')->update(['value' => $request->conditions_terms_ar]);
        if ($request->conditions_terms_en)
            Setting::where('key', 'conditions_terms_en')->update(['value' => $request->conditions_terms_en]);


        // online_payment_conditions
        if ($request->online_payment_conditions_ar)
            Setting::where('key', 'online_payment_conditions_ar')->update(['value' => $request->online_payment_conditions_ar]);
        if ($request->online_payment_conditions_en)
            Setting::where('key', 'online_payment_conditions_en')->update(['value' => $request->online_payment_conditions_en]);



//        if ($request->min_time_unit)
//            Setting::where('key', 'min_time_unit')->update(['value' => $request->min_time_unit]);
//
//        if ($request->min_duration_of_auction)
//            Setting::where('key', 'min_duration_of_auction')->update(['value' => $request->min_duration_of_auction]);
//
//        if ($request->max_time_unit)
//            Setting::where('key', 'max_time_unit')->update(['value' => $request->max_time_unit]);
//        if ($request->max_duration_of_auction)
//            Setting::where('key', 'max_duration_of_auction')->update(['value' => $request->max_duration_of_auction]);

        if ($request->appearance_of_ended_auctions)
            Setting::where('key', 'appearance_of_ended_auctions')->update(['value' => $request->appearance_of_ended_auctions]);

//        if ($request->google_map_key)
//            Setting::where('key', 'google_map_key')->update(['value' => $request->google_map_key]);

        return redirect()->route('settings.index')->with('message', trans('messages.messages.updated_successfully'));;
    }

}
