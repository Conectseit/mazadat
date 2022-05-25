<?php

use App\Http\Controllers\Api\advertisemen\AdvertisementController;
use App\Http\Controllers\Api\Auctions\AuctionController;
use App\Http\Controllers\Api\Auctions\FilterController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\company\CompanyController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\NationalityController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\payment\PaymentController;


use App\Http\Controllers\Api\person\PersonController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::group(['namespace' => 'Api'], function () {

    //=========== auth ============
    Route::post('register_person', [PersonController::class, 'register_person']);
    Route::post('register_company', [CompanyController::class, 'register_company']);
    Route::post('activation', [AuthController::class, 'activation']);
    Route::post('resend-sms', [AuthController::class, 'resendSms']);
    Route::any('login', [AuthController::class, 'login']);


    Route::post('forget_password', [AuthController::class, 'forget_password']);
    Route::post('password_verify_token', [AuthController::class, 'verify']);
    Route::post('password_reset', [AuthController::class, 'passwordReset']);

    Route::post('logout', [AuthController::class, 'logout'])->middleware('jwt.auth');


    //=========== general ============
    Route::get('countries', [CountryController::class, 'countries']);
    Route::get('inspection_file_names', [AuctionController::class, 'inspection_file_names']);
    Route::get('nationalities', [NationalityController::class, 'nationalities']);
    Route::get('about_app', [SettingController::class, 'about_app']);
    Route::get('conditions_terms', [SettingController::class, 'conditions_terms']);
    Route::get('contact_us_number', [SettingController::class, 'contact_us_number']);
    //=========== questions ============
    Route::get('questions', [QuestionController::class, 'index']);

    //=========== contact_us ============
    Route::post('contact_us', [QuestionController::class, 'contact_us']);


    //===========  hoooome  ===========
    Route::get('all_advertisements', [AdvertisementController::class, 'index']);
    Route::get('all_categories', [CategoryController::class, 'index']);
    Route::post('category/{id}/auctions', [CategoryController::class, 'categoryAuctions']);
    Route::get('unique_auctions', [CategoryController::class, 'uniqueAuctions']);
    Route::any('all_companies', [CategoryController::class, 'all_companies']);
    Route::any('company/{id}/auctions', [CategoryController::class, 'companyAuctions']);

    //=========== auction details ============
    Route::post('auction/{id}', [AuctionController::class, 'auction']);

    //=========== filter category ===========
    Route::post('main_filter_category/{id}/auctions', [FilterController::class,'main_filter']);
    Route::post('filter_category/{id}/auctions', [FilterController::class,'filterCategory']);
    Route::post('get_options_of_category/{id}', [FilterController::class,'get_options_of_category']);

    Route::get('success-payment', [PaymentController::class, 'successPayment']);


// ========================== for authentication ============================
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::post('auth_contact', [QuestionController::class, 'auth_contact']);

        //=========== Person_profile ============
        Route::get('person_profile', [PersonController::class, 'person_profile']);
        Route::post('update_person_profile', [PersonController::class, 'update_person_profile']);
        Route::post('complete_person_profile', [PersonController::class, 'completePersonProfile']);
        Route::post('cities_by_country_id', [CityController::class, 'cities_by_country_id']);

        //=========== Company_profile ============
        Route::get('company_profile', [CompanyController::class, 'company_profile']);
        Route::post('update_company_profile', [CompanyController::class, 'update_company_profile']);


        Route::post('change_password', [AuthController::class, 'changePassword']);
        Route::post('add_address', [AuthController::class, 'addAddress']);
        Route::get('additional_address', [AuthController::class, 'additionalAddress']);


        Route::get('user_account_statement_bids', [UserController::class, 'user_account_statement_bids']);
        Route::get('user_account_statement_transactions', [UserController::class, 'user_account_statement_transactions']);


        // =========== auctions ============
        Route::post('watched_auctions', [AuctionController::class, 'watched_auctions']);
        Route::post('make_auction/{id}/watch', [AuctionController::class, 'watch_auction']);


        Route::post('add_auction', [AuctionController::class, 'add_auction']);
        Route::post('update_auction/{id}', [AuctionController::class, 'updateAuction']);
        Route::post('delete_auction/{id}', [AuctionController::class, 'deleteAuction']);
        Route::post('my_auctions', [UserController::class, 'my_auctions']); // مزاداتي الحالية والمنتهية
        Route::get('my_pending_auctions', [UserController::class, 'my_pending_auctions']); //

        // =========== bids ============
        Route::get('my_bids', [AuctionController::class, 'my_bids']);
        Route::post('make_bid/{id}', [AuctionController::class, 'make_bid']);
        Route::post('make_offer/{id}', [AuctionController::class, 'make_offer']);
        Route::post('cancel_bid_auction/{id}', [AuctionController::class, 'cancel_bid_auction']);

        //=========== notifications ============
        Route::get('notifications', [NotificationController::class, 'my_notification']);

        //=========== payment ======================
        Route::any('my_wallet', [UserController::class, 'my_wallet']);
        Route::post('choose_available_limit', [UserController::class, 'choose_available_limit']);

        Route::get('our_officers', [SettingController::class, 'our_officers']);
        Route::get('online_payment_conditions', [SettingController::class, 'online_payment_conditions']);
        Route::get('bank', [SettingController::class, 'bank']);

        Route::post('upload_payment_receipt', [PaymentController::class, 'upload_payment_receipt']);

        Route::post('send_payment', [PaymentController::class, 'sendPayment']);
    });
});





//        Route::get('cities', [CityController::class, 'cities']);
//        Route::post('add_traffic_file_number', [UserController::class, 'add_traffic_file_number']);
//        Route::post('upload_passport', [UserController::class, 'upload_passport']);
//        Route::post('add_document', [UserController::class, 'add_document']);
//        Route::get('my_document', [UserController::class, 'my_document']);
//        Route::get('my_passport', [UserController::class, 'my_passport']);
//        Route::post('update_personal_image', [AuthController::class, 'update_personal_image']);

//        Route::post('complete_company_profile', [CompanyController::class, 'complete_company_Profile']);

//        Route::post('add_additional_contact', [AuthController::class, 'add_additional_contact']);



//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//=========== settings ============
//    Route::get('settings/{key?}', [SettingController::class, 'show']);


//        Route::get('update_preferred_language', [UserController::class, 'updatePreferredLanguage']);
//        Route::get('get_preferred_language', [UserController::class, 'getPreferredLanguage']);

//Route::group([ 'namespace' => 'Api', 'prefix' => 'auth'], function ($router) {
//    Route::post('/login', [AuthController::class, 'login']);
//    Route::post('/register', [AuthController::class, 'register']);
//    Route::post('/logout', [AuthController::class, 'logout']);
//    Route::post('/refresh', [AuthController::class, 'refresh']);
//    Route::get('/user-profile', [AuthController::class, 'userProfile']);
//});
