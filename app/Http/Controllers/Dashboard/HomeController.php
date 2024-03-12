<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\Category;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    //
    public  function home()
    {
        $data['auctions'] = Auction::latest()->take(3)->get();
        $data['latest_persons'] = User::where(['is_company'=> 'person','is_active'=>'active'])->latest()->take(3)->get();
        $data['latest_companies'] = User::where(['is_company'=> 'company','is_active'=>'active'])->latest()->take(3)->get();
        $data['categories'] = Category::where('menu',1)->latest()->take(4)->get();
        $data['cities_count'] = City::count();
        $data['categories_count'] = City::count();
        return  view('Dashboard.Home.home',$data);
    }

//        notify()->success('Laravel Notify is awesome!');

}
