<?php

use App\Http\Controllers\front\AuctionController;
use App\Http\Controllers\front\AuthController;
use App\Http\Controllers\front\GeneralController;
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\front\UserController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
//
//Auth::routes();
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {

//    Route::group(['prefix' => 'front'], function () {
    Route::get('/', [HomeController::class, 'home'])->name('front.home');

// ============ for auth ================
    Route::get('show_register', [AuthController::class, 'show_register'])->name('front.show_register');
    Route::post('register', [AuthController::class, 'register'])->name('front.register');
    Route::get('show_activation', [AuthController::class, 'show_activation'])->name('front.show_activation');
    Route::post('check_code', [AuthController::class, 'checkCode'])->name('front.check_code');
    Route::get('show_login', [AuthController::class, 'show_login'])->name('front.show_login');
    Route::post('login', [AuthController::class, 'login'])->name('front.login');
// ============ /for auth ================


    Route::get('questions', [GeneralController::class, 'questions'])->name('front.questions');
    Route::get('about_app', [GeneralController::class, 'about_app'])->name('front.about_app');
    Route::get('category/{id}/auctions', [AuctionController::class, 'categoryAuctions'])->name('front.category_auctions');
    Route::get('auction_details/{id}', [AuctionController::class, 'auction_details'])->name('front.auction_details');

    Route::group(['middleware' => 'checkUserAuth'], function () {
        Route::any('/logout', [AuthController::class, 'logout'])->name('front.logout');
        Route::any('my_profile', [UserController::class, 'showProfile'])->name('front.my_profile');
    });
});

