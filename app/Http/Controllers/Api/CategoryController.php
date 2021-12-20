<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PARENT_API;
use App\Http\Resources\Api\CategoryAuctionsResource;
use App\Http\Resources\Api\CategoryResource;
use App\Models\Auction;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends PARENT_API
{
    public function index()
    {
        $categories = Category::all();
        return responseJson('200', trans('api.all_categories'), CategoryResource::collection($categories));  //OK don-successfully
    }

    public function categoryAuctions( Request $request ,$id)
    {
        $name = 'name_'.app()->getLocale();
        $query = Auction::query();
        if ($category = Category::where('id', $id)->find($id)) {

            if ($request->has('search_by_auction_name')) {
                $query->where($name, 'like', '%' . $request['search_by_auction_name'] . '%');
            }
            $category_auctions =$query->where('category_id', $id)->get();
//            $category_auctions = Auction::where('category_id', $id)->get();

            return responseJson('200', trans('api.all_category_auctions'), CategoryAuctionsResource::collection($category_auctions));  //OK don-successfully
        }
        return responseJson('400', trans('api.not_found_category'), []);  //
    }
}
