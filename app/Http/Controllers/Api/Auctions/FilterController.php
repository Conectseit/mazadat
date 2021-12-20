<?php

namespace App\Http\Controllers\Api\Auctions;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PARENT_API;
use App\Http\Resources\Api\CategoryAuctionsResource;
use App\Http\Resources\Api\CategoryOptionsResource;
use App\Http\Resources\Api\CategoryResource;
use App\Models\Auction;
use App\Models\Category;
use Illuminate\Http\Request;

class FilterController extends PARENT_API
{


    public function get_options_of_category(Request $request, $id)
    {
        $category = Category::where('id', $id)->find($id);
        if (!$category) {
            return responseJson('400', trans('api.not_found_category'), []);  //
        }
        return responseJson('200', trans('api.this_category_options'), CategoryOptionsResource::collection($category->options));  //OK

    }


    public function filter_category(Request $request, $id)
    {
        $category = Category::where('id', $id)->find($id);
        if (!$category) {
            return responseJson('400', trans('api.not_found_category'), []);  //
        }
        $auctions = Auction::where('category_id', $id)->latest()->get();
        if ($auctions->count() == 0) {
            return responseJson('400', trans('api.there_is_no_auctions_on_this_category'), []);  //
        }

        //        if ($request->category->options) {
        //            $auctions = Auction::where()->get();
        //        }
    }


    public function filter(Request $request, $id)
    {
        $name = 'name_' . app()->getLocale();
        $query = Auction::query();
        $category = Category::where('id', $id)->find($id);
        if (!$category) {
            return responseJson('400', trans('api.not_found_category'), []);  //
        }
        if ($request->has('search_by_name')) {
            $query->where($name, 'like', '%' . $request['search_by_name'] . '%');
        }
        if ($request->less_price) {
            $query->OrderBy('start_auction_price', 'asc');
        }
        if ($request->high_price) {
            $query->OrderBy('start_auction_price', 'desc');
        }
        if ($request->less_bids) {
            $query->OrderBy('count_of_buyer', 'asc');
        }
        if ($request->high_bids) {
            $query->OrderBy('count_of_buyer', 'desc');
        }
        if ($request->less_ending) {
            $query->OrderBy('end_date', 'asc');
        }
        if ($request->high_ending) {
            $query->OrderBy('end_date', 'desc');
        }
        $auctions = $query->where('category_id', $id)->where('status', 'on_progress')->get();
        if ($auctions->count() == 0) {
            return responseJson('400', trans('api.there_is_no_auctions_on_this_category'), []);  //
        }
        return responseJson('200', trans('api.all_category_auctions'), CategoryAuctionsResource::collection($auctions));  //OK don-successfully

    }







    //    public function filterr(Request $request, $id)
    //    {
    //        $category = Category::where('id', $id)->find($id);
    //        if (!$category) {
    //            return responseJson('400', trans('api.not_found_category'), []);  //
    //        }
    //        $auctions = Auction::where('category_id', $id)->latest()->get();
    //        if ($auctions->count() == 0) {
    //            return responseJson('400', trans('api.there_is_no_auctions_on_this_category'), []);  //
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
    //        return responseJson('200', trans('api.all_category_auctions'), CategoryAuctionsResource::collection($auctions));  //OK
    //
    //    }

}
