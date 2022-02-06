<?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\AuctionDataController;
use App\Http\Controllers\Dashboard\CountryController;
use App\Http\Controllers\Dashboard\NationalityController;
use App\Http\Controllers\Dashboard\NotificationController;
use App\Http\Controllers\Dashboard\OptionController;
use App\Http\Controllers\Dashboard\OptionDetailController;
use App\Http\Controllers\Dashboard\PermissionController;
use App\Http\Controllers\Dashboard\AuctionController;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\BuyerController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\CityController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\QuestionController;
use App\Http\Controllers\Dashboard\SellerController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\HomeController;
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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {

    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/show_login', [AuthController::class, 'loginView'])->name('admin.login');
        Route::post('/login', [AuthController::class, 'login'])->name('admin.submit.login');


        Route::group(['middleware' => 'CheckAuthAdmin'], function () {
            Route::any('/logout', [AuthController::class, 'logout'])->name('admin.logout');
            Route::get('home', [HomeController::class, 'home'])->name('admin.home');
            Route::get('showProfile', [AuthController::class, 'showProfile'])->name('admin.showProfile');
            Route::put('updateProfile/{admin}', [AuthController::class, 'updateProfile'])->name('admin.updateProfile');
            ;

            Route::group(['middleware' => 'CheckPermission'], function () {
                Route::resources([
                    'sellers'        => SellerController::class,
                    'buyers'         => BuyerController::class,
                    'categories'     => CategoryController::class,
                    'options'        => OptionController::class,
                    'option_details' => OptionDetailController::class,
                    'cities'         => CityController::class,
                    'countries'      => CountryController::class,
                    'nationalities'  => NationalityController::class,
                    'questions'      => QuestionController::class,
                    'contacts'       => ContactController::class,
                    'auctions'       => AuctionController::class,
                    'auction_data'   => AuctionDataController::class,
                    'permissions'    => PermissionController::class,
                    'admins'         => AdminController::class,
                    'transactions'    => TransactionController::class,
//                'settings'     => SettingsController::class,
                ]);

                Route::post('/ajax-delete-seller', [SellerController::class, 'destroy'])->name('ajax-delete-seller');
                Route::post('/ajax-delete-buyer', [BuyerController::class, 'destroy'])->name('ajax-delete-buyer');
                Route::post('/ajax-delete-category', [CategoryController::class, 'destroy'])->name('ajax-delete-category');
                Route::post('/ajax-delete-option', [OptionController::class, 'destroy'])->name('ajax-delete-option');
                Route::post('/ajax-delete-option_detail', [OptionDetailController::class, 'destroy'])->name('ajax-delete-option_detail');
                Route::post('/ajax-delete-nationality', [NationalityController::class, 'destroy'])->name('ajax-delete-nationality');
                Route::post('/ajax-delete-country', [CountryController::class, 'destroy'])->name('ajax-delete-country');
                Route::post('/ajax-delete-city', [CityController::class, 'destroy'])->name('ajax-delete-city');
                Route::post('/ajax-delete-auction', [AuctionController::class, 'destroy'])->name('ajax-delete-auction');
                Route::post('/ajax-delete-image', [AuctionController::class, 'deleteImage'])->name('ajax-delete-image');
                Route::post('/ajax-delete-auction_data', [AuctionDataController::class, 'delete_auction_data'])->name('ajax-delete-auction_data');
                Route::post('/ajax-delete-permission', [PermissionController::class, 'destroy'])->name('ajax-delete-permission');
                Route::post('/ajax-delete-admin', [AdminController::class, 'destroy'])->name('ajax-delete-admin');
                Route::post('/ajax-delete-contact', [ContactController::class, 'destroy'])->name('ajax-delete-contact');
                Route::post('/ajax-delete-question', [QuestionController::class, 'destroy'])->name('ajax-delete-question');
                Route::post('/ajax-delete-transaction', [TransactionController::class, 'destroy'])->name('ajax-delete-transaction');

                Route::get('buyer/{id?}/accept', [BuyerController::class, 'accept'])->name('buyer/accept');
                Route::get('buyer/{id?}/not_accept', [BuyerController::class, 'not_accept'])->name('buyer/not_accept');

                Route::get('seller/{id?}/accept', [SellerController::class, 'accept'])->name('seller/accept');
                Route::get('seller/{id?}/not_accept', [SellerController::class, 'not_accept'])->name('seller/not_accept');


                Route::get('transaction/{id?}/accept', [TransactionController::class, 'accept'])->name('transaction/accept');

                Route::post('send_single_notify', [NotificationController::class, 'send_single_notify'])->name('send_single_notify');


                Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
                Route::put('settings/update', [SettingController::class, 'update'])->name('settings.update');
                Route::put('add_option_detail/{option_id}', [CategoryController::class, 'add_option_detail'])->name('add_option_detail');

                Route::post('ajax_get_options_by_category_id', [AuctionController::class, 'get_options_by_category_id'])->name('ajax_get_options_by_category_id');
                Route::post('ajax_get_option_details_by_option_id', [AuctionController::class, 'get_option_details_by_option_id'])->name('ajax_get_option_details_by_option_id');


            });
        });
    });
});



Route::get('/test', function () {
//    return  view('Dashboard.Home.test-table');
    return  view('Dashboard.layouts.master');

});
