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

}
