<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin_role extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getPermissionsArrAttribute()
    {
        return json_decode($this->permissions);
    }

    public function admins()
    {
        return $this->hasMany('App\Models\Admin');
    }


//    public function setPlanAttribute($value)
//    {
//        if ($value) {
//            $this->attributes['plan'] = json_encode($value);
//        }
//    }

//    public function getPermAttribute($value)
//    {
//        return json_decode($this->attributes['permissions']);
//    }


}
