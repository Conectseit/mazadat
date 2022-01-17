<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
//    protected $fillable = [
//        'name',
//        'email',
//        'password',
//    ];
    protected $guarded = ['id'];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token',];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }
    public function token()
    {
        return $this->hasOne('App\Models\Token');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function seller_auctions()
    {
        return $this->hasMany(Auction::class,'seller_id');
    }
    public function buyer_auctions()
    {
        return $this->hasMany(Auction::class,'buyer_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class,'user_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class,'nationality_id');
    }

    public function additional_contacts()
    {
        return $this->hasMany(AdditionalUserContact::class,'user_id');
    }

    public function auctionbuyers()
    {
        return $this->hasMany(AuctionBuyer::class, 'buyer_id');
    }


    public function getImagePathAttribute()
    {
        $image = User::where('id', $this->id)->first()->image;
        if (!$image) {
            return asset('uploads/default.png');
        }
        return asset('uploads/users/' . $this->image);
    }
    public function getPassportImagePathAttribute()
    {
        $passport_image = User::where('id', $this->id)->first()->passport_image;
        if (!$passport_image) {
            return asset('uploads/default.png');
        }
        return asset('uploads/users/' . $this->passport_image);
    }

    public function getCommercialRegisterImagePathAttribute()
    {
        $commercial_register_image = User::where('id', $this->id)->first()->commercial_register_image;
        if (!$commercial_register_image) {
            return asset('uploads/default.png');
        }
        return asset('uploads/users/' . $this->commercial_register_image);
    }


    public function auctions()
    {
        return $this->belongsToMany(Auction::class, 'watched_auctions');
    }


    public function bidauctions()
    {
        return $this->belongsToMany(Auction::class, 'auction_buyers','buyer_id');
    }


    public function documents()
    {
        return $this->hasMany(Document::class);
    }



//====================================================================
//    public function setImageAttribute($image)
//    {
//        if (isset($this->attributes['image'])) {
//            if ($this->attributes['image'] != null || $this->attributes['image'] != "") {
//                $oldImagePath = storage_path('app/' . $this->attributes['image']);
//                if (file_exists($oldImagePath)) {
//                    unlink($oldImagePath);
//                }
//            }
//        }
//        if ($image != null) {
//            $fileName = time() . Str::random(20) . '.' . $image->getClientOriginalExtension();
//            Image::make($image)
//                ->resize('300', null, function ($ratio) {
//                    $ratio->aspectRatio();
//                })
//                ->save(storage_path('app/images/avatars/' . $fileName));
//            $this->attributes['image'] = 'images/avatars/' . $fileName;
//        }
//    }
}
