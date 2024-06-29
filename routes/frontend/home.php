<?php
// echo "imhere"; exit;
use App\Http\Controllers\DynamicPagesController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\EventController;
use App\Http\Controllers\Frontend\VenueController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\WebsiteController;
use App\Http\Controllers\Frontend\User\AccountController;
use App\Http\Controllers\Frontend\User\ProfileController;
use App\Http\Controllers\Frontend\User\DashboardController;
use App\Http\Controllers\Frontend\User\UserEventController;
use App\Http\Controllers\Frontend\User\UserPaymentController;

/**
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('testemail', [SearchController::class, 'testEmail'])->name('test');
// Route::get('/', [HomeController::class, 'old_index'])->name('old_index');
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/{slug}', [DynamicPagesController::class, 'show'])->name('show');
Route::get('home/events/load', [HomeController::class, 'loadHomeEvents'])->name('home.events.load');
Route::get('home/developer', [HomeController::class, 'test'])->name('home.events.test');

Route::get('contact', [ContactController::class, 'index'])->name('contact');
Route::post('speed-dating-calgary/contact/send', [ContactController::class, 'send'])->name('contact.send');

//Add-ons
Route::get('/speed-dating-calgary/add-on-pages', [HomeController::class, 'addOnPages'])->name('addOnPages');

// Events
Route::get('events', [EventController::class, 'old_index'])->name('events.old_index');
Route::get('singles-events-in-calgary', [EventController::class, 'index'])->name('events.index');
Route::get('events/load', [EventController::class, 'loadEvents'])->name('events.ajax.load');
Route::get('thanks', [EventController::class, 'thanksPage'])->name('events.thanksPage');

Route::get('singles-events-in-calgary/{id}/{slug?}', [EventController::class, 'show'])->name('event.show');
Route::get('speed-dating-calgary-events/{id}/{slug?}', [EventController::class, 'pastEventDetailShow'])->name('pastEventDetailShow');

Route::get('account-deleted', [AccountController::class, 'accountDeletedSuccess'])->name('accountDeletedSuccess');
//Past Events
Route::get('/speed-dating-calgary', [EventController::class, 'pastEvents'])->name('pastEvents');

// Route::get('events/show', [EventController::class, 'show'])->name('events.show');
// Route::get('events/register', [EventController::class, 'register'])->name('events.register');
Route::group(['middleware' => 'auth'], function () {
    Route::post('event/waitlist/{id}', [EventController::class, 'waitList'])->name('events.waitlist');
    Route::post('event/register/{id}', [EventController::class, 'register'])->name('contact.register');

    //updated on 18 april 2024
    Route::get('singles-events-in-calgary/waiver/{id}/{slug?}', [EventController::class, 'waiver'])->name('events.waiver.index');
    Route::post('singles-events-in-calgary/waiver/{id}', [EventController::class, 'waiverPost'])->name('events.waiver.post');
    Route::get('singles-events-in-calgary/checkout/{id}/{slug?}', [EventController::class, 'checkout'])->name('events.checkout');
    Route::post('singles-events-in-calgary/checkout/{id}', [EventController::class, 'checkoutPost'])->name('events.checkout.post');
    Route::post('singles-events-in-calgary/checkout/credit/{id}', [EventController::class, 'checkoutCreditPost'])->name('events.checkout.creditpost');
    Route::post('singles-events-in-calgary/matches', [EventController::class, 'showmatch'])->name('events.showmatch');
});
// Venue
Route::get('venue', [VenueController::class, 'index'])->name('venue.index');
Route::get('venue/show', [VenueController::class, 'show'])->name('venue.show');
// Blog
// Route::get('blog', [BlogController::class, 'index'])->name('blog.index');
// Route::get('blog/show', [BlogController::class, 'show'])->name('blog.show');

Route::get('faq', [WebsiteController::class, 'faq'])->name('faq');
Route::get('about', [WebsiteController::class, 'about'])->name('about');
Route::get('testimonials', [WebsiteController::class, 'testimonials'])->name('testimonials');

Route::get('policies', [WebsiteController::class, 'policies'])->name('policies');
Route::get('how-it-works', [WebsiteController::class, 'how'])->name('how');
Route::get('testview', [SearchController::class, 'test'])->name('testview');
// Search
Route::any('events/search', [SearchController::class, 'index'])->name('events.search');


// 'csv'
Route::get('csv', [SearchController::class, 'csv'])->name('csv');
// CSV Test
Route::get('csv_users', [SearchController::class, 'addUserByCSV'])->name('csv_users');
/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 * These routes can not be hit if the password is expired
 */
Route::group(['middleware' => ['auth', 'password_expires']], function () {
    Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
        /*
         * User Dashboard Specific
         */
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        /*
         * User Account Specific
         */
        Route::get('account', [AccountController::class, 'index'])->name('account');
        Route::get('account/delete/{id}', [AccountController::class, 'accountDelete'])->name('accountDelete');
        /*
         * Profile
         */
        Route::get('profile/{id}', [AccountController::class, 'profile'])->name('profile');
        /*
         * Match Update
         */
        Route::post('match/update', [AccountController::class, 'matchUpdate'])->name('match.update');

        /*
         * User Events
         */
        Route::get('myevents', [UserEventController::class, 'index'])->name('myevents');

        /*
            Cancel Event
        */
        Route::get('hour-check', [UserEventController::class, 'hourCheck'])->name('hourCheck');

        Route::post('cancel-event', [UserEventController::class, 'cancelEvent'])->name('cancelEvent');

        /*
         * User Invoices
         */
        Route::get('invoices', [UserPaymentController::class, 'index'])->name('invoices');

        /*
         * User Credit
         */
        Route::get('credit', [UserPaymentController::class, 'creditShow'])->name('creditShow');


        Route::get('send-credit', [UserPaymentController::class, 'sendCreditView'])->name('sendCreditView');
        Route::post('send-credit-post', [UserPaymentController::class, 'sendCreditPost'])->name('sendCreditPost');


        /*
         * User Profile Specific
         */
        Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    });
});
