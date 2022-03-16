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
        $users = User::where('is_accepted',1)->whereHas('token', function($q){
            return $q->whereNotNull('fcm');
        })->get();

        $fcms = $users->map->token->pluck('fcm')->toArray();

        $tokens = $users->map->token->pluck('fcm_web_token')->toArray();

        $title = 'مزاد جديد';
        $text = 'تم إضافة مزاد جديد'; // write your message here .. later

        Firebase::send([
            'title'      => $title,
            'text'       => $text,
            'auction_id' => $auction_id,
            'fcm_tokens' => $fcms
        ]);

        foreach ($tokens as $token)
        {
            Firebase::createWebCurl($token, [
                'title' => $title,
                'body' => $text,
                'icon' => 'https://mzadat.com.sa/Front/assets/imgs/mini-logo.svg'
            ]);
        }

        // save the notification;
        Notification::create([
            'title'    => $title,
            'text'     => $text,
            'auction_id'  => $auction_id,

        ]);
    }


    public static function sendNewBidNotification($auction_id): void
    {
//        $users = AuctionBuyer::where('auction_id',$auction_id);


        $users = User::where('is_accepted',1)->whereHas('token', function($q){
            return $q->whereNotNull('fcm');
        })->get();

        $fcms = $users->map->token->pluck('fcm')->toArray();

        $tokens = $users->map->token->pluck('fcm_web_token')->toArray();

        $title = 'مزايدة جديدة';
        $text = 'تم رفع مزايدة جديدة'; // write your message here .. later

        Firebase::send([
            'title'      => $title,
            'text'       => $text,
            'auction_id' => $auction_id,
            'fcm_tokens' => $fcms
        ]);

        foreach ($tokens as $token)
        {
            Firebase::createWebCurl($token, [
                'title' => $title,
                'body' => $text,
                'icon' => 'https://mzadat.com.sa/Front/assets/imgs/mini-logo.svg'
            ]);
        }

        // save the notification;
        Notification::create([
            'title'    => $title,
            'text'     => $text,
            'auction_id'  => $auction_id,
//            'auction_image' => $auction_image,

        ]);
    }







    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }
}
