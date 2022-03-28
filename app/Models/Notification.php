<?php

namespace App\Models;

use App\Firebase\Firebase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function sendNewAuctionNotification($auction_id): void
    {
//        $users = User::where('is_accepted',1)->whereHas('token', function($q){
//            return $q->whereNotNull('fcm');
//        })->get();
        $users = User::where('is_accepted', 1)->whereHas('token')->get();

        $fcms = $users->map->token->pluck('fcm')->toArray();

        $tokens = $users->map->token->pluck('fcm_web_token')->toArray();
        $auction = Auction::findOrFail($auction_id);
        $title = 'مزاد جديد';
//        $text = ' سوف يبدأ يوم '. ''.$auction->start_date; // write your message here .. later

        $text = 'تم إضافة مزاد جديد,' . "\n";
        $text .= " - سوف يبدأ :  " . $auction->start_date;
        $text .= " في قسم :  " . $auction->category->name_ar;


        foreach ($users as $user) {
            // save the notification;
            Notification::create([
                'title'      => $title,
                'text'       => $text,
                'auction_id' => $auction_id,
                'user_id'    => $user->id,
            ]);
        }

        Firebase::send([
            'title'      => $title,
            'text'       => $text,
            'auction_id' => $auction_id,
            'fcm_tokens' => $fcms,
        ]);

        foreach ($tokens as $token) {
            Firebase::createWebCurl($token, [
                'title' => $title,
                'body'  => $text,
//                'icon' => 'https://mzadat.com.sa/public/Dashboard/assets/images/Yellow-notificatio-PNG.png'

                'icon'  => 'https://mzadat.com.sa/Front/assets/imgs/logoo.png'
            ]);
        }

    }


    public static function sendNewBidNotification($auction_id): void
    {
//          AuctionBuyer::where('auction_id',$auction_id)->get();
        $auction = Auction::where('id', $auction_id)->first();

        $users = $auction->buyers;

//        $users = User::where('is_accepted',1)->whereHas('token')->get();


        $fcms = $users->map->token->pluck('fcm')->toArray();

        $tokens = $users->map->token->pluck('fcm_web_token')->toArray();

        $title = 'مزايدة جديدة';
        $text = ' تم رفع مزايدة جديدة في المزاد التي تتابعه'; // write your message here .. later



        Firebase::send([
            'title' => $title,
            'text' => $text,
            'auction_id' => $auction_id,
            'fcm_tokens' => $fcms
        ]);

        foreach ($tokens as $token) {
            Firebase::createWebCurl($token, [
                'title' => $title,
                'body' => $text,
                'icon' => 'https://mzadat.com.sa/Front/assets/imgs/mini-logo.svg'
            ]);
        }

        foreach ($users as $user) {
            // save the notification;
            Notification::create([
                'title'      => $title,
                'text'       => $text,
                'auction_id' => $auction_id,
                'user_id'    => $user->id,
            ]);
        }
//        // save the notification;
//        Notification::create([
//            'title' => $title,
//            'text' => $text,
//            'auction_id' => $auction_id,
////            'auction_image' => $auction_image,
//        ]);



    }




    public static function sendNewBidNotificationToAuctionOwner($auction_id): void
    {

        $auction = Auction::where('id', $auction_id)->first();

        $user = $auction->seller;

        $title = 'مزايدة جديدة';
        $text = ' تم رفع مزايدة جديدة في مزادك الخاص';

        if ($user->token->fcm != null) {
            Firebase::send([
                'title' => $title,
                'text' => $text,
                'fcm_tokens' => $user->token->fcm
            ]);
        }
        Firebase::createWebCurl($user->token->fcm_web_token, [
            'title' => $title,
            'body' => $text,
            'icon' => 'https://mzadat.com.sa/Front/assets/imgs/mini-logo.svg'
        ]);
        $notify = Notification::create([
            'user_id' => $user->id,
            'title' => $title,
            'text' => $text,
        ]);
    }


    public function sendAcceptAccountNotify($user_id)
    {
        $user = User::find($user_id);

        if (is_null($user)) {
            return back()->with('class', 'success')->with('message', trans('messages.messages.user_not_found'));
        }
        $title = 'قبول حسابك';
        $text = ' تم قبول حسابك من ادارة موقع مزادات ';

        if ($user->token->fcm != null) {
            Firebase::send([
                'title' => $title,
                'text' => $text,
                'fcm_tokens' => $user->token->fcm
            ]);
        }
        Firebase::createWebCurl($user->token->fcm_web_token, [
            'title' => $title,
            'body' => $text,
            'icon' => 'https://mzadat.com.sa/Front/assets/imgs/mini-logo.svg'
        ]);
        $notify = Notification::create([
            'user_id' => $user->id,
            'title' => $title,
            'text' => $text,
        ]);

    }

    public function sendNotAcceptAccountNotify($user_id)
    {

        $user = User::find($user_id);

        if (is_null($user)) {
            return back()->with('class', 'success')->with('message', trans('messages.messages.user_not_found'));
        }
        $title = 'لم يتم قبول حسابك';
        $text = '  لم يتم قبول حسابك من ادارة موقع مزادات هناك خطأ في بياناتك من فضلك ارسلها مرة اخري ';

        if ($user->token->fcm != null) {
            Firebase::send([
                'title' => $title,
                'text' => $text,
                'fcm_tokens' => $user->token->fcm
            ]);
        }
        Firebase::createWebCurl($user->token->fcm_web_token, [
            'title' => $title,
            'body' => $text,
            'icon' => 'https://mzadat.com.sa/Front/assets/imgs/mini-logo.svg'
        ]);
        $notify = Notification::create([
            'user_id' => $user->id,
            'title' => $title,
            'text' => $text,
        ]);
    }


    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }
}
