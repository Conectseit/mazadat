<?php

namespace App\Http\Controllers\Api\Auctions;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PARENT_API;
use App\Http\Requests\Api\user\FilterRequest;
use App\Http\Resources\Api\CategoryOptionsResource;
use App\Http\Resources\Api\collections\AuctionsCollection;
use App\Http\Resources\Api\UserAuctionsResource;
use App\Models\Auction;
use App\Models\AuctionData;
use App\Models\Category;
use App\Models\Option;
use Illuminate\Http\Request;

class FilterController extends PARENT_API
{
    public function main_filter(Request $request, $id)
    {
        $query = Auction::query();

        $category = Category::find($id);

        if (!$category) return responseJson(false, trans('api.not_found_category'), null);
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

                $auctions = $query->where('category_id', $id)->where('status', 'on_progress')->paginate(10);

                if ($auctions->count() > 0) {
                    return responseJson(true, trans('api.all_category_auctions'), new AuctionsCollection($auctions));  //OK don-successfully
//                    return responseJson(true, trans('api.all_category_auctions'), CategoryAuctionsResource::collection($auctions));
                }
                return responseJson(false, trans('api.there_is_no_auctions_on_this_category'), null);
//            }
    }

    public function get_options_of_category(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return responseJson(false, trans('api.not_found_category'), null);  //
        }
//        $category_options = Option::where('category_id', $id)->where('is_required',1)->with('option_details')->get();
        $category_options = Option::where('category_id', $id)->with('option_details')->get();
        return responseJson(true, trans('api.category_options'), CategoryOptionsResource::collection($category_options));  //OK
    }


//    public function get_not_required_options_of_category(Request $request, $id)
//    {
//        $category = Category::find($id);
//        if (!$category) {
//            return responseJson(false, trans('api.not_found_category'), null);  //
//        }
//        $category_options = Option::where('category_id', $id)->where('is_required',0)->with('option_details')->get();
//        return responseJson(true, trans('api.category_options'), CategoryOptionsResource::collection($category_options));  //OK
//    }


    public function filterCategory(FilterRequest $request, $id)
    {
        $category = Category::where('id', $id)->find($id);
        if (!$category) {
            return responseJson(false, trans('api.not_found_category'), null);  //
        }

        $auctions_count = Auction::where('category_id', $id)->where('status', 'on_progress')->latest()->count();

        if ($auctions_count == 0) {
            return responseJson(false, trans('api.there_is_no_auctions_on_this_category'), null);  //
        }

        $auctions_ids = AuctionData::whereIn('option_details_id', $request->option_details_id)->get()->pluck('auction_id')->toArray();
//        $auctions_ids = AuctionData::where('option_id', $request->option_id)->whereIn('option_details_id', $request->option_details_id)->get()->pluck('auction_id')->toArray();

        $auctions = Auction::find($auctions_ids)->paginate(10);

        if ($auctions->count() > 0) {
            return responseJson(true, trans('api.all_category_auctions'), new AuctionsCollection($auctions));  //OK don-successfully

//            return responseJson(true, trans('api.category_auctions'), CategoryAuctionsResource::collection($auctions));  //OK
        }
        return responseJson(false, trans('api.there_is_no_auctions_on_this_option'), null);  //OK
    }

}




