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
            $auction_terms = 'auction_terms_ar';
            $about_app = 'about_app_ar';

            $site_meta_description = 'site_meta_description_ar';
            $site_meta_title = 'site_meta_title_ar';
            $site_meta_keywords = 'site_meta_keywords_ar';

        } elseif (LaravelLocalization::getCurrentLocale() == 'en') {
            $name = 'name_en';
            $value = 'value_en';
            $description = 'description _en';
            $question = 'question_en';
            $replay = 'replay_en';
            $conditions_terms = 'conditions_terms_en';
            $auction_terms = 'auction_terms_en';
            $about_app = 'about_app_en';

            $site_meta_description = 'site_meta_description_en';
            $site_meta_title = 'site_meta_title_en';
            $site_meta_keywords = 'site_meta_keywords_en';
        }
        View::share('name', $name);
        View::share('value', $value);
        View::share('description', $description);
        View::share('question', $question);
        View::share('replay', $replay);
        View::share('conditions_terms', $conditions_terms);
        View::share('auction_terms', $auction_terms);
        View::share('about_app', $about_app);

        View::share('site_meta_description', $site_meta_description);
        View::share('site_meta_title', $site_meta_title);
        View::share('site_meta_keywords', $site_meta_keywords);


    }
}
