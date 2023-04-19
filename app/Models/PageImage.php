<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageImage extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

    public function getImagePathAttribute()
    {
        $image = PageImage::where('id', $this->id)->first()->image;
        if (!$image) {
            return asset('uploads/default.png');
        }
        return asset('uploads/pages/' . $this->image);
    }

}
