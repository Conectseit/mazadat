<?php

namespace App\Http\Controllers\Api\Auctions;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PARENT_API;
use App\Http\Requests\Api\MakeBidRequest;
use App\Http\Resources\Api\AuctionDetailsResource;
use App\Http\Resources\Api\AuctionResource;
use App\Http\Resources\Api\CategoryAuctionsResource;
use App\Http\Resources\Api\UserAuctionsResource;
use App\Models\Auction;
use App\Models\AuctionBuyer;
use App\Models\Setting;
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
        return responseJson(false, trans('api.not_found_auction'), null);  //
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
            return responseJson(true, trans('api.request_done_successfully'), null); //OK
        }
        return responseJson(false, trans('api.not_found_auction'), null);  //NOT_FOUND
    }


    public function watched_auctions(Request $request)
    {
        $appearance_of_ended_auctions = Setting::where('key', 'appearance_of_ended_auctions')->first()->value;
        $auctions = $request->user()->auctions;

//   =========== for appear ended auctions
        if ($request->status == 'done') {
            if ($appearance_of_ended_auctions == 'yes') {
                if ($auctions->where('status', 'done')->count() > 0) {
                    return responseJson(true, trans('api.auction_details'), CategoryAuctionsResource::collection($auctions->where('status', 'done')));  //OK
                } else {
                    return responseJson(true, trans('api.auction_details'), null);  //OK
                }
            } else {
                return responseJson(false, trans('api.management_not_allowed_to_appear_ended_auctions'), null);
            }
// ==================================
        }
        if ($auctions->where('status', 'on_progress')->count() > 0) {
            return responseJson(true, trans('api.auction_details'), CategoryAuctionsResource::collection($auctions->where('status', 'on_progress')));  //OK
        } else {
            return responseJson(true, trans('api.auction_details'), null);  //OK
        }

//        return responseJson(true, trans('api.auction_details'),  CategoryAuctionsResource::collection($auctions->where('status','on_progress')));  //OK
    }


    public function make_bid(MakeBidRequest $request, $id)
    {
        $user = auth()->user()->first();
        if ($user->passport_image != null && $user->documents->count() > 0) {
            if ($auction = Auction::find($id)) {
                $bid = AuctionBuyer::where(['auction_id' => $auction->id, 'buyer_id' => $user->id])->first();
                if (is_null($bid)) {
                    // =========================================

                    $auction_commission = $auction->category->auction_commission;
                    if ($user->wallete > $auction_commission){
                        $user_current_wallet = $user->wallete - $auction_commission;
                        $user->update(['wallet', $user_current_wallet]);
                    } else {
                        return responseJson(true, trans('api.you_should_charge_your_wallet_first'), null); //OK
                    }
                   // =========================================

                   //=================  make bid at first time ============
                    if ($request->offer < $user->available_limit) {
                        AuctionBuyer::create(['auction_id' => $auction->id, 'buyer_id' => $user->id, 'buyer_offer' => $request->offer]);
                        $auction->count_of_buyer += 1;
                        $auction->current_price = $auction->current_price + $request->offer;
                        $auction->update();
                        return responseJson(true, trans('api.request_done_successfully'), null); //OK
                    } else {
                        return responseJson(true, trans('api.sorry_you_cant_make_bid_your_available_limit_less_than_this_value'), null); //OK
                    }
                    //================================================================

               //=================== make bid at secend time  =================
                } else {
                    if($request->offer < $user->available_limit){
                        $auction->current_price = $auction->current_price + $request->offer;
                        $auction->update();
                        $bid->update(['buyer_offer' => $bid->buyer_offer + $request->offer]);
                        return responseJson(true, trans('api.updated_successfully'), null);
                    } else{
                        return responseJson(true, trans('api.sorry_you_cant_make_bid_your_available_limit_less_than_this_value'), null); //OK
                    }
                }
               // =======================================================


            }
            return responseJson(false, trans('api.not_found_auction'), null);  //NOT_FOUND
        }
        return responseJson(false, trans('api.Sorry_you_should_upload_document_and_passport_first'), null);  //NOT_FOUND
    }



    public function make_offer(Request $request, $id)
    {
        $user = auth()->user()->first();
            if ($auction = Auction::find($id)) {
                $current_price=$auction->current_price;
                if ($request->increment) {
                    $offer = $current_price + $auction->value_of_increment;
                }
              elseif ($request->decrement) {
                  $offer = $current_price - $auction->value_of_increment;
              }
                return responseJson(true, trans('api.updated_successfully'), $offer); //ACCEPTED
            }
            return responseJson(false, trans('api.not_found_auction'), null);  //NOT_FOUND
    }




//               if($total < $user->available_limit){
//                   if (is_null($bid)) {
//                       AuctionBuyer::create(['auction_id' => $auction->id, 'buyer_id' => $user->id,'buyer_offer'=>$request->offer]);
//                       $auction->count_of_buyer += 1;
//                       $auction->current_price = $auction->start_auction_price+ $request->offer;
//                       $auction->update();
//                       return responseJson(true, trans('api.request_done_successfully'), null); //OK
//                   } else {
//                       $auction->current_price = $auction->current_price + $request->offer;
//                       $auction->update();
//                       $bid->update(['buyer_offer'=>$bid->buyer_offer + $request->offer]);
//                       return responseJson(true, trans('api.updated_successfully'), null);  //NOT_FOUND
//                   }
//               }else{
//                   return responseJson(false, trans('api.sorry_you_cant_make_bid_your_available_limit_less_than_this_value'), null);  //NOT_FOUND
//               }


//    public function my_bids(Request $request)
//    {
//        $my_bids = AuctionBuyer::where('buyer_id', auth()->user()->id)->get();
//        if ($my_bids->count() == 0) {
//            return responseJson(true, trans('api.You_dont_have_bids_yet'), null);  //OK
//        }
//        return responseJson(true, trans('api.auction_details'), ['my_bids' => UserAuctionsResource::collection($my_bids)]);  //OK
//    }


    public function my_bids(Request $request)
    {
        $appearance_of_ended_auctions = Setting::where('key', 'appearance_of_ended_auctions')->first()->value;
        $auctions = $request->user()->bidauctions;

//   =========== for appear ended auctions
        if ($request->status == 'done') {
            if ($appearance_of_ended_auctions == 'yes') {
                if ($auctions->where('status', 'done')->count() > 0) {
                    return responseJson(true, trans('api.auction_details'), CategoryAuctionsResource::collection($auctions->where('status', 'done')));  //OK
                } else {
                    return responseJson(true, trans('api.auction_details'), null);  //OK
                }
            } else {
                return responseJson(false, trans('api.management_not_allowed_to_appear_ended_auctions'), null);
            }
// ==================================
        }
        if ($auctions->where('status', 'on_progress')->count() > 0) {
            return responseJson(true, trans('api.auction_details'), CategoryAuctionsResource::collection($auctions->where('status', 'on_progress')));  //OK
        } else {
            return responseJson(true, trans('api.auction_details'), null);  //OK
        }

//        return responseJson(true, trans('api.auction_details'),  CategoryAuctionsResource::collection($auctions->where('status','on_progress')));  //OK
    }

}
