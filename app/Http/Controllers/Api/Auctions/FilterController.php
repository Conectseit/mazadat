<?php

namespace App\Http\Controllers\Api\Auctions;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PARENT_API;
use App\Http\Resources\Api\CategoryAuctionsResource;
use App\Http\Resources\Api\CategoryResource;
use App\Models\Auction;
use App\Models\Category;
use Illuminate\Http\Request;

class FilterController extends PARENT_API
{


    public function filter(Request $request, $id)
    {
        $category = Category::where('id', $id)->find($id);
        if (!$category) {
            return responseJson('400', trans('api.not_found_category'), []);  //
        }
        $auctions = Auction::where('category_id', $id)->latest()->get();
        if ($auctions->count() == 0) {
            return responseJson('400', trans('api.there_is_no_auctions_on_this_category'), []);  //
        }
        if ($request->less_price) {
            $auctions = Auction::OrderBy('start_auction_price', 'asc')->get();
        }
        if ($request->high_price) {
            $auctions = Auction::OrderBy('start_auction_price', 'desc')->get();
        }
        if ($request->less_bids) {
            $auctions = Auction::OrderBy('count_of_buyer', 'asc')->get();
        }
        if ($request->high_bids) {
            $auctions = Auction::OrderBy('count_of_buyer', 'desc')->get();
        }
//        if ($request->less_ending) {
//            $auctions = Auction::where('remaining_time','!=',null)->OrderBy('remaining_time', 'asc')->get();
//        }
        return responseJson('200', trans('api.all_category_auctions'), CategoryAuctionsResource::collection($auctions));  //OK

    }




    public function filter_category(Request $request, $id)
    {
        $category = Category::where('id', $id)->find($id);
        if (!$category) {
            return responseJson('400', trans('api.not_found_category'), []);  //
        }
        foreach ($category->options as $option){
            dd($option);
        }
    }


//    public function filter(Request $request, $id)
//    {
//        $query = Auction::query();
//        if ($category = Category::where('id', $id)->find($id)) {
//
////            if ($request->has('search_by_name')) {
////                $query->where('name', 'like', '%' . $request['search_by_name'] . '%');
////            }
//            if ($request->less_price) {
//                $query->OrderBy('start_auction_price', 'asc');
//            }
//            if ($request->high_price) {
//                $query->OrderBy('start_auction_price', 'desc');
//            }
//            $auctions= $query->where('category_id', $id)->get();
//            return responseJson('200', trans('api.all_category_auctions'), CategoryAuctionsResource::collection($auctions));  //OK don-successfully
//        }
//        return responseJson('400', trans('api.not_found_category'), []);  //
//    }


//
//    public function Filter(FilterRequest $request )
//    {
//
//        $max_price = Auction::max('start_auction_price');
//        $min_price = Auction::min('start_auction_price');
//
//        $auctions=Auction::
//        when($request->company_name ,function($q) use ($request){
//            $q->where('company_name','like','%'.$request['company_name'].'%');
//        })->when($request->model ,function($q) use ($request){
//            $q->where('model', $request['model']);
//        })->when($request->production_year ,function($q) use ($request){
//            $q->where('production_year', $request['production_year']);
//        })->when($request->status ,function($q) use ($request){
//            $q->where('status', $request['status']);
//        })->when($request->serial ,function($q) use ($request){
//            $q->where('serial', $request['serial']);
//        })->when($request->price ,function($q) use ($request,$max_price,$min_price){
//            $q-> whereBetween('price', [$min_price, $max_price]);
//        })->get();
//
//
//        return responseJson('200', trans('api.all_category_auctions'), CategoryAuctionsResource::collection($auctions));  //OK done
//
//    }


}
