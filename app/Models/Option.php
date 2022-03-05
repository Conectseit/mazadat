<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function getOptionsByCategoryId($request)
    {
        $category = Category::find($request->category_id);

        if (!$category) return response()->json(['status' => false], 500);

        return response()->json(['options' => $category->options, 'status' => true]);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function auction_data()
    {
        return $this->hasMany(AuctionData::class,'option_id');
    }


    public function option_details()
    {
        return $this->hasMany(OptionDetail::class);
    }
}
