<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PARENT_API;
use App\Http\Requests\Api\AuctionsStatusRequest;
use App\Http\Resources\Api\CategoryAuctionsResource;
use App\Http\Resources\Api\CategoryResource;
use App\Http\Resources\Api\collections\AuctionsCollection;
use App\Http\Resources\Api\collections\CompanyAuctionsCollection;
use App\Http\Resources\Api\CompaniesResource;
use App\Http\Resources\Api\CompanyAuctionsResource;
use App\Models\Auction;
use App\Models\Category;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryController extends PARENT_API
{
    public function index()
    {
        $categories = Category::all();
        if ($categories->count() > 0) {
            return responseJson(true, trans('api.all_categories'), CategoryResource::collection($categories));  //OK don-successfully
        }
        return responseJson(false, trans('api.there_is_no_category_yet'), null);  //
    }

    public function categoryAuctions(Request $request, $id)
    {
//        $appearance_of_ended_auctions = Setting::where('key', 'appearance_of_ended_auctions')->first()->value;

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
            if ($request->status == 'done') {
//                if ($appearance_of_ended_auctions == 'yes') {
                $category_auctions = $query->where('category_id', $id)->where('status', 'done')->where('is_accepted', 1)->paginate(10);

                if ($category_auctions->count() > 0) {
                    return responseJson(true, trans('api.all_category_auctions'), new AuctionsCollection($category_auctions));  //OK don-successfully
//                        return responseJson(true, trans('api.all_category_auctions'), CategoryAuctionsResource::collection($category_auctions));  //OK don-successfully
                }
                return responseJson(false, trans('api.there_is_no_ended_auctions_on_this_category'), null);  //

//                } else {
//                    return responseJson(false, trans('api.management_not_allowed_to_appear_ended_auctions'), null);
//                }
// ==================================
            } else
                $category_auctions = $query->where('category_id', $id)->where('status', 'on_progress')->where('is_accepted', 1)->paginate(10);
//                $category_auctions = $query->where('category_id', $id)->where('status', 'on_progress')->where('is_accepted',1)->get();

            if ($category_auctions->count() > 0) {
                return responseJson(true, trans('api.all_category_auctions'), new AuctionsCollection($category_auctions));  //OK don-successfully
//                return responseJson(true, trans('api.all_category_auctions'), CategoryAuctionsResource::collection($category_auctions));  //OK don-successfully
            }
            return responseJson(false, trans('api.there_is_no_on_progress_auctions_on_this_category'), null);  //
        }
        return responseJson(false, trans('api.not_found_category'), null);  //
    }


    public function uniqueAuctions()
    {
        $featured_auctions = Auction:: where('is_unique', 1)->latest()->get();

        if ($featured_auctions->count() > 0) {
            return responseJson(true, trans('api.all_category_auctions'), CategoryAuctionsResource::collection($featured_auctions));
        }
        return responseJson(false, trans('api.there_is_no_unique_auctions_on_this_category'), null);  //
    }

    public function all_companies()
    {
//        $companies = User::where('is_company','company')->get();
        $companies = User::where(['is_company' => 'company'])->whereHas('seller_auctions')->get();

        if ($companies->count() > 0) {
            return responseJson(true, trans('api.all_companies'), CompaniesResource::collection($companies));  //OK don-successfully
        }
        return responseJson(false, trans('api.there_is_no_companies_yet'), null);
    }

    public function companyAuctions(Request $request, $id)
    {
        $company_data = User::where('id', $id)->first();
        $appearance_of_ended_auctions = Setting::where('key', 'appearance_of_ended_auctions')->first()->value;

        $name = 'name_' . app()->getLocale();
        $query = Auction::query();
        if ($company = User::where('id', $id)->find($id)) {

            if ($request->status == 'done') {
                $company_auctions = $query->where('seller_id', $id)->where('status', 'done')->paginate(10);
                if ($company_auctions->count() > 0) {
                    $data = [
                        'company_name' => $company_data->user_name,
                        'company_logo' => $company_data->image_path,
                        'company_auctions' => new CompanyAuctionsCollection($company_auctions),
//                            'company_auctions' => CompanyAuctionsResource::collection($company_auctions),
                    ];
                    return responseJson(true, trans('api.all_company_auctions'), $data);  //OK don-successfully
//                        return responseJson(true, trans('api.all_company_auctions'), CompanyAuctionsResource::collection($company_auctions));  //OK don-successfully
                }
                return responseJson(false, trans('api.there_is_no_ended_auctions_on_this_company'), null);  //

            } else
                $company_auctions = $query->where('seller_id', $id)->where('status', 'on_progress')->paginate(10);
            if ($company_auctions->count() > 0) {

                $data = [
                    'company_name' => $company_data->user_name,
                    'company_logo' => $company_data->image_path,
                    'company_auctions' => new CompanyAuctionsCollection($company_auctions),
//                    'company_auctions' => CompanyAuctionsResource::collection($company_auctions),
                ];
                return responseJson(true, trans('api.all_company_auctions'), $data);  //OK don-successfully
//                return responseJson(true, trans('api.all_company_auctions'), CompanyAuctionsResource::collection($company_auctions));  //OK don-successfully
            }
            return responseJson(false, trans('api.there_is_no_on_progress_auctions_on_this_company'), null);  //
        }
        return responseJson(false, trans('api.not_found_company'), null);  //
    }

}
