<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getImagePathAttribute()
    {
        $image = Blog::where('id', $this->id)->first()->image;
        if (!$image) {
            return asset('default.png');
        }
        return asset('uploads/blogs/' . $this->image);
    }


    public function getImage2PathAttribute()
    {
        $image2 = Blog::where('id', $this->id)->first()->image2;
        if (!$image2) {
            return asset('default.png');
        }
        return asset('uploads/blogs/' . $this->image2);
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id')->withDefault(['name_ar' => '== ']);
    }
}
