<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionImage extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function auction()
    {
        return $this->belongsTo(Auction::class, 'auction_id');
    }

    public function getImagePathAttribute()
    {
        $image = InspectionImage::where('id', $this->id)->first()->image;
        if (!$image) {
            return asset('uploads/default.png');
        }
        return asset('uploads/auctions/' . $this->image);
    }


}
