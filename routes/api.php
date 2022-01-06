<?php

use App\Http\Controllers\Api\Auctions\AuctionController;
use App\Http\Controllers\Api\Auctions\FilterController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\NationalityController;
use App\Http\Controllers\Api\NotificationController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();


Route::group(['namespace' => 'Api'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('activation', [AuthController::class, 'activation']);
    Route::any('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('jwt.auth');

//    Route::any('reset_password_page', [UserController::class, 'ResetPassword']);
//    Route::any('reset_password', [UserController::class, 'DoResetPassword']);


    //=========== questions ============
    Route::get('questions', [QuestionController::class, 'index']);

    //=========== settings ============
//    Route::get('settings/{key?}', [SettingController::class, 'show']);
    Route::get('our_officers', [SettingController::class, 'our_officers']);
    Route::get('bank', [SettingController::class, 'bank']);
    Route::get('cities', [CityController::class, 'cities']);
    Route::get('nationalities', [NationalityController::class, 'nationalities']);
    Route::get('about_app', [SettingController::class, 'about_app']);
    Route::get('conditions_terms', [SettingController::class, 'conditions_terms']);

    //=========== category ===========
    Route::get('all_categories', [CategoryController::class, 'index']);
    Route::post('category/{id}/auctions', [CategoryController::class, 'categoryAuctions']);

    //=========== filter category ===========
    Route::post('main_filter_category/{id}/auctions', [FilterController::class,'main_filter']);
    Route::post('filter_category/{id}/auctions', [FilterController::class,'filter_category']);
    Route::post('get_options_of_category/{id}', [FilterController::class,'get_options_of_category']);

    //=========== auction ============
    Route::post('auction/{id}', [AuctionController::class, 'auction']);

    Route::group(['middleware' => 'jwt.auth'], function () {

        //=========== User_profile ============
        Route::get('my_profile', [AuthController::class, 'showProfile']);
        Route::post('update_my_profile', [AuthController::class, 'updateProfile']);
        Route::post('update_personal_image', [AuthController::class, 'update_personal_image']);
        Route::post('add_additional_contact', [AuthController::class, 'add_additional_contact']);
        Route::post('change_password', [AuthController::class, 'changePassword']);
        Route::post('forget_password', [AuthController::class, 'forget_password']);


        Route::get('update_preferred_language', [UserController::class, 'updatePreferredLanguage']);
        Route::get('get_preferred_language', [UserController::class, 'getPreferredLanguage']);

        Route::post('add_traffic_file_number', [UserController::class, 'add_traffic_file_number']);
        Route::post('upload_passport', [UserController::class, 'upload_passport']);
        Route::get('my_document', [UserController::class, 'my_document']);
        Route::post('add_document', [UserController::class, 'add_document']);
        Route::post('choose_available_limit', [UserController::class, 'choose_available_limit']);
        Route::any('my_wallet', [UserController::class, 'my_wallet']);


        // =========== auctions ============
        Route::post('watched_auctions', [AuctionController::class, 'watched_auctions']);
        Route::post('make_auction/{id}/watch', [AuctionController::class, 'watch_auction']);

        // =========== bids ============
        Route::get('my_bids', [AuctionController::class, 'my_bids']);
        Route::post('make_bid/{id}', [AuctionController::class, 'make_bid']);
        Route::post('make_offer/{id}', [AuctionController::class, 'make_offer']);

        //=========== notifications ============
        Route::get('notifications', [NotificationController::class, 'index']);

    });
});







//Route::group([ 'namespace' => 'Api', 'prefix' => 'auth'], function ($router) {
//    Route::post('/login', [AuthController::class, 'login']);
//    Route::post('/register', [AuthController::class, 'register']);
//    Route::post('/logout', [AuthController::class, 'logout']);
//    Route::post('/refresh', [AuthController::class, 'refresh']);
//    Route::get('/user-profile', [AuthController::class, 'userProfile']);
//});
