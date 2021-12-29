<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AuctionRequest;
use App\Http\Requests\Dashboard\OptionDetailRequest;
use App\Models\Auction;
use App\Models\AuctionBuyer;
use App\Models\AuctionData;
use App\Models\AuctionImage;
use App\Models\Category;
use App\Models\Option;
use App\Models\OptionDetail;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AuctionDataController extends Controller
{

    public function store(Request $request)
    {
        $auction_data=  AuctionData::where(['option_id'=>$request->option_id,'auction_id'=>$request->auction_id])->first();
        if($auction_data)
            return back()->with('class', 'success')->with('message', trans('messages.messages.sorry_this_detail_added_before'));

        AuctionData::create($request->all());
        return back()->with('class', 'success')->with('message', trans('messages.messages.added_successfully'));
    }

    public function delete_auction_data(Request $request)
    {
        $auctiondata = AuctionData::find($request->id);

        if (!$auctiondata) return response()->json(['deleteStatus' => false, 'error' => 'Sorry, data is not exists !!']);
        try {
            $auctiondata->delete();
            return response()->json(['deleteStatus' => true, 'message' => 'تم الحذف  بنجاح']);
        } catch (Exception $e) {
            return response()->json(['deleteStatus' => false, 'error' => 'Server Internal Error 500']);
        }
    }


}
