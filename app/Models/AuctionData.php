<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuctionData extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }
    public function option()
    {
        return $this->belongsTo(Option::class,'option_id');
    }

    public function option_detail()
    {
        return $this->belongsTo(OptionDetail::class,'option_details_id');
    }
}
