<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Auction;
use App\Models\Category;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function cronjob()
    {
        $on_progress_auctions = Auction::query()
//            ->where('status','!=','done')->get();
            ->where('status','=','on_progress')->where('end_date','<=' ,Carbon::now())->get();

        foreach ($on_progress_auctions as $auction)
        {
            if(!$auction->end_date->isPast()) continue;
//            if($auction->end_date <= Carbon::now()) continue;
            $auction->update(['status'=>'done']);
        }
    }

    public function cronJobAppearAuctions()
    {
        $auctions = Auction::query()
            ->where('status','not_accepted')->where('is_accepted','1')->where('start_date','>=' ,Carbon::now())->get();

        foreach ($auctions as $auction)
        {
//            $auction->update(['is_appear'=>'1']);
            $auction->update(['status'=>'on_progress']);
        }
    }


    public function home()
    {
        $data['categories'] = Category::all();
        $data['advertisements'] = Advertisement::all();
        return view('front.home',$data);
    }

    public function all_companies()
    {
//        $data['companies'] = User::where(['is_company'=>'company','type'=>'seller'])->get();
        $companies = User::where('is_company','company')->whereHas('seller_auctions', function ($qu){
            return $qu->where('status', '!=', 'not_accepted');
        })->get();


        return view('front.company.all_companies', compact('companies'));
    }

    public function companyAuctions(Request $request, $id)
    {
        $data['company'] = User::where('id', $id)->first();
        if ($data['company']) {
            $data['on_progress_auctions'] =Auction::where('seller_id', $id)->where('status', 'on_progress')->where('is_accepted',1)->paginate('20');
            $data['ended_auctions'] =Auction::where('seller_id', $id)->where('status', 'done')->where('is_accepted',1)->paginate('20');
        }

        return view('front.company.company_auctions',$data);

    }
}





//public function home()
//{
//        $about= 'about_app_'.app()->getLocale();
//        $data['about_app'] = Setting::where('key',$about)->first()->value;

//        $data['facebook'] = Setting::where('key','facebook_url')->first()->value;
//        $data['twitter'] = Setting::where('key','twitter_url')->first()->value;
//        $data['instagram'] = Setting::where('key','instagram_url')->first()->value;
//        $data['youtube'] = Setting::where('key','youtube_url')->first()->value;
//    $data['categories'] = Category::all();
//    $data['advertisements'] = Advertisement::all();
//    return view('front.home',$data);


//        $settings = Setting::get();
//        $about= 'about_app_'.app()->getLocale();
//        $about_app= $settings->where('key', $about)->first()->value;
//        $facebook = $settings->where('key', 'facebook_url')->first()->value;
//        $twitter = $settings->where('key', 'twitter_url')->first()->value;
//        $instagram = $settings->where('key', 'instagram_url')->first()->value;
//        $categories= Category::all();
//        return view('front.home',compact('categories','about_app','facebook','twitter','instagram'));

//}
