<?php

namespace App\Http\Controllers\Api\Auctions;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PARENT_API;
use App\Http\Requests\Api\MakeBidRequest;
use App\Http\Resources\Api\AuctionDetailsResource;
use App\Http\Resources\Api\AuctionResource;
use App\Http\Resources\Api\UserAuctionsResource;
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
            return responseJson(true, trans('api.auction_details'), new AuctionDetailsResource($auction));  //OK don-successfully
        }
        return responseJson(false, trans('api.not_found_auction'), []);  //
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
            return responseJson(true, trans('api.request_done_successfully'), []); //OK
        }
        return responseJson(false, trans('api.not_found_auction'), []);  //NOT_FOUND
    }


    public function watched_auctions(Request $request)
    {
        $watched_auctions = WatchedAuction::where('user_id', auth()->user()->id)->get();
        return responseJson(true, trans('api.auction_details'), ['watched_auctions' => UserAuctionsResource::collection($watched_auctions)]);  //OK
    }


    public function make_bid(MakeBidRequest $request, $id)
    {
       $user= auth()->user();
        if ($auction = Auction::find($id)) {
            $bid = AuctionBuyer::where(['auction_id' => $auction->id, 'buyer_id' => $user->id])->first();
            if($request->offer <= $user->available_limit){

                if (is_null($bid)) {
                AuctionBuyer::create(['auction_id' => $auction->id, 'buyer_id' => $user->id,'buyer_offer'=>$request->offer]);
                $auction->count_of_buyer += 1;
                $auction->current_price = $auction->start_auction_price+ $request->offer;
                $auction->update();
                return responseJson(true, trans('api.request_done_successfully'), []); //OK
            } else {
                $auction->current_price = $auction->current_price + $request->offer;
                $auction->update();
                $bid->update(['buyer_offer'=>$bid->buyer_offer + $request->offer]);
                return responseJson(true, trans('api.updated_successfully'), []);  //NOT_FOUND
            }
            }else{
                return responseJson(false, trans('api.sorry!_you_cant_make_bid_your_available_limit_less_than+_this_value'), []);  //NOT_FOUND
            }

        }
        return responseJson(false, trans('api.not_found_auction'), []);  //NOT_FOUND
    }

    public function my_bids(Request $request)
    {
        $my_bids = AuctionBuyer::where('buyer_id', auth()->user()->id)->get();
        if ($my_bids->count() == 0) {
            return responseJson(true, trans('api.You_dont_have_bids_yet'), []);  //OK
        }
        return responseJson(true, trans('api.auction_details'), ['my_bids' => UserAuctionsResource::collection($my_bids)]);  //OK
    }



























}
