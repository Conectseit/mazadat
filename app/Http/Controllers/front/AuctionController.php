<?php

namespace App\Http\Controllers\front;

use App\Firebase\Firebase;
use App\Http\Controllers\Controller;
use App\Http\Requests\Front\auction\AddAuctionRequest;
use App\Http\Requests\Front\auction\MakeBidRequest;
use App\Models\AcceptedAuction;
use App\Models\Auction;
use App\Models\AuctionBuyer;
use App\Models\AuctionData;
use App\Models\AuctionImage;
use App\Models\Category;
use App\Models\Notification;
use App\Models\Option;
use App\Models\User;
use App\Models\WatchedAuction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuctionController extends Controller
{
    public function auction_details($id)
    {
        $data['auction'] = Auction::where('id', $id)->first();
        $data['images'] = AuctionImage::where(['auction_id' => $id])->get();
//        $data['options'] = AuctionData::where(['auction_id' => $id])->get();
        return view('front.auctions.auction_details',$data);
    }

    public function make_bid(MakeBidRequest $request, $id)
    {
        DB::beginTransaction();
        try
        {
            $user = auth()->user();

            if( $user->is_verified == 0)
            {
                return back()->with('error', trans('messages.Sorry_you_should_wait_until_admin_accept_you'));
            }
            if(!$auction = Auction::find($id))
                return back()->with('error', trans('messages.not_found_auction'));


            $accept=AcceptedAuction::where(['user_id'=>$user->id,'auction_id'=>$auction->id])->first();
            if (!$accept) {
                return back()->with('error', trans('messages.Sorry_you_should_accept_auction_terms_first'));
            }

//            if( $user->accepted_auctions->count() == 0)
//            {
//            }

//            if(is_null($user->passport_image) && $user->documents->count() == 0)
//            {
//                return back()->with('warning', trans('messages.Sorry_you_should_upload_document_and_passport_first'));
//            }


            $bid = AuctionBuyer::where(['auction_id' => $auction->id, 'buyer_id' => $user->id])->first();

            if($auction->current_price >= $request->buyer_offer)
                return back()->with('error', trans('messages.sorry_you_cant_make_bid_your_offer_must_bigger_than_auction_current_price'));

            if($request->buyer_offer > $user->available_limit)
                return back()->with('warning1', trans('messages.sorry_you_cant_make_bid_your_available_limit_less_than_this_value'));

            if (is_null($bid))
            {

                $auction_commission = $auction->category->auction_commission;
                if($user->wallet < ($auction_commission  + $request->buyer_offer))
                    return back()->with('warning1', trans('messages.you_should_charge_your_wallet_first'));


                if($user->available_limit < ($auction_commission  + $request->buyer_offer))
                    return back()->with('warning1', trans('messages.sorry_you_cant_make_bid_your_available_limit_less_than_this_value'));


                $offer=$request->buyer_offer - $auction->current_price;
                $user_current_wallet = $user->wallet - ($auction_commission + $offer);

                $user->update(['wallet' => $user_current_wallet]);

                $user_current_available_limit= $user->available_limit - ($auction_commission + $offer);
                $user->update(['available_limit' => $user_current_available_limit]);

                //=================  make bid at first time ============
                $user->auctionbuyers()->create(['auction_id' => $auction->id,
                    'buyer_offer' => $request->buyer_offer,
//                    'accept_auction_terms' => 'yes'
                ]);

                $auction->update([
                    'count_of_buyer' => $auction->count_of_buyer + 1,
                    'current_price'  => $request->buyer_offer,
//                    'current_price'  => $auction->current_price + $request->buyer_offer,
                ]);
                DB::commit();
                return back()->with('success', trans('messages.bid_done_successfully'));
            }
            //=================== make bid at second time  =================
            $offer=$request->buyer_offer - $auction->current_price;
            $auction->update(['current_price' => $request->buyer_offer]);

            $bid->update(['buyer_offer' => $auction->current_price]);

            $user_current_wallet = $user->wallet - ($offer);
            $user->update(['wallet' => $user_current_wallet]);

            $user_current_available_limit= $user->available_limit - ( $offer);
            $user->update(['available_limit' => $user_current_available_limit]);

            DB::commit();



//            $users = AuctionBuyer::where('auction_id' , $auction->id)->get();
//
//            foreach ($users->buyer as $user){
//                if ($user->token->fcm != null ) {
//                    Firebase::send([
//                        'title'      => 'kk',
//                        'text'       => 'ooo',
//                        'fcm_tokens' => $user->token->fcm
//                    ]);
//                }
//
//            }


            return back()->with('success', trans('messages.bid_done_successfully'));
        }
        catch(Exception $e)
        {
            DB::rollBack();
            return back();
        }
    }

    public function get_options_by_category_id(Request $request)
    {
        return Option::getOptionsByCategoryId($request);
    }

    public  function cancel_bid_auction (Auction $auction)
    {
        $auctionn= AuctionBuyer::where(['buyer_id' => auth()->user()->id, 'auction_id' => $auction->id]);
        $auction->update(['current_price' => $auction->current_price - $auctionn->buyer_offer]);
        $auctionn->delete();
        return back();
    }

    public function my_watched()
    {
        $data['auctions'] =  auth()->user()->auctions()->get();
        return view('front.user.my_watched_auctions', $data);
    }

    public function my_bids()
    {
        $data['auctions'] =  auth()->user()->bidauctions()->get();
        return view('front.user.my_bids', $data);
    }


    public  function watch_auction (Auction $auction)
    {
        $check = checkIsUserWatch($auction);
        if((boolean)$check->count())
        {
            $check->delete();
            return response()->json(['status' => true, 'is_watched' => false]);
//            return back();
        }
        WatchedAuction::create(['user_id' => auth()->user()->id, 'auction_id' => $auction->id,]);
        return response()->json(['status' => true, 'is_watched' => true]);

    }

    public  function delete_watch_auction (Auction $auction)
    {
        $auctionn= WatchedAuction::where(['user_id' => auth()->user()->id, 'auction_id' => $auction->id,]);
        $auctionn->delete();
        return back();
    }

    public  function accept_auction_terms (Auction $auction)
    {
        $check = checkIsUserAccept($auction);
        if($check->count())
        {
            $check->delete();
            return response()->json(['status' => true, 'is_accepted' => false]);
        }
        AcceptedAuction::create(['user_id' => auth()->user()->id, 'auction_id' => $auction->id,]);
        return response()->json(['status' => true, 'is_accepted' => true]);
    }

    public function show_add_auction()
    {
        $data['categories'] = Category::all();
        $data['options'] = Option::all();
        return view('front.auctions.add_auction',$data);
    }

    public function add_auction(AddAuctionRequest $request)
    {

        DB::beginTransaction();
        try {
            $serial_number = '#' . random_int(00000, 99999);
            //======= create auction =======
            $request_data = $request->except(['inspection_report_images' . 'images']);

            $auction = Auction::create($request_data + ['seller_id'=>auth()->user()->id,
                    'current_price' => $request->start_auction_price, 'serial_number' => $serial_number]);


            //======= upload auction images =======
            $data = [];
            if ($request->hasfile('images')) {
                foreach ($request->file('images') as $key => $img) {
                    $data[$key] = ['image' => uploaded($img, 'auction'), 'auction_id' => $auction->id];
                }
            }
            $auction_images = DB::table('auction_images')->insert($data);

            //======= upload auction inspection_report_images =======
            $dataa = [];
            if ($request->hasfile('inspection_report_images')) {
                foreach ($request->file('inspection_report_images') as $key => $img) {
                    $dataa[$key] = ['image' => uploaded($img, 'auction'), 'auction_id' => $auction->id];
                }
            }
            $auction_inspection_report_images = DB::table('inspection_images')->insert($dataa);

            //======= upload auction options =======
            $options = [];
            if(is_array($request->option_ids))
            {
                foreach ($request->option_ids as $option_detail_id) {
                    $options[$option_detail_id] = [
                        'auction_id'        => $auction->id,
                        'option_details_id' => $option_detail_id // <==== arrrray ??,
                    ];
                }
            }
            if(count($options) > 0) DB::table('auction_data')->insert($options);

            Notification::sendNewAuctionNotification($auction->id);

            DB::commit();
            return back()->with('success', trans('messages.messages.added_successfully_wait_until_admin_accept_your_auction'));

        } catch (Exception $e) {
            DB::rollback();
        }
    }



    public function my_auctions()
    {
//        $data['auctions'] =  auth()->user()->seller_auctions()->get();
        $data['on_progress_auctions'] = auth()->user()->seller_auctions()->where(['status'=> 'on_progress','is_accepted'=>1])->paginate('20');
        $data['pending_auctions'] = auth()->user()->seller_auctions()->where('status', 'on_progress')->where('is_accepted',0)->paginate('20');
        $data['ended_auctions'] = auth()->user()->seller_auctions()->where('status', 'done')->where('is_accepted',1)->paginate('20');
        return view('front.user.my_auctions', $data);
    }





}
