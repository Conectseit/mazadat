<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\AuctionImage;
use App\Models\Category;
use App\Models\User;
use App\Models\WatchedAuction;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
    public function auction_details($id)
    {
        $data['auction'] = Auction::where('id', $id)->first();
        $data['images'] = AuctionImage::where(['auction_id' => $id])->get();
        return view('front.auctions.auction_details',$data);
    }
    public function make_bid($id)
    {
        dd('ll');
//        $data['auction'] = Auction::where('id', $id)->first();
//        $data['images'] = AuctionImage::where(['auction_id' => $id])->get();
//        return view('front.auctions.auction_details',$data);
    }

    public function categoryAuctions($id)
    {
        $data['auctions'] = Auction::where('category_id', $id)->get();
        $data['category'] = Category::where('id', $id)->first();
        return view('front.auctions.category_auctions',$data);
    }

    public function my_watched()
    {

        $data['auctions'] =  auth()->user()->auctions()->get();
        return view('front.user.my_watched_auctions', $data);
    }
    public function my_bids()
    {
        $data['auctions'] =  auth()->user()->bidauctions()->get();
        return view('front.user.my_bids', $data);
    }



    public  function watch_auction (Auction $auction)
    {
        $check = checkIsUserWatch($auction);
        if((boolean)$check->count())
        {
            $check->delete();
            return back();
        }
        WatchedAuction::create([
            'user_id' => auth()->user()->id,
            'auction_id' => $auction->id,
        ]);
        return back();
    }
}
