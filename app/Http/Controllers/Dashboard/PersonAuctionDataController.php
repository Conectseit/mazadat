<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PersonAuctionDataController extends Controller
{
    public function store(Request $request)
    {
        $auction_data = AuctionData::where(['option_id'=>$request->option_id,'auction_id'=>$request->auction_id])->first();
        if($auction_data)
            return back()->with('class', 'success')->with('error', trans('messages.messages.sorry_this_option_added_before_select_another_one'));

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
