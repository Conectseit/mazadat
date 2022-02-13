<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\auction\SearchRequest;
use App\Models\Auction;
use App\Models\Category;
use App\Models\Option;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function categoryAuctions(Request $request, $id)
    {
        $name = 'name_' . app()->getLocale();
        $query = Auction::query();
        if ($category = Category::where('id', $id)->find($id)) {
            if ($request->has('search_by_auction_name')) {
                $query->where($name, 'like', '%' . $request['search_by_auction_name'] . '%');
            }
            $data['auctions'] = $query->where('category_id', $id)->where('status', 'on_progress')->paginate('2');
        }


//            $data['auctions'] = Auction::where('category_id', $id)->get();
        $data['category'] = Category::where('id', $id)->first();
        $data['category_options'] = Option::where('category_id', $id)->with('option_details')->get();

        return view('front.auctions.category_auctions',$data);
    }

//    public function search(SearchRequest $request,$id)
//    {
//        $name = 'name_' . app()->getLocale();
//        $data['auctions'] = Auction::where($name, 'like', '%'. $request->search .'%')->get();
//        $data['category'] = Category::where('id', $id)->first();
//        $data['category_options'] = Option::where('category_id', $id)->with('option_details')->get();
//
//        return view('front.auctions.category_auctions',$data);
//    }
}
