<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PARENT_API;
use App\Http\Requests\Api\AuctionsStatusRequest;
use App\Http\Resources\Api\CategoryAuctionsResource;
use App\Http\Resources\Api\CategoryResource;
use App\Models\Auction;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Http\Request;

class CategoryController extends PARENT_API
{
    public function index()
    {
        $categories = Category::all();
        return responseJson(true, trans('api.all_categories'), CategoryResource::collection($categories));  //OK don-successfully
    }

    public function categoryAuctions(Request $request, $id)
    {
        $appearance_of_ended_auctions = Setting::where('key', 'appearance_of_ended_auctions')->first()->value;

        $name = 'name_' . app()->getLocale();
        $query = Auction::query();
        if ($category = Category::where('id', $id)->find($id)) {
            if ($request->has('search_by_auction_name')) {
                $query->where($name, 'like', '%' . $request['search_by_auction_name'] . '%');
            }
//                if($request->on_progress){
//                    $query->where('status', 'on_progress');
//                }

// =========== for appear ended auctions
            if ($request->status=='done') {
                if ($appearance_of_ended_auctions == 'yes') {
                $category_auctions = $query->where('category_id', $id)->where('status', 'done')->get();
            }else{
                    return responseJson(false, trans('api.management_not_allowed_to_appear_ended_auctions'), null);
                }
// ==================================
            } else
            $category_auctions = $query->where('category_id', $id)->where('status', 'on_progress')->get();

            if ($category_auctions->count() > 0) {
                return responseJson(true, trans('api.all_category_auctions'), CategoryAuctionsResource::collection($category_auctions));  //OK don-successfully
            }
            return responseJson(false, trans('api.there_is_no_auctions_on_this_category'), null);  //
        }
        return responseJson(false, trans('api.not_found_category'), null);  //
    }
}
