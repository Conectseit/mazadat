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
use Carbon\Carbon;

class HomeController extends Controller
{

    public function cronJobMakeAuctionOnProgress()
    {
        $auctions = Auction::where('status','not_accepted')
            ->where('is_accepted','1')->where('start_date' ,'<=', Carbon::now())->get();
        foreach ($auctions as $auction)
        {
//            if($auction->start_date <= Carbon::now())
                $auction->update(['status'=>'on_progress']);
        }
    }
    public function cronJobMakeAuctionDone()
    {
        $on_progress_auctions = Auction::where('status','on_progress')->where('end_date','<' , now())->get();
        foreach ($on_progress_auctions as $auction)
        {
                $auction->update(['status'=>'done']);
        }
    }

    public function expireActivationCode()
    {
        $users = User::where('activation_code' ,'!=',null)->get();
        foreach ($users as $user)
        {
            if(Carbon::parse($user->send_at)->addMinutes(5) < now())
            $user->update(['activation_code'=>null]);
        }
    }



//    public function cronJobAppearAuctions()
//    {
//        $auctions = Auction::query()
//            ->where('status','not_accepted')->where('is_accepted','1')->where('start_date','>=' ,Carbon::now())->get();
//
//        foreach ($auctions as $auction)
//        {
////            $auction->update(['is_appear'=>'1']);
//            $auction->update(['status'=>'on_progress']);
//        }
//    }

    public function home()
    {
        $data['categories'] = Category::all();
        $data['advertisements'] = Advertisement::all();
        return view('front.home',$data);
    }

    public function unique_auction()
    {
        $unique_auction = Auction::where('is_unique', 1)->get();
        return view('front.auctions.all_unique_auctions', compact('unique_auction'));
    }
    public function latest_auctions()
    {
        $latest_auctions=[];
        foreach(Category::has('auctions')->get() as $category){
            $latest_auctions =  $category->auctions->last()->get()->where('status','!=','not_accepted');
        }
        return view('front.auctions.latest_auctions', compact('latest_auctions'));
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
