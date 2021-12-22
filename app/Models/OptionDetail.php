<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function option()
    {
        return $this->belongsTo(Option::class);
    }
    public function auction_data()
    {
        return $this->belongsTo(AuctionData::class,'option_details_id');
    }
}
