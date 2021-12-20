<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Auction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


//    public function getNameAttribute()
//    {
//        return $this->name_.app()->getLocale();
//    }



    public function getFirstImagePathAttribute()
    {
        $images = $this->auctionimages;
        return isset($images[0]) ? asset('uploads/auctions/' . $images[0]->image) : asset('uploads/default.png');
    }



    public function getRemainingTimeAttribute()
    {
        if ($this->end_date) {
            if (Carbon::parse($this->end_date) < Carbon::now()){
                return "ended";
            }
            $start  = new Carbon($this->end_date);
            $end    =  Carbon::now();
            $diff = $start->diff($end);
        } else {
            $diff = 0;
        }
        return  $diff->d . ' days ' . $diff->h . ' hours';
//        return $diff->y . ' years ' . $diff->d . ' days ' . $diff->h . ' hours';
    }


    public function seller()
    {
        return $this->belongsTo('App\Models\User', 'seller_id')->withDefault(['full_name' => 'لا يوجد']);
    }

    public function buyer()
    {
        return $this->belongsTo('App\Models\User', 'buyer_id')->withDefault(['full_name' => 'لا يوجد']);
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id')->withDefault(['name_ar' => '== ']);
    }


    public function auctionimages()
    {
        return $this->hasMany(AuctionImage::class,'auction_id');
    }

    public function auctionbuyers()
    {
        return $this->hasMany(AuctionBuyer::class,'auction_id');
    }

    public function watchedauctions()
    {
        return $this->hasMany(WatchedAuction::class, 'auction_id');
    }


    public function getDescriptionAttribute()
    {
        return \Str::limit($this->attributes['description'], 10);
    }

}
