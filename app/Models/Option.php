<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function auction_data()
    {
        return $this->belongsTo(AuctionData::class,'option_id');
    }


    public function option_details()
    {
        return $this->hasMany(OptionDetail::class);
    }
}
