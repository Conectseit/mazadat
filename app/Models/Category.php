<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

//    public function getNameAttribute()
//    {
//        return $this->name_.app()->getLocale();
//    }



    public function getImagePathAttribute()
    {
        $image = Category::where('id', $this->id)->first()->image;
        if (!$image) {
            return asset('uploads/default.png');
        }
        return asset('uploads/categories/' . $this->image);
    }

    public function getDescriptionAttribute()
    {
        return \Str::limit($this->attributes['description'], 10);
    }
    public function options()
    {
        return $this->hasMany(Option::class)->with('option_details');
    }
    public function option_details()
    {
        return $this->hasManyThrough(OptionDetail::class, Option::class);
    }
    public function auctions()
    {
        return $this->hasMany(Auction::class);
    }
    public function personAuctions()
    {
        return $this->hasMany(InPersonAuction::class);
    }
    public function parent()
    {

        return $this->belongsTo(Category::class, 'parent_id');

    }

    public function children()
    {

        return $this->hasMany(Category::class, 'parent_id');

    }

    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }
}
