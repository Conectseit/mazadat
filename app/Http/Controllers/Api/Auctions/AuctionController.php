<?php

namespace App\Http\Controllers\Api\Auctions;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PARENT_API;
use App\Http\Resources\Api\AuctionResource;
use App\Http\Resources\Api\WatchedAuctionResource;
use App\Models\Auction;
use App\Models\AuctionBuyer;
use App\Models\User;
use App\Models\WatchedAuction;
use Illuminate\Http\Request;

class AuctionController extends PARENT_API
{
    public function auction($id)
    {
        if ($auction = Auction::where('id', $id)->find($id)) {
            $auction->get();
            return responseJson('true', trans('api.auction_details'), new AuctionResource($auction));  //OK don-successfully
        }
        return responseJson('false', trans('api.not_found_auction'), []);  //
    }


    public function watch_auction(Request $request, $id)
    {
        $auction = Auction::find($id);
        if ($auction) {
            $watch = WatchedAuction::where(['auction_id' => $auction->id, 'user_id' => auth()->user()->id])->first();
            if (is_null($watch)) {
                WatchedAuction::create(['auction_id' => $auction->id, 'user_id' => auth()->user()->id]);
            } else {
                $watch->delete();
            }
            return responseJson('true', trans('api.request_done_successfully'), []); //OK
        }
        return responseJson('false', trans('api.not_found_auction'), []);  //NOT_FOUND
    }


    public function watched_auctions(Request $request)
    {
        $watched_auctions = WatchedAuction::where('user_id', auth()->user()->id)->get();
        return responseJson('true', trans('api.auction_details'), ['watched_auctions' => WatchedAuctionResource::collection($watched_auctions)]);  //OK
    }


    public function make_bid(Request $request, $id)
    {
        if ($auction = Auction::find($id)) {
            $bid = AuctionBuyer::where(['auction_id' => $auction->id, 'buyer_id' => auth()->user()->id])->first();
            if (is_null($bid)) {
                AuctionBuyer::create(['auction_id' => $auction->id, 'buyer_id' => auth()->user()->id]);
                $auction->count_of_buyer += 1;
                $auction->update();
                return responseJson('true', trans('api.request_done_successfully'), []); //OK
            } else {
                $bid->update();
                return responseJson('true', trans('api.updated_successfully'), []);  //NOT_FOUND

            }

        }
        return responseJson('false', trans('api.not_found_auction'), []);  //NOT_FOUND
    }

    public function my_bids(Request $request)
    {
        $my_bids = AuctionBuyer::where('buyer_id', auth()->user()->id)->get();
        if ($my_bids->count() == 0) {
            return responseJson('true', trans('api.You_dont_have_bids_yet'), []);  //OK
        }
        return responseJson('true', trans('api.auction_details'), ['my_bids' => WatchedAuctionResource::collection($my_bids)]);  //OK

    }


}
