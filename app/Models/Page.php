<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getMainImagePathAttribute()
    {
        $main_image = Page::where('id', $this->id)->first()->main_image;
        if (!$main_image) {
            return asset('default.png');
        }
        return asset('uploads/pages/' . $this->main_image);
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id')->withDefault(['name_ar' => '== ']);
    }
}
