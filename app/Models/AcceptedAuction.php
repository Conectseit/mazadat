<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcceptedAuction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function auction()
    {
        return $this->belongsTo(Auction::class, 'auction_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
