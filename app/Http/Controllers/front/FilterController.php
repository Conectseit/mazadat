<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\auction\FilterRequest;
use App\Http\Resources\Api\CategoryAuctionsResource;
use App\Models\Auction;
use App\Models\AuctionData;
use App\Models\Category;
use App\Models\Option;
use Illuminate\Http\Request;
use PHPUnit\Util\Filter;

class FilterController extends Controller
{

    public function filterCategory(FilterRequest $request, $id)
    {
        $auctions_ids = AuctionData::whereIn('option_details_id', $request->option_detail_id)->get()->pluck('auction_id')->toArray();

        $data['auctions'] = Auction::find($auctions_ids);
        $data['category'] = Category::find($id);
        $data['category_options'] = Option::where('category_id', $id)->with('option_details')->get();
        return view('front.auctions.category_auctions',$data);
    }

    public function main_filter(Request $request, $id)
    {
        dd($request->all());
        $query = Auction::query();
        $data['category'] = Category::find($id);
        $data['category_options'] = Option::where('category_id', $id)->with('option_details')->get();


        if ($request->has('less_price')) {
            $query->orderBy('start_auction_price', 'ASC');
        }
        if ($request->has('high_price')) {
            $query->orderBy('start_auction_price', 'DESC');
        }
        if ($request->has('less_bids')) {
            $query->orderBy('count_of_buyer', 'ASC');
        }
        if ($request->has('high_bids')) {
            $query->orderBy('count_of_buyer', 'DESC');
        }
        if ($request->has('less_ending')) {
            $query->orderBy('end_date', 'ASC');
        }
        if ($request->has('high_ending')) {
            $query->orderBy('end_date', 'DESC');
        }

        $data['auctions'] = $query->where('category_id', $id)->where('status', 'on_progress')->get();
        return view('front.auctions.category_auctions',$data);

    }



}
