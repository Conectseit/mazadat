<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Auction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $dates = ['start_date','end_date'];

    protected $appends = ['remaining_time'];

    public function getFirstImagePathAttribute()
    {
        $images = $this->auctionimages;
        return isset($images[0]) ? asset('uploads/auctions/' . $images[0]->image) : asset('uploads/default.png');
    }


    public function getExtraPathAttribute()
    {
        $extra = Auction::where('id', $this->id)->first()->extra;
        if (!$extra) {
            return asset('uploads/default.png');
        }
        return asset( 'uploads/auction_pdf/'.$this->extra);
    }

    public function getFirstInspectionImagePathAttribute()
    {
        $images = $this->inspectionimages;
        return isset($images[0]) ? asset('uploads/auctions/' . $images[0]->image) : asset('uploads/default.png');
    }

//    public function getRemainingTimeAttribute()
//    {
//        $start  = Carbon::parse($this->start_date);
//        $end  = Carbon::parse($this->end_date);
//        $diff = $start->diff($end);
////         return ' days '. $diff->d . '/' . ' hours ' . $diff->h ;
//
//        return ['days' => $diff->d, 'hours' => $diff->h,'minutes' => $diff->m, 'seconds' => $diff->s];
//    }

//    public function getRemainingTimeAttribute()
//    {
//        $now  = Carbon::now();
//        $end  = Carbon::parse($this->end_date);
//        $hours = $end->diffInHours($now);
//        $min = $end->diffInMinutes($now);
//        $seconds = $end->diffInSeconds($now);
//        dd($hours,$min,$seconds);
////         return ' days '. $diff->d . '/' . ' hours ' . $diff->h ;
//
//        return ['days' => $diff->d, 'hours' => $diff->h,'minutes' => $diff->m, 'seconds' => $diff->s];
//    }

    public function getRemainingTimeAttribute()
    {
        $now  = Carbon::now();
        $end  = Carbon::parse($this->end_date);
        $diff = $end->diff($now);


        return ['days' => $diff->d, 'hours' => $diff->h,'minutes' => $diff->m, 'seconds' => $diff->s];
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

    public function auctiondata()
    {
        return $this->hasMany(AuctionData::class);
    }

    // do the samething as auctiondata
    public function option_details()
    {
        return $this->belongsToMany(OptionDetail::class,'auction_data','auction_id','option_details_id');
    }

    public function buyers()
    {
        return $this->belongsToMany(User::class,'auction_buyers','auction_id','buyer_id');
    }


    public function auctionimages()
    {
        return $this->hasMany(AuctionImage::class,'auction_id');
    }

    public function inspectionimages()
    {
        return $this->hasMany(InspectionImage::class,'auction_id');
    }

    public function auctionbuyers()
    {
        return $this->hasMany(AuctionBuyer::class,'auction_id');
    }

    public function watchedauctions()
    {
        return $this->hasMany(WatchedAuction::class, 'auction_id');
    }



    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

//    public function options()
//    {
//        return $this->belongsToMany(Option::class, 'auction_data');
//    }

//    public function option_details()
//    {
//        return $this->hasMany(AuctionData::class,'option_details_id');
//    }





    //    public function getNameAttribute()
//    {
//        return $this->name_.app()->getLocale();
//    }

//    public function getDescriptionAttribute()
//    {
//        return \Str::limit($this->attributes['description'], 10);
//    }



//    public function getRemainingTimeAttribute()
//    {
//        if ($this->end_date) {
//            if (Carbon::parse($this->end_date) < Carbon::now()){
//                return "ended";
//            }
//            $start  = new Carbon($this->end_date);
//            $end    =  Carbon::now();
//            $diff = $start->diff($end);
//        } else {
//            $diff = 0;
//        }
//        return ' days '. $diff->d . '/' . ' hours ' . $diff->h ;
////        return $diff->y . ' years ' . $diff->d . ' days ' . $diff->h . ' hours';
//    }


}
