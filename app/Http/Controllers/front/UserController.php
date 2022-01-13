<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showProfile()
    {
        $data['user'] = User::where('id', auth()->user()->id)->first();
        return view('front.user.my_profile', $data);
    }
}
