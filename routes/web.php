<?php

use App\Http\Controllers\front\AddAuctionController;
use App\Http\Controllers\front\AuctionController;
use App\Http\Controllers\front\AuthController;
use App\Http\Controllers\front\BlogController;
use App\Http\Controllers\front\CategoryController;
use App\Http\Controllers\front\company\CompanyController;
use App\Http\Controllers\front\FilterController;
use App\Http\Controllers\front\ForgetPassController;
use App\Http\Controllers\front\GeneralController;
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\front\NotificationController;
use App\Http\Controllers\front\PaymentController;
use App\Http\Controllers\front\person\PersonController;
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

Route::get('/cronjob/update-auction-on-progress', [HomeController::class, 'cronJobMakeAuctionOnProgress']);
Route::get('/cronjob/update-auction-done', [HomeController::class, 'cronJobMakeAuctionDone']);
Route::get('/cronjob/make-activation_code-expired', [HomeController::class, 'expireActivationCode']);

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {

    Route::get('/', function () {
        return view('front/splash_index');
    });
//    Route::group(['prefix' => 'front'], function () {
    Route::get('/home', [HomeController::class, 'home'])->name('front.home');
    Route::get('unique_auction', [HomeController::class, 'unique_auction'])->name('front.unique_auction');
    Route::get('latest_auctions', [HomeController::class, 'latest_auctions'])->name('front.latest_auctions');

    Route::get('all_companies', [HomeController::class, 'all_companies'])->name('front.all_companies');
    Route::get('company/{id}/auctions', [HomeController::class, 'companyAuctions'])->name('front.company_auctions');

    Route::get('show_blogs', [BlogController::class, 'show_blogs'])->name('front.show_blogs');
    Route::get('blogs', [BlogController::class, 'blogs'])->name('front.blogs');
    Route::get('blog_details/{id}', [BlogController::class, 'blog_details'])->name('front.blog_details');
    Route::get('pages', [BlogController::class, 'pages'])->name('front.pages');
    Route::get('page_details/{id}', [BlogController::class, 'page_details'])->name('front.page_details');


    // ============ // category ================
    Route::get('category/{category}/auctions', [CategoryController::class, 'categoryAuctions'])->name('front.category_auctions');
//    Route::post('search/{id}', [CategoryController::class, 'search'])->name('front.search');
    Route::post('main_filter_category/{id}/auctions', [FilterController::class, 'main_filter'])->name('front.main_filter');
    Route::post('filter_category/{id}/auctions', [FilterController::class, 'filterCategory'])->name('front.filter_category');
    Route::get('auction_details/{id}', [AuctionController::class, 'auction_details'])->name('front.auction_details');


// ============ for authentication ================
    Route::get('show_register', [AuthController::class, 'show_register'])->name('front.show_register');

// ============ register_person ================
    Route::get('show_register_person', [PersonController::class, 'show_register_person'])->name('front.show_register_person');
    Route::post('register_person', [PersonController::class, 'register_person'])->name('front.register_person');

    // ============ register_company ================
    Route::get('show_register_company', [CompanyController::class, 'show_register_company'])->name('front.show_register_company');
    Route::post('register_company', [CompanyController::class, 'register_company'])->name('front.register_company');

    Route::get('show_activation/{mobile}', [AuthController::class, 'show_activation'])->name('front.show_activation');
    Route::post('check_code', [AuthController::class, 'checkCode'])->name('front.check_code');
    Route::get('resend-sms/{mobile}', [AuthController::class, 'resendSms'])->name('front.resend-sms');
//    Route::post('resend-code', [AuthController::class, 'resendCode'])->name('front.resend-code');
    Route::get('show_login', [AuthController::class, 'show_login'])->name('front.show_login');
    Route::post('login', [AuthController::class, 'login'])->name('front.login');

    Route::post('forget_pass', [ForgetPassController::class, 'forget_pass'])->name('front.forget_pass');
    Route::get('reset-code-page/{email}', [ForgetPassController::class, 'resetCodePage'])->name('front.reset-code-page');
    Route::post('check-reset-code', [ForgetPassController::class, 'checkResetCode'])->name('front.check-reset-code');
    Route::get('change-password-page', [ForgetPassController::class, 'changePasswordPage'])->name('front.change-password-page');
    Route::post('resetPassword', [ForgetPassController::class, 'resetPassword'])->name('front.resetPassword');
// ============ // auth ================


    Route::post('contact_us', [GeneralController::class, 'contact_us'])->name('front.contact_us');
    Route::get('questions', [GeneralController::class, 'questions'])->name('front.questions');
    Route::get('about_app', [GeneralController::class, 'about_app'])->name('front.about_app');
    Route::get('condition_and_terms', [GeneralController::class, 'condition_and_terms'])->name('front.condition_and_terms');
    Route::get('description', [GeneralController::class, 'description'])->name('front.description');
    Route::get('privacy', [GeneralController::class, 'privacy'])->name('front.privacy');


    Route::group(['middleware' => 'checkUserAuth'], function () {
        Route::any('/logout', [AuthController::class, 'logout'])->name('front.logout');
        Route::post('auth_contact', [GeneralController::class, 'auth_contact'])->name('front.auth_contact');


        // ============ // bids ================
        Route::post('make_bid/{id}', [AuctionController::class, 'make_bid'])->name('front.make_bid');
        Route::get('my_bids', [AuctionController::class, 'my_bids'])->name('front.my_bids');
        Route::any('cancel_bid_auction/{auction}', [AuctionController::class, 'cancel_bid_auction'])->name('front.cancel_bid_auction');


        // ============ // watched ================
        Route::get('my_watched', [AuctionController::class, 'my_watched'])->name('front.my_watched');
        Route::get('watch_auction/{auction}', [AuctionController::class, 'watch_auction'])->name('front.watch_auction');
        Route::any('delete_watch_auction/{auction}', [AuctionController::class, 'delete_watch_auction'])->name('front.delete_watch_auction');

        Route::get('accept_auction_terms/{auction}', [AuctionController::class, 'accept_auction_terms'])->name('front.accept_auction_terms');


        // ============ // auctions ================
        Route::get('show_add_auction', [AuctionController::class, 'show_add_auction'])->name('front.show_add_auction');
        Route::post('add_auction', [AuctionController::class, 'add_auction'])->name('front.add_auction');


//        Route::get('show_add_auction1', [AddAuctionController::class, 'show_add_auction1'])->name('front.show_add_auction1');
//        Route::post('add_auction1', [AddAuctionController::class, 'add_auction1'])->name('front.add_auction1');



        Route::get('my_auctions', [AuctionController::class, 'my_auctions'])->name('front.my_auctions');
        Route::post('ajax/get-options-by-category-id', [AuctionController::class, 'get_options_by_category_id'])->name('front.ajax_get_options_by_category_id');
        Route::post('/ajax-delete-auction', [AuctionController::class, 'destroy'])->name('front.ajax-delete-auction');
        Route::any('auction_show_update/{auction}', [AuctionController::class, 'show_auction_update'])->name('front.auction_show_update');
        Route::any('auction_update/{auction}', [AuctionController::class, 'updateAuction'])->name('front.auction_update');


        // ============ // profile ================
        Route::any('update_personal_image', [UserController::class, 'update_personal_image'])->name('front.update_personal_image');

        Route::any('my_account_statement', [UserController::class, 'show_account_statement'])->name('front.my_account_statement');

        Route::any('my_profile', [UserController::class, 'showProfile'])->name('front.my_profile');
        Route::any('edit_profile', [UserController::class, 'showEditProfile'])->name('front.edit_profile');
        Route::any('update_profile', [UserController::class, 'updateProfile'])->name('front.update_profile');

        Route::any('show_complete_profile', [UserController::class, 'showCompleteProfile'])->name('front.show_complete_profile');
        Route::post('complete_profile', [UserController::class, 'completeProfile'])->name('front.complete_profile');
//        Route::any('show_my_addresses', [UserController::class, 'show_my_addresses'])->name('front.show_my_addresses');
//        Route::get('show_add_address', [UserController::class, 'show_add_address'])->name('front.show_add_address');
        Route::any('add_address', [UserController::class, 'addAddress'])->name('front.add_address');

        Route::any('choose_available_limit', [UserController::class, 'choose_available_limit'])->name('front.choose_available_limit');
        Route::any('my_wallet', [UserController::class, 'my_wallet'])->name('front.my_wallet');

        //=========== payment ============
        Route::any('cheque_payment', [PaymentController::class, 'cheque_payment'])->name('front.cheque_payment');
        Route::any('bank_deposit', [PaymentController::class, 'bank_deposit'])->name('front.bank_deposit');
        Route::any('send_sms_bank_info', [PaymentController::class, 'send_sms_bank_info'])->name('front.send_sms_bank_info');
        Route::any('upload_receipt', [PaymentController::class, 'upload_receipt'])->name('front.upload_receipt');

        Route::any('online_payment', [PaymentController::class, 'online_payment'])->name('front.online_payment');
        Route::post('send-payment', [PaymentController::class, 'sendPayment'])->name('front.send_payment');
        Route::get('success-payment', [PaymentController::class, 'successPayment'])->name('front.success_payment');

        //=========== /notifications ============
        Route::get('my_notification', [NotificationController::class, 'my_notification'])->name('front.my_notification');

    });
    Route::post('ajax_get_cities_by_country_id', [AuthController::class, 'get_cities_by_country_id'])->name('get_cities_by_country_id');

});
