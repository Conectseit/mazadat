<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Front\auction\MakeBidRequest;
use App\Models\AcceptedAuction;
use App\Models\InPersonAuction;
use App\Models\AuctionBuyer;
use App\Models\AuctionImage;
use App\Models\FileName;
use App\Models\Notification;
use App\Models\Option;
use App\Models\WatchedAuction;
use Illuminate\Support\Facades\DB;

class InPersonAuctionController extends Controller
{
    public function auction_details($id)
    {
        $data['auction'] = InPersonAuction::where('id', $id)->first();
        $data['images'] = AuctionImage::where(['person_auction_id' => $id])->get();
//        $data['options'] = AuctionData::where(['auction_id' => $id])->get();
        $data['inspection_file_names'] = FileName::all();

        return view('front.in_person_auction.auction_details', $data);
    }

    public function make_bid(MakeBidRequest $request, $id)
    {

        DB::beginTransaction();
        try {
            $user = auth()->user();

            if ($user->is_completed == 0) {
                return back()->with('warning_comp', trans('messages.Sorry_you_should_complete_your_account_information_first'));
            }
            if ($user->is_verified == 0) {
                return back()->with('error', trans('messages.Sorry_you_should_wait_until_admin_accept_you'));
            }
            if (!$auction = InPersonAuction::find($id)) {
                return back()->with('error', trans('messages.not_found_auction'));

            }
//            if(!$user->is_company == $auction->who_can_see || $auction->who_can_see == 'all' ){
//                return back()->with('error', trans('messages.sorry_you_cant_bid_on_this_auction'));
//
//            }

            $accept = AcceptedAuction::where(['user_id' => $user->id, 'person_auction_id' => $auction->id])->first();
            if (!$accept) {
                return back()->with('error', trans('messages.Sorry_you_should_accept_auction_terms_first'));
            }

            $bid = AuctionBuyer::where(['person_auction_id' => $auction->id, 'buyer_id' => $user->id])->first();

            if ($auction->current_price >= $request->buyer_offer)
                return back()->with('error', trans('messages.sorry_you_cant_make_bid_your_offer_must_bigger_than_auction_current_price'));

            if ($request->buyer_offer > $user->available_limit)
                return back()->with('warning1', trans('messages.sorry_you_cant_make_bid_your_available_limit_less_than_this_value'));

            if (is_null($bid)) {
                $auction_commission = $auction->category->auction_commission;
                if ($user->wallet < ($auction_commission + $request->buyer_offer))
                    return back()->with('warning1', trans('messages.you_should_charge_your_wallet_first'));


                if ($user->available_limit < ($auction_commission + $request->buyer_offer))
                    return back()->with('warning1', trans('messages.sorry_you_cant_make_bid_your_available_limit_less_than_this_value'));


//                $offer= $request->buyer_offer - $auction->current_price;
                $offer = $request->buyer_offer;
                $user_current_wallet = $user->wallet - ($auction_commission + $offer);

                $user->update(['wallet' => $user_current_wallet]);

                $user_current_available_limit = $user->available_limit - ($auction_commission + $offer);
                $user->update(['available_limit' => $user_current_available_limit]);

                //=================  make bid at first time ============
                $user->auctionbuyers()->create([
                    'person_auction_id' => $auction->id,
                    'buyer_offer' => $request->buyer_offer,
//                    'accept_auction_terms' => 'yes'
                ]);

                $auction->update([
                    'count_of_buyer' => $auction->count_of_buyer + 1,
                    'current_price' => $request->buyer_offer,
//                    'current_price'  => $auction->current_price + $request->buyer_offer,
                ]);
//                Notification::sendNewBidNotificationToAuctionOwner($auction->id);
//                Notification::sendNewBidNotification($auction->id);
                DB::commit();
                return back()->with('success', trans('messages.bid_done_successfully'));
            }
            //=================== make bid at second time  =================
            $offer = $request->buyer_offer - $auction->current_price;
            $auction->update(['current_price' => $request->buyer_offer]);

            $bid->update(['buyer_offer' => $auction->current_price]);

            $user_current_wallet = $user->wallet - ($offer);
            $user->update(['wallet' => $user_current_wallet]);

            $user_current_available_limit = $user->available_limit - ($offer);
            $user->update(['available_limit' => $user_current_available_limit]);


//            Notification::sendNewBidNotificationToAuctionOwner($auction->id);
//            Notification::sendNewBidNotification($auction->id);

            DB::commit();

            return back()->with('success', trans('messages.bid_done_successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            return back();
        }
    }

    public function get_options_by_category_id(Request $request)
    {
        return Option::getOptionsByCategoryId($request);
    }

    public function cancel_bid_auction(Auction $auction)
    {
        $auction_n = AuctionBuyer::where(['buyer_id' => auth()->user()->id, 'person_auction_id' => $auction->id]);
        $auction->update(['current_price' => $auction->current_price - $auction_n->buyer_offer]);

        $user_current_wallet = auth()->user()->wallet + ($auction_n->buyer_offer);
        auth()->user()->update(['wallet' => $user_current_wallet]);

        $auction_n->delete();
        return back();
    }

    public function my_watched()
    {
        $data['auctions'] = auth()->user()->person_auctions()->get();
        return view('front.user.my_watched_auctions', $data);
    }

    public function my_bids()
    {
        $data['auctions'] = auth()->user()->bidauctions()->get();
        return view('front.user.my_bids', $data);
    }


    public function watch_auction(Auction $auction)
    {
        $check = checkIsUserWatch($auction);
        if ((boolean)$check->count()) {
            $check->delete();
            return response()->json(['status' => true, 'is_watched' => false]);
        }
        WatchedAuction::create(['user_id' => auth()->user()->id, 'person_auction_id' => $auction->id,]);
        return response()->json(['status' => true, 'is_watched' => true]);

    }

    public function delete_watch_auction(Auction $auction)
    {
        $auctionn = WatchedAuction::where(['user_id' => auth()->user()->id, 'person_auction_id' => $auction->id,]);
        $auctionn->delete();
        return back();
    }

    public function accept_auction_terms(Auction $auction)
    {
        $check = checkIsUserAccept($auction);
        if ($check->count()) {
            $check->delete();
            return response()->json(['status' => true, 'is_accepted' => false]);
        }
        AcceptedAuction::create(['user_id' => auth()->user()->id, 'person_auction_id' => $auction->id,]);
        return response()->json(['status' => true, 'is_accepted' => true]);
    }

    public function my_auctions()
    {
//        $data['auctions'] =  auth()->user()->person_seller_auctions()->get();
//        $data['pending_auctions'] = Auction::where('seller_id', auth()->user()->id)->where('status', 'not_accepted')->paginate('20');
        $data['pending_auctions'] = auth()->user()->person_seller_auctions()->where('status', 'not_accepted')->where('is_accepted', 0)->latest()->paginate('20');
        $data['accepted_not_appear_auctions'] = auth()->user()->person_seller_auctions()->where(['status' => 'not_accepted', 'is_accepted' => 1])->latest()->paginate('20');
        $data['on_progress_auctions'] = auth()->user()->person_seller_auctions()->where(['status' => 'on_progress', 'is_accepted' => 1])->latest()->paginate('20');
        $data['ended_auctions'] = auth()->user()->person_seller_auctions()->where('status', 'done')->where('is_accepted', 1)->latest()->paginate('20');
        $data['q'] = 'person_auction';
        return view('front.user.my_auctions', $data);
    }

}
