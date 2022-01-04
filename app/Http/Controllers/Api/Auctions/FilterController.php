<?php

namespace App\Http\Controllers\Api\Auctions;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PARENT_API;
use App\Http\Resources\Api\CategoryAuctionsResource;
use App\Http\Resources\Api\CategoryOptionsResource;
use App\Http\Resources\Api\CategoryResource;
use App\Http\Resources\Api\UserAuctionsResource;
use App\Models\Auction;
use App\Models\AuctionData;
use App\Models\Category;
use App\Models\Option;
use App\Models\Setting;
use Illuminate\Http\Request;

class FilterController extends PARENT_API
{
    public function main_filter(Request $request, $id)
    {
        $appearance_of_ended_auctions = Setting::where('key', 'appearance_of_ended_auctions')->first()->value;
//        $name = 'name_' . app()->getLocale();
        $query = Auction::query();

        $category = Category::find($id);

        if (!$category) return responseJson(false, trans('api.not_found_category'), null);  //
//        if ($request->has('search_by_name')) {
//            $query->where($name, 'like', '%' . $request['search_by_name'] . '%');
//        }
        if ($request->has('less_price')) {
            $query->orderBy('start_auction_price', 'DESC');
        }
        if ($request->has('high_price')) {
            $query->orderBy('start_auction_price', 'ASC');
        }
        if ($request->has('less_bids')) {
            $query->orderBy('count_of_buyer', 'DESC');
        }
        if ($request->has('less_ending')) {
            $query->orderBy('end_date', 'DESC');
        }
        if($request->has('high_bids') && $request->has('high_ending')) {
            $query->orderBy('count_of_buyer', 'desc');
            $query->orderBy('end_date', 'desc');
        }
        elseif ($request->has('high_bids') && !$request->has('high_ending')){
            $query->orderBy('count_of_buyer', 'desc');
        }
        elseif (!$request->has('high_bids') && $request->has('high_ending')){
            $query->orderBy('end_date', 'desc');
        }
//// =========== for appear ended auctions
//        if ($request->status == 'done') {
//            if ($appearance_of_ended_auctions == 'yes') {
//                $auctions = $query->where('category_id', $id)->where('status', 'done')->get();
//                if ($auctions->count() == 0) {
//                    return responseJson(false, trans('api.there_is_no_auctions_on_this_category'), null);  //
//                }
//                return responseJson(true, trans('api.all_category_auctions'), CategoryAuctionsResource::collection($auctions));
//            } else {
//                    return responseJson(false, trans('api.management_not_allowed_to_appear_ended_auctions'), null);
//                }
//// ==================================
//            } else {
                $auctions = $query->where('category_id', $id)->where('status', 'on_progress')->get();

                if ($auctions->count() > 0) {
                    return responseJson(true, trans('api.all_category_auctions'), CategoryAuctionsResource::collection($auctions));
                }
                return responseJson(false, trans('api.there_is_no_auctions_on_this_category'), null);
//            }
    }

    public function get_options_of_category(Request $request, $id)
    {
        $category = Category::where('id', $id)->find($id);
        if (!$category) {
            return responseJson(false, trans('api.not_found_category'), null);  //
        }
        $category_options = Option::where('category_id', $id)->with('option_details')->get();
        return responseJson(true, trans('api.category_options'), CategoryOptionsResource::collection($category_options));  //OK
//        return responseJson(true, trans('api.category_options'), CategoryOptionsResource::collection($category->options));  //OK

    }


    public function filter_category(Request $request, $id)
    {
        $category = Category::where('id', $id)->find($id);
        if (!$category) {
            return responseJson(false, trans('api.not_found_category'), null);  //
        }
        $auctions = Auction::where('category_id', $id)->latest()->get();
        if ($auctions->count() == 0) {
            return responseJson(false, trans('api.there_is_no_auctions_on_this_category'), null);  //
        }
//        $option_details= [];
//        $data = AuctionData::whereIn('option_details_id',$option_details);
        $data = AuctionData::where('option_details_id', $request->option_details_id)->get();
        foreach ($data as $auction){
           $auctions= $auction->auction->where('status','on_progress')->get();
        }

        if ($auctions->count()>0) {
            return responseJson(true, trans('api.category_auctions'), CategoryAuctionsResource::collection($auctions));  //OK
//            return responseJson(true, trans('api.category_auctions'), UserAuctionsResource::collection($data));  //OK
        }
        return responseJson(true, trans('api.there_is_no_auctions_on_this_option'), null);  //OK

//                    $auctions = Auction::where('id')->get();
    }










    //    public function filterr(Request $request, $id)
    //    {
    //        $category = Category::where('id', $id)->find($id);
    //        if (!$category) {
    //            return responseJson(false, trans('api.not_found_category'), null);  //
    //        }
    //        $auctions = Auction::where('category_id', $id)->latest()->get();
    //        if ($auctions->count() == 0) {
    //            return responseJson(false, trans('api.there_is_no_auctions_on_this_category'), null);  //
    //        }
    //
    //        if ($request->less_price) {
    //            $auctions = Auction::OrderBy('start_auction_price', 'asc')->get();
    //        }
    //        if ($request->high_price) {
    //            $auctions = Auction::OrderBy('start_auction_price', 'desc')->get();
    //        }
    //        if ($request->less_bids) {
    //            $auctions = Auction::OrderBy('count_of_buyer', 'asc')->get();
    //        }
    //        if ($request->high_bids) {
    //            $auctions = Auction::OrderBy('count_of_buyer', 'desc')->get();
    //        }
    //
    //        if ($request->less_ending) {
    //            $auctions = Auction::where('status','on_progress')->OrderBy('end_date', 'asc')->get();
    //        }
    //
    //        return responseJson(true, trans('api.all_category_auctions'), CategoryAuctionsResource::collection($auctions));  //OK
    //
    //    }

}
