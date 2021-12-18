<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
//use Illuminate\Support\Facades\View;

use View;
use LaravelLocalization;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        if (LaravelLocalization::getCurrentLocale() == 'ar') {
            $name = 'name_ar';
            $description = 'description_ar';

        } elseif (LaravelLocalization::getCurrentLocale() == 'en') {
            $name = 'name_en';
            $description = 'description _en';
        }
        View::share('name', $name);
        View::share('description', $description);

    }
}
