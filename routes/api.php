<?php

use App\Http\Controllers\Api\Auctions\AuctionController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\SettingController;
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
    Route::any('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('jwt.auth');


    //=========== questions ============
    Route::get('questions', [QuestionController::class, 'index']);

    //=========== settings ============
    Route::get('settings/{key?}', [SettingController::class, 'show']);

    //=========== category ===========
    Route::get('all_categories', [CategoryController::class, 'index']);
    Route::post('category/{id}/auctions', [CategoryController::class, 'categoryAuctions']);

    //=========== auction ============
    Route::post('auction/{id}', [AuctionController::class, 'auction']);

    Route::group(['middleware' => 'jwt.auth'], function () {

        //=========== User_profile ============
        Route::get('my_profile', [AuthController::class, 'showProfile']);
        Route::post('update_my_profile', [AuthController::class, 'updateProfile']);
        Route::post('add_additional_contact', [AuthController::class, 'add_additional_contact']);
        Route::post('change_password', [AuthController::class, 'changepassword']);


        Route::post('watched_auctions', [AuctionController::class, 'watched_auctions']);
        Route::post('make_auction/{id}/watch', [AuctionController::class, 'watch_auction']);
//        Route::post('update_my_profile_image', [AuthController::class, 'updateProfileImage']);

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
