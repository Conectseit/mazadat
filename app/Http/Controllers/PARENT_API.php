<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use JWTAuth;

class PARENT_API extends Controller
{
    public $lang;
    public $user;

    function __construct(Request $request)
    {
        $this->Set_Request_Language($request);
        if ($request->header('Authorization') && JWTAuth::parseToken()) {
            try {
                // JWTAuth::parseToken()->authenticate()
                $this->user = JWTAuth::parseToken()->toUser();
            } catch (\Exception $e) {
                return false;
            }
        }
    }

    function Set_Request_Language($request)
    {
        if ($request->header('lang')) {
            $this->lang = ($request->header('lang') == "ar") ? "ar" : "en";
        } else {
            $this->lang = "ar";
        }
        App::setLocale($this->lang);
        Carbon::setLocale($this->lang);
    }
}
