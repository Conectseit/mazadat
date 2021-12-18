<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\Category;
use App\Models\City;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    //
    public  function home()
    {
//        notify()->success('Laravel Notify is awesome!');

        $data['auctions'] = Auction::latest()->take(3)->get();
        $data['categories'] = Category::latest()->take(4)->get();
        $data['cities_count'] = City::count();
        $data['categories_count'] = City::count();
        return  view('Dashboard.Home.home',$data);
    }


}
