<?php

use App\Http\Controllers\Dashboard\ActivityController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\AdvertisementController;
use App\Http\Controllers\Dashboard\AuctionDataController;
use App\Http\Controllers\Dashboard\CompanyController;
use App\Http\Controllers\Dashboard\CountryController;
use App\Http\Controllers\Dashboard\FinancialReviewsController;
use App\Http\Controllers\Dashboard\InspectionFileNameController;
use App\Http\Controllers\Dashboard\MessageController;
use App\Http\Controllers\Dashboard\NationalityController;
use App\Http\Controllers\Dashboard\NotificationController;
use App\Http\Controllers\Dashboard\OptionController;
use App\Http\Controllers\Dashboard\OptionDetailController;
use App\Http\Controllers\Dashboard\PermissionController;
use App\Http\Controllers\Dashboard\AuctionController;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\CityController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\PersonController;
use App\Http\Controllers\Dashboard\QuestionController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\TransactionController;
use App\Http\Controllers\Dashboard\UserController;
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

        Route::get('view/{id?}', [AuctionController::class, 'view'])->name('view');
        Route::get('inspection_view_file/{id?}', [AuctionController::class, 'inspection_view_file'])->name('inspection_view_file');

        Route::group(['middleware' => 'CheckAuthAdmin'], function () {
            Route::any('/logout', [AuthController::class, 'logout'])->name('admin.logout');
            Route::get('home', [HomeController::class, 'home'])->name('admin.home');
            Route::get('showProfile', [AuthController::class, 'showProfile'])->name('admin.showProfile');
            Route::put('updateProfile/{admin}', [AuthController::class, 'updateProfile'])->name('admin.updateProfile');

            Route::group(['middleware' => 'CheckPermission'], function () {
                Route::resources([
                    'persons'        => PersonController::class,
                    'companies'      => CompanyController::class,
                    'categories'     => CategoryController::class,
                    'options'        => OptionController::class,
                    'option_details' => OptionDetailController::class,
                    'messages'       => MessageController::class,
                    'cities'         => CityController::class,
                    'countries'      => CountryController::class,
                    'nationalities'  => NationalityController::class,
                    'questions'      => QuestionController::class,
                    'contacts'       => ContactController::class,
                    'auctions'       => AuctionController::class,
                    'auction_data'   => AuctionDataController::class,
                    'permissions'    => PermissionController::class,
                    'admins'         => AdminController::class,
                    'activities'     => ActivityController::class,
                    'transactions'   => TransactionController::class,
                    'financial_reviews'     => FinancialReviewsController::class,
                    'advertisements'        => AdvertisementController::class,
                    'inspection_file_names' => InspectionFileNameController::class,

                ]);

                Route::post('/ajax-delete-person', [PersonController::class, 'destroy'])->name('ajax-delete-person');
                Route::post('/ajax-delete-company', [CompanyController::class, 'destroy'])->name('ajax-delete-company');
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
                Route::post('/ajax-delete-activity', [ActivityController::class, 'destroy'])->name('ajax-delete-activity');
                Route::post('/ajax-delete-contact', [ContactController::class, 'destroy'])->name('ajax-delete-contact');
                Route::post('/ajax-delete-question', [QuestionController::class, 'destroy'])->name('ajax-delete-question');
                Route::post('/ajax-delete-transaction', [TransactionController::class, 'destroy'])->name('ajax-delete-transaction');
                Route::post('/ajax-delete-advertisement', [AdvertisementController::class, 'destroy'])->name('ajax-delete-advertisement');
                Route::post('/ajax-delete-file_name', [InspectionFileNameController::class, 'destroy'])->name('ajax-delete-filename');
                Route::post('/ajax-delete-message', [MessageController::class, 'destroy'])->name('ajax-delete-message');

                Route::get('company/{id?}/unique', [CompanyController::class, 'unique'])->name('company/unique');
                Route::get('company/{id?}/not_unique', [CompanyController::class, 'not_unique'])->name('company/not_unique');

                Route::get('company/{id?}/accept', [CompanyController::class, 'accept'])->name('company/accept');
                Route::get('company/{id?}/not_accept', [CompanyController::class, 'not_accept'])->name('company/not_accept');

                Route::get('person/{id?}/verified', [PersonController::class, 'verified'])->name('verified');
                Route::get('person/{id?}/not_verified', [PersonController::class, 'not_verified'])->name('not_verified');


//                Route::get('auction/{id?}/done', [AuctionController::class, 'make_done'])->name('auction/done');
                Route::any('auction/{id?}/accept', [AuctionController::class, 'accept'])->name('auction/accept');
                Route::get('auction/{id?}/need_update', [AuctionController::class, 'need_update'])->name('auction/need_update');
                Route::get('auction/{id?}/unique', [AuctionController::class, 'unique'])->name('auction/unique');
                Route::get('auction/{id?}/not_unique', [AuctionController::class, 'not_unique'])->name('auction/not_unique');


                Route::get('download/{extra?}', [AuctionController::class, 'download'])->name('download');



                Route::get('user/{id?}/ban', [UserController::class, 'ban'])->name('ban');
                Route::get('user/{id?}/not_ban', [UserController::class, 'not_ban'])->name('not_ban');

                Route::post('user/{id?}/add_balance', [UserController::class, 'add_balance'])->name('add_balance');


                Route::get('transaction/{id?}/verify', [FinancialReviewsController::class, 'verify'])->name('transaction/verify');
                Route::get('transaction/{id?}/not_verify', [FinancialReviewsController::class, 'not_verify'])->name('transaction/not_verify');
                Route::get('transaction/{id?}/verify_cash', [FinancialReviewsController::class, 'verify_cash'])->name('transaction/verify_cash');

                Route::get('transaction/{id?}/accept', [TransactionController::class, 'accept'])->name('transaction/accept');
                Route::get('transaction/{id?}/not_accept', [TransactionController::class, 'not_accept'])->name('transaction/not_accept');

                Route::post('send_single_notify', [NotificationController::class, 'send_single_notify'])->name('send_single_notify');
                Route::post('send_notify_to_all_users', [NotificationController::class, 'send_notify_to_all_users'])->name('send_notify_to_all_users');
                Route::post('send_notify_to_all_companies', [NotificationController::class, 'send_notify_to_all_companies'])->name('send_notify_to_all_companies');

                Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
                Route::put('settings/update', [SettingController::class, 'update'])->name('settings.update');
                Route::put('add_option_detail/{option_id}', [CategoryController::class, 'add_option_detail'])->name('add_option_detail');

                Route::post('ajax_get_options_by_category_id', [AuctionController::class, 'get_options_by_category_id'])->name('ajax_get_options_by_category_id');
                Route::post('ajax_get_option_details_by_option_id', [AuctionController::class, 'get_option_details_by_option_id'])->name('ajax_get_option_details_by_option_id');


            });
        });
    });
});
