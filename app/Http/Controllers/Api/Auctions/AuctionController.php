<?php

namespace App\Http\Controllers\Api\Auctions;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PARENT_API;
use App\Http\Requests\Api\auction\AddAuctionRequest;
use App\Http\Requests\Api\auction\UpdateAuctionRequest;
use App\Http\Requests\Api\MakeBidRequest;
use App\Http\Resources\Api\AuctionDetailsResource;
use App\Http\Resources\Api\CategoryAuctionsResource;
use App\Http\Resources\Api\FileNamesResource;
use App\Models\Auction;
use App\Models\AuctionBuyer;
use App\Models\AuctionData;
use App\Models\FileName;
use App\Models\Notification;
use App\Models\WatchedAuction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
//        $appearance_of_ended_auctions = Setting::where('key', 'appearance_of_ended_auctions')->first()->value;
        $auctions = $request->user()->auctions;

//   =========== for appear ended auctions
        if ($request->status == 'done') {
//            if ($appearance_of_ended_auctions == 'yes') {
            if ($auctions->where('status', 'done')->count() > 0) {
                return responseJson(true, trans('api.auction_details'), CategoryAuctionsResource::collection($auctions->where('status', 'done')));  //OK
            } else {
                return responseJson(false, trans('api.there_is_done_auctions'), null);  //OK
            }
//            } else {
//                return responseJson(false, trans('api.management_not_allowed_to_appear_ended_auctions'), null);
//            }
// ==================================
        }
        if ($auctions->where('status', 'on_progress')->count() > 0) {
            return responseJson(true, trans('api.auction_details'), CategoryAuctionsResource::collection($auctions->where('status', 'on_progress')));  //OK
        } else {
            return responseJson(false, trans('api.there_is_on_progress_auctions'), null);  //OK
        }

//        return responseJson(true, trans('api.auction_details'),  CategoryAuctionsResource::collection($auctions->where('status','on_progress')));  //OK
    }


    public function make_bid(MakeBidRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $user = auth()->user();
//            if( $user->is_verified == 0)
//            {
//            return responseJson(false, trans('api.Sorry_you_should_wait_until_admin_accept_you'), null);  //NOT_FOUND
//
//            }

//            if(is_null($user->passport_image) && $user->documents->count() == 0)
//            {
//                return responseJson(false, trans('api.Sorry_you_should_upload_document_and_passport_first'), null);  //NOT_FOUND
//            }

            if (!$auction = Auction::find($id)) return responseJson(false, trans('api.not_found_auction'), null);  //NOT_FOUND

            $bid = AuctionBuyer::where(['auction_id' => $auction->id, 'buyer_id' => $user->id])->first();

            if (($auction->current_price + $request->offer) > $user->available_limit) return responseJson(false, trans('api.sorry_you_cant_make_bid_your_available_limit_less_than_this_value'), null); //OK

            if (is_null($bid)) {
                $auction_commission = $auction->category->auction_commission;

                if ($user->wallet < ($auction_commission + $request->offer)) return responseJson(false, trans('api.you_should_charge_your_wallet_first'), null); //OK

                $user_current_wallet = $user->wallet - ($auction_commission + $request->offer);

                $user->update(['wallet' => $user_current_wallet]);

                $user_current_available_limit = $user->available_limit - ($auction_commission + $request->offer);
                $user->update(['available_limit' => $user_current_available_limit]);

                //=================  make bid at first time ============
                $user->auctionbuyers()->create(['auction_id' => $auction->id, 'buyer_offer' => $request->offer]);

                $auction->update([
                    'count_of_buyer' => $auction->count_of_buyer + 1,
                    'current_price' => $auction->current_price + $request->offer,
                ]);
                DB::commit();
                return responseJson(true, trans('api.request_done_successfully'), null); //OK
            }
            //=================== make bid at second time  =================
            $auction->update(['current_price' => $auction->current_price + $request->offer]);

            $bid->update(['buyer_offer' => $auction->current_price]);

            $user_current_wallet = $user->wallet - ($request->offer);
            $user->update(['wallet' => $user_current_wallet]);

            $user_current_available_limit = $user->available_limit - ($request->offer);
            $user->update(['available_limit' => $user_current_available_limit]);
            Notification::sendNewBidNotification($auction->id);

            DB::commit();
            return responseJson(true, trans('api.updated_successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            return responseJson(false, 'Server Error 500');
        }
    }

    public function my_bids(Request $request)
    {
//        $appearance_of_ended_auctions = Setting::where('key', 'appearance_of_ended_auctions')->first()->value;
        $auctions = $request->user()->bidauctions;

//   =========== for appear ended auctions
        if ($request->status == 'done') {
//            if ($appearance_of_ended_auctions == 'yes') {
            if ($auctions->where('status', 'done')->count() > 0) {
                return responseJson(true, trans('api.auction_details'), CategoryAuctionsResource::collection($auctions->where('status', 'done')));  //OK
            } else {
                return responseJson(false, trans('api.there_is_done_auctions'), null);  //OK
            }
//            } else {
//                return responseJson(false, trans('api.management_not_allowed_to_appear_ended_auctions'), null);
//            }
// ==================================
        }
        if ($auctions->where('status', 'on_progress')->count() > 0) {
            return responseJson(true, trans('api.auction_details'), CategoryAuctionsResource::collection($auctions->where('status', 'on_progress')));  //OK
        } else {
            return responseJson(false, trans('api.there_is_on_progress_auctions'), null);  //OK
        }

//        return responseJson(true, trans('api.auction_details'),  CategoryAuctionsResource::collection($auctions->where('status','on_progress')));  //OK
    }


    public function cancel_bid_auction(Request $request, $id)
    {
        $auctionn = AuctionBuyer::where(['buyer_id' => auth()->user()->id, 'auction_id' => $id])->first();
        $auction = Auction::find($id);
        $auction->update(['current_price' => $auction->current_price - $auctionn->buyer_offer]);
        $auctionn->delete();
        return responseJson(true, trans('api.request_done_successfully'), null); //OK
    }


    public function inspection_file_names()
    {
        $file_names = FileName::all();
        return responseJson(true, trans('api.file_names'), FileNamesResource::collection($file_names));  //OK don-successfully

    }

    public function add_auction(AddAuctionRequest $request)
    {
        DB::beginTransaction();
        try {
            $serial_number = '#' . random_int(00000, 99999);
            //======= create auction =======
            $request_data = $request->except(['inspection_report_images' . 'images']);

            $auction = Auction::create($request_data + ['seller_id' => auth()->user()->id,
                    'current_price' => $request->start_auction_price, 'serial_number' => $serial_number, 'status' => 'not_accepted']);

            //======= upload auction images =======
            $_data = [];
            if ($request->hasfile('images')) {
                foreach ($request->file('images') as $key => $img) {
                    $_data[$key] = ['image' => uploaded($img, 'auction'), 'auction_id' => $auction->id];
                }
            }
            DB::table('auction_images')->insert($_data);


            //======= upload auction inspection_report_images =======
            $data = [];
            if ($request->hasfile('inspection_report_images')) {
                foreach ($request->file('inspection_report_images') as $key => $img) {
                    $file = $img;
                    $file_image = time() . '.' . $file->getClientOriginalExtension();
                    $img->move('uploads/inspection_report_pdf', $file_image);
                    $data[$key] = ['image' => $file_image, 'auction_id' => $auction->id, 'file_name_id' => $request->file_name_id];
//                    $data[$key] = ['image' => uploaded($img, 'auction'), 'auction_id' => $auction->id];
                }
            }
            DB::table('inspection_images')->insert($data);


            //======= upload auction options =======
            $dataa = [];
            if ($request->has('option_details_id')) {
                if (is_array($request->option_details_id)) {
                    foreach ($request->option_details_id as $option_detail_id) {
                        $dataa[$option_detail_id] = [
                            'auction_id' => $auction->id,
                            'option_details_id' => $option_detail_id // <==== arrrray ??,
                        ];
                    }
                }
            }
            if (count($dataa) > 0) DB::table('auction_data')->insert($dataa);

//            $auction_options = AuctionData::Create([
//                'auction_id'        => $auction->id,
//                'option_id'         => $request->option_id,
//                'option_details_id' => $request->option_details_id,
//            ]);


            DB::commit();
            return responseJson(true, trans('api.added_your_auction_successfully_wait_until_admin_accept_it'), null); //OK

        } catch (Exception $e) {
            DB::rollback();
            return responseJson(false, $e->getMessage());
        }

    }


    public function updateAuction(UpdateAuctionRequest $request, Auction $auction)
    {
//        $auction = Auction::find($id);
        $auction = Auction::find($request->id);
        if (!$auction) {
            return responseJson(false, trans('api.not_found_auction'), null);  //NOT_FOUND
        }
        if ($auction->seller_id != (auth()->user()->id))
            return responseJson(false, trans('api.sorry you cant delete this auction'), null);  //NOT_FOUND


        DB::beginTransaction();
        try {
            //======= update auction =======
            $request_data = $request->except(['inspection_report_images' . 'images']);

//======= upload auction images =======
            $_data = [];
            if ($request->hasfile('images')) {

                foreach ($auction->auctionimages as $image) {
                    unlink('uploads/auctions/' . $image->image);
                    $image->delete();
                }

                foreach ($request->file('images') as $key => $img) {
                    $_data[$key] = ['image' => uploaded($img, 'auction'), 'auction_id' => $auction->id];
                }
                $auction_images = DB::table('auction_images')->insert($_data);
            }

//======= upload auction inspection_report_images =======
//            $data = [];
//            if ($request->hasfile('inspection_report_images')) {
//                foreach ($auction->inspectionimages as $image) {
////                    unlink('uploads/auctions/' . $image->image);
//                    $image->delete();
//                }
//                foreach ($request->file('inspection_report_images') as $key => $img) {
//                    $data[$key] = ['image' => uploaded($img, 'auction'), 'auction_id' => $id];
//                }
//                $auction_inspection_images = DB::table('inspection_images')->insert($data);
//            }


            $data = [];
            if ($request->hasfile('inspection_report_images')) {
                foreach ($auction->inspectionimages as $image) {
                    unlink('uploads/inspection_report_pdf/' . $image->image);
                    $image->delete();
                }
                foreach ($request->file('inspection_report_images') as $key => $img) {
                    $file = $img;
                    $file_image = time() . '.' . $file->getClientOriginalExtension();
                    $img->move('uploads/inspection_report_pdf', $file_image);
                    $data[$key] = ['image' => $file_image, 'auction_id' => $auction->id, 'file_name_id' => $request->file_name_id];
                }
                DB::table('inspection_images')->insert($data);
            }


//======= upload auction options =======


            $dataa = [];
            if (is_array($request->option_details_id)) {

                foreach ($auction->auctiondata as $auctiondataa) {
                    $auctiondataa->delete();
                }
                foreach ($request->option_details_id as $option_detail_id) {
                    $dataa[$option_detail_id] = [
                        'auction_id' => $auction->id,
                        'option_details_id' => $option_detail_id // <==== arrrray ??,
                    ];
                }
            }
            if (count($dataa) > 0) DB::table('auction_data')->insert($dataa);

            $auction->update($request_data + ['current_price' => $request->start_auction_price,]);

            DB::commit();
//            return responseJson(true, trans('api.updated_your_auction_successfully_wait_until_admin_accept_it'), new AuctionDetailsResource($auction));  //OK don-successfully
            return responseJson(true, trans('api.updated_your_auction_successfully_wait_until_admin_accept_it'), null);  //OK don-successfully

        } catch (Exception $e) {
            DB::rollback();
            return responseJson(false, $e->getMessage());
        }

    }


    public function deleteAuction(Request $request, Auction $auction)
    {
        $auction = Auction::find($request->id);

        if (!$auction)
            return responseJson(false, trans('api.not_found_auction'), null);  //NOT_FOUND

        if ($auction->seller_id != (auth()->user()->id))
            return responseJson(false, trans('api.sorry you cant delete this auction'), null);  //NOT_FOUND

        try {
            if (!is_null($auction->auctionimages))
                foreach ($auction->auctionimages as $image) {
                    unlink('uploads/auctions/' . $image->image);
                }
            if (!is_null($auction->inspectionimages))
                foreach ($auction->inspectionimages as $image) {
                    unlink('uploads/inspection_report_pdf/' . $image->image);
                }
            $auction->delete();
            return responseJson(true, trans('api.deleted_auction_successfully'), null);  //NOT_FOUND
        } catch (Exception $e) {
            return responseJson(false, trans('api.Server Internal Error 500'), null);  //NOT_FOUND

        }
    }


















//    public function make_offer(Request $request, $id)
//    {
//        $user = auth()->user();
//            if ($auction = Auction::find($id)) {
//                $current_price=$auction->current_price;
//                if ($request->increment) {
//                    $offer = $current_price + $auction->value_of_increment;
//                }
//              elseif ($request->decrement) {
//                  $offer = $current_price - $auction->value_of_increment;
//              }
//                return responseJson(true, trans('api.updated_successfully'), $offer); //ACCEPTED
//            }
//            return responseJson(false, trans('api.not_found_auction'), null);  //NOT_FOUND
//    }
//


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


}
