<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
//    public function index()
//    {
//        return view('Dashboard.Settings.index',['settings' => Setting::all()]);
//        //return view('dashboard.Settings.index', ['settings' => Setting::all()]);
//    }
//
//    public function update(Request $request)
//    {
//
//        if ($request->project_name_ar)
//            Setting::where('key', 'project_name_ar')->update(['value' => $request->project_name_ar]);
//        if ($request->project_name_en)
//            Setting::where('key', 'project_name_en')->update(['value' => $request->project_name_en]);
//        if ($request->mobile)
//            Setting::where('key', 'mobile')->update(['value' => $request->mobile]);
//        if ($request->email)
//            Setting::where('key', 'email')->update(['value' => $request->email]);
//        if ($request->facebook_url)
//            Setting::where('key', 'facebook_url')->update(['value' => $request->facebook_url]);
//        if ($request->twitter_url)
//            Setting::where('key', 'twitter_url')->update(['value' => $request->twitter_url]);
//        if ($request->youtube_url)
//            Setting::where('key', 'youtube_url')->update(['value' => $request->youtube_url]);
//        if ($request->instagram_url)
//            Setting::where('key', 'instagram_url')->update(['value' => $request->instagram_url]);
//        if ($request->whatsapp_phone)
//            Setting::where('key', 'whatsapp_phone')->update(['value' => $request->whatsapp_phone]);
//        if ($request->about_ar)
//            Setting::where('key', 'about_ar')->update(['value' => $request->about_ar]);
//        if ($request->about_en)
//            Setting::where('key', 'about_en')->update(['value' => $request->about_en]);
//        if ($request->conditions_terms_ar)
//            Setting::where('key', 'conditions_terms_ar')->update(['value' => $request->conditions_terms_ar]);
//        if ($request->conditions_terms_en)
//            Setting::where('key', 'conditions_terms_en')->update(['value' => $request->conditions_terms_en]);
//
//        if ($request->max_duration_of_auction)
//            Setting::where('key', 'max_duration_of_auction')->update(['value' => $request->max_duration_of_auction]);
//        if ($request->min_duration_of_auction)
//            Setting::where('key', 'min_duration_of_auction')->update(['value' => $request->min_duration_of_auction]);
//        if ($request->google_map_key)
//            Setting::where('key', 'google_map_key')->update(['value' => $request->google_map_key]);
//
//        return redirect()->route('settings.index')->with('class', 'success')->with('message', trans('dash.messages.updated_successfully'));;
//    }
}
