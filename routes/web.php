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
        Route::get('my_bids', [AuctionController::class, 'my_bids'])->name('front.my_bids');
        Route::get('watch_auction/{auction}', [AuctionController::class, 'watch_auction'])->name('front.watch_auction');

        Route::get('make_bid/{id}', [AuctionController::class, 'make_bid'])->name('front.make_bid');
        Route::get('my_watched', [AuctionController::class, 'my_watched'])->name('front.my_watched');

        Route::any('edit_profile', [UserController::class, 'editProfile'])->name('front.edit_profile');
        Route::any('update_personal_image', [UserController::class, 'update_personal_image'])->name('front.update_personal_image');
        Route::any('update_personal_bio', [UserController::class, 'update_personal_bio'])->name('front.update_personal_bio');
        Route::any('update_profile', [UserController::class, 'updateProfile'])->name('front.update_profile');

        Route::any('my_wallet', [UserController::class, 'my_wallet'])->name('front.my_wallet');
        Route::any('cheque_payment', [UserController::class, 'cheque_payment'])->name('front.cheque_payment');
        Route::any('online_payment', [UserController::class, 'online_payment'])->name('front.online_payment');
        Route::any('bank_deposit', [UserController::class, 'bank_deposit'])->name('front.bank_deposit');
    });
});

