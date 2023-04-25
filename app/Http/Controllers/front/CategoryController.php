<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\auction\SearchRequest;
use App\Models\Category;
use App\Models\Option;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function categoryAuctions(Request $request, Category $category)
    {
        $name = 'name_' . app()->getLocale();

        $auctions = $category->auctions;

        if ($request->has('search_by_auction_name'))
        {
            $_auctions = $category->auctions()->where($name, 'like', '%' . $request->search_by_auction_name . '%')->get();

            $data['on_progress_auctions'] = $_auctions->where('category_id', $category->id)->where('status', 'on_progress')->where('is_accepted',1)->paginate(20);

            $data['done_auctions'] = $_auctions->where('category_id', $category->id)->where('status', 'done')->paginate(20);
        }
        else
        {
            $data['on_progress_auctions'] = $auctions->where('category_id', $category->id)->where('status', 'on_progress')->where('is_accepted',1)->paginate(20);

            $data['done_auctions'] = $auctions->where('category_id', $category->id)->where('status', 'done')->paginate(20);
        }
        $data['category'] = $category;
        $data['category_options'] = Option::where('category_id', $category->id)->with('option_details')->get();

        return view('front.auctions.category_auctions',$data);
    }

}
