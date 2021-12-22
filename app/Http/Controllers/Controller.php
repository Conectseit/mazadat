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
            $value = 'value_ar';
            $description = 'description_ar';
            $question = 'question_ar';
            $replay = 'replay_ar';
            $conditions_terms = 'conditions_terms_ar';
            $about_app = 'about_app_ar';

        } elseif (LaravelLocalization::getCurrentLocale() == 'en') {
            $name = 'name_en';
            $value = 'value_en';
            $description = 'description _en';
            $question = 'question_en';
            $replay = 'replay_en';
            $conditions_terms = 'conditions_terms_en';
            $about_app = 'about_app_en';
        }
        View::share('name', $name);
        View::share('value', $value);
        View::share('description', $description);
        View::share('question', $question);
        View::share('replay', $replay);
        View::share('conditions_terms', $conditions_terms);
        View::share('about_app', $about_app);

    }
}
