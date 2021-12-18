<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $guard='admin';


    public function admin_role()
    {
        return $this->belongsTo('App\Models\Admin_role', 'admin_role_id')->withDefault(['name' => 'لا يوجد']);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }


    public function getImagePathAttribute()
    {
        $image = Admin::where('id', $this->id)->first()->image;
        if (!$image) {
            return asset('uploads/default.png');
        }
        return asset('uploads/admins/' . $this->image);
    }


}
