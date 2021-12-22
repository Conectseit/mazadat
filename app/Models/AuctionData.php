<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuctionData extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function auctions()
    {
        return $this->hasMany(Auction::class,'auction_id');
    }
    public function options()
    {
        return $this->hasMany(Option::class,'option_id');
    }

    public function option_details()
    {
        return $this->hasMany(OptionDetail::class,'option_details_id');
    }
}
