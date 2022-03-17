<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PARENT_API;
use App\Http\Requests\Api\user\UploadPaymentReceiptRequest;
use App\Http\Resources\Api\auction\PendingAuctionsResource;
use App\Http\Resources\Api\CategoryAuctionsResource;
use App\Models\Auction;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends PARENT_API
{

    public function choose_available_limit(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return responseJson(false, trans('api.The_user_not_found'), null); //BAD_REQUEST
        }
        $available_limit = $user->available_limit;
        $wallet = $user->wallet;
//        $wallet = $user->select('wallet')->first();
        if ($request->decrement) {
            $user->decrement('available_limit', 100); // decrease 100 count
//            $available_limit = $user->available_limit - 1;
//            $user->update(['available_limit' => $available_limit]);
        }
        if ($request->increment) {
            if ($available_limit >= $wallet) {
                return responseJson(false, trans('api.Sorry_you_cant_increase_more_your_wallet_less_than_this_value'), null);
            }
            $user->increment('available_limit', 100);
        }
        return responseJson(true, trans('api.updated_successfully'), $user->available_limit); //ACCEPTED
    }


    public function my_wallet(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return responseJson(false, trans('api.The_user_not_found'), null); //BAD_REQUEST
        }
//        $user->select('available_limit', 'wallet')->get();

        return responseJson(true, trans('api.request_done_successfully'), ['Current Deposit' => $user->wallet, 'Available Limit' => $user->available_limit]); //ACCEPTED
    }


    public function my_auctions(Request $request)
    {
        $auctions = $request->user()->seller_auctions;

        if ($request->status == 'done') {
                if ($auctions->where('status', 'done')->count() > 0) {
                    return responseJson(true, trans('api.auction_details'), CategoryAuctionsResource::collection($auctions->where('status', 'done')->where('is_accepted',1)));  //OK
                } else {
                    return responseJson(false, trans('api.there_is_done_auctions'), null);  //OK
                }
        }
        if ($auctions->where('status', 'on_progress')->count() > 0) {
            return responseJson(true, trans('api.auction_details'), CategoryAuctionsResource::collection($auctions->where('status', 'on_progress')->where('is_accepted',1)));  //OK
        } else {
            return responseJson(false, trans('api.there_is_on_progress_auctions'), null);  //OK
        }

    }



    public function my_pending_auctions(Request $request)
    {
        $auctions = $request->user()->seller_auctions;

        if ($auctions->where('status', 'on_progress')->where('is_accepted',0)->count() > 0)
        {
            return responseJson(true, trans('api.auction_details'), PendingAuctionsResource::collection($auctions->where('status', 'on_progress')->where('is_accepted',0)->latest()));  //OK
        } else {
            return responseJson(false, trans('api.there_is_pending_auctions'), null);  //OK
        }

    }






//    public function upload_passport(UploadPassportRequest $request)
//    {
//        $request_data = $request->except(['passport_image']);
//        if ($request->passport_image) {
//            $request_data['passport_image'] = $request_data['passport_image'] = uploaded($request->passport_image, 'user');
//        }
//        $user = auth()->user();
//        if (!$user) {
//            return responseJson(false, trans('api.The_user_not_found'), null); //BAD_REQUEST
//        }
//        $user->update($request_data);
//        return responseJson(true, trans('api.uploaded_successfully'), null); //ACCEPTED
//    }
//
//    public function add_document(DocumentRequest $request)
//    {
//        $request_data = $request->except(['front_side_image', 'back_side_image']);
//        if ($request->front_side_image) {
//            $request_data['front_side_image'] = $request_data['front_side_image'] = uploaded($request->front_side_image, 'user');
//        }
//        if ($request->back_side_image) {
//            $request_data['back_side_image'] = $request_data['back_side_image'] = uploaded($request->back_side_image, 'user');
//        }
//        $user = auth()->user();
//        if (!$user) {
//            return responseJson(false, trans('api.The_user_not_found'), null); //BAD_REQUEST
//        }
//        $document = Document::create($request_data + ['user_id' => $user->id]);
//        return responseJson(true, trans('api.added_successfully'), null); //ACCEPTED
//    }
//
//    public function add_traffic_file_number(TrafficFileNumberRequest $request)
//    {
//        $user = auth()->user();
//        if (!$user) {
//            return responseJson(false, trans('api.The_user_not_found'), null); //BAD_REQUEST
//        }
//        $traffic_file_number = TrafficFileNumber::create($request->all() + ['user_id' => $user->id]);
//        return responseJson(true, trans('api.added_successfully'), $traffic_file_number); //ACCEPTED
//    }
//
//    public function my_document(Request $request)
//    {
//        $user = auth()->user();
//        if (!$user) {
//            return responseJson(false, trans('api.The_user_not_found'), null); //BAD_REQUEST
//        }
//        $documents = Document::where('user_id', $user->id)->get();
//        if ($documents) {
//            return responseJson(true, trans('api.request_done_successfully'), DocumntsResource::collection($documents)); //ACCEPTED
//        }
//        return responseJson(true, trans('api.there_is_no_document_for_this_user_yet'), null); //ACCEPTED
//    }
//
//
//    public function my_passport(Request $request)
//    {
//        $user = auth()->user();
//        if (!$user) {
//            return responseJson(false, trans('api.The_user_not_found'), null); //BAD_REQUEST
//        }
//        if (is_null($user->passport_image)) {
//            return responseJson(false, trans('api.The_user_has_not_passport_yet'), null);
//        }
//        return responseJson(true, trans('api.request_done_successfully'), $user->passport_image_path); //ACCEPTED
//    }







    //==================================================================================
//    public function updatePreferredLanguage(Request $request)
//    {
//        $user = auth()->user();
////        dd($user->preferred_language);
//        if ($user->preferred_language == 'arabic') {
//            $user->update(['preferred_language' => 'english']);
//        } else {
//            $user->update(['preferred_language' => 'arabic']);
//        }
//        return responseJson(true, trans('api.updated_successfully'), null); //ACCEPTED
//    }

//    public function getPreferredLanguage(Request $request)
//    {
//        $preferred_language = User::select('preferred_language')->where('id', auth()->user()->id)->first();
////        $preferred_language =  auth()->user()->select('preferred_language')->first();
//        return responseJson(true, trans('api.request_done_successfully'), $preferred_language); //ACCEPTED
//    }


//    public function togglePreferredLanguage(Request $request)
//    {
//        $user =  auth()->user();
////        dd($user->preferred_language);
//        if( $user->preferred_language  == 'arabic')
//        {
//            $user->update(['preferred_language' => 'english']);
//        }else{
//            $user->update(['preferred_language' => 'arabic']);
//        }
//        return responseJson(true, trans('api.updated_successfully'),null); //ACCEPTED
//    }


}
