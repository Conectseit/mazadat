<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\AuctionImage;
use App\Models\Category;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
    public function auction_details($id)
    {
        $data['auction'] = Auction::where('id', $id)->first();
        $data['images'] = AuctionImage::where(['auction_id' => $id])->get();
        return view('front.auctions.auction_details',$data);
    }

    public function categoryAuctions($id)
    {
        $data['auctions'] = Auction::where('category_id', $id)->get();
        $data['category'] = Category::where('id', $id)->first();

        return view('front.auctions.category_auctions',$data);
    }
}
