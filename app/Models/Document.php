<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function getFrontSideImageAttribute()
    {
        $front_side_image = User::where('id', $this->id)->first()->front_side_image;
        if (!$front_side_image) {
            return asset('uploads/default.png');
        }
        return asset('uploads/users/' . $this->front_side_image);
    }
    public function getBackSideImageAttribute()
    {
        $back_side_image = User::where('id', $this->id)->first()->back_side_image;
        if (!$back_side_image) {
            return asset('uploads/default.png');
        }
        return asset('uploads/users/' . $this->back_side_image);
    }
}
