<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function getImagePathAttribute()
    {
        $image = Payment::where('id', $this->id)->first()->image;
        if (!$image) {
            return asset('uploads/default.png');
        }
        return asset('uploads/payments/' . $this->image);
    }

    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
