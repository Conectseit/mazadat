<?php

namespace App\Http\Controllers\Api\Auctions;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\AuctionResource;
use App\Models\Auction;
use App\Models\User;
use App\Models\WatchedAuction;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
    public function auction($id)
    {
        if ($auction = Auction::where('id', $id)->find($id)) {
            $auction->get();
            return responseJson('200', trans('api.auction_details'), new AuctionResource($auction));  //OK don-successfully
        }
        return responseJson('400', trans('api.not_found_auction'), []);  //
    }




    public function watch_auction(Request $request, $id)
    {
        if ($auction = Auction::find($id))
        {
            if ($auction)
            {
                $watch=WatchedAuction::where(['auction_id' => $auction->id, 'user_id' => auth()->user()->id])->first();
                if (is_null($watch)){
                    WatchedAuction::create(['auction_id' => $auction->id, 'user_id' => auth()->user()->id]);
                }else{
                    $watch->delete();
                }

                return response()->json(
                    ['status'=>'success' , 'message'=> trans('api.request-done-successfully'), 'data'=>trans('crud.success.stoore')], 200); //OK
            }
            return responseJson('400', trans('api.User has been found but it is not a user'), []); //BAD_REQUEST
        }
        return responseJson('400', trans('api.not_found_auction'), []);  //NOT_FOUND

    }



    public function watched_auctions($id)
    {
        if ($auction = Auction::where('id', $id)->find($id)) {
            $auction->get();
            return responseJson('200', trans('api.auction_details'), new AuctionResource($auction));  //OK don-successfully
        }
        return responseJson('400', trans('api.not_found_auction'), []);  //
    }
}
