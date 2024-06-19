<?php

use App\Http\Controllers\DynamicPagesController;
use App\Http\Controllers\Backend\EmailController;
use App\Http\Controllers\Backend\EventController;
use App\Http\Controllers\Backend\MessageController;
use App\Http\Controllers\Backend\CalendarController;
use App\Http\Controllers\Backend\DashboardController;

/*
 * All route names are prefixed with 'admin.'.
 */

Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('postDbBackup', [
    'as'   => 'system.postDbBackup',
    'uses' => 'DashboardController@postDbBackup'
]);


Route::group([
    'prefix'     => 'event',
    'as'         => 'event.',
    // 'namespace'  => 'event',
    // 'middleware' => 'role:'.config('access.users.admin_role'), not role till clarify
], function () {
    Route::get('calendar', [CalendarController::class, 'index'])->name('calendar');
    Route::resource('/', 'EventController', ['only' => ['index', 'create', 'store']]);
    Route::post('/destroy/{id}', [EventController::class, 'destroy'])->name('destroy');
    Route::post('/duplicate/{id}', [EventController::class, 'duplicate'])->name('duplicate');
    Route::post('/select-past-event', [EventController::class, 'selectPastEvent'])->name('selectPastEvent');
    Route::get('/show/{id}', [EventController::class, 'show'])->name('show');
    Route::patch('/update/{id}', [EventController::class, 'update'])->name('update');
    Route::post('/add/user/{id}', [EventController::class, 'saveUser'])->name('add.user');
    Route::post('/search', [EventController::class, 'search'])->name('search');
    Route::get('registrants/pdf/{id}', [EventController::class, 'pdf'])->name('registrants-pdf');
    Route::get('complete/matches/{id}', [EventController::class, 'completeMatches'])->name('complete-matches');
    Route::get('registrants/interest/{id}', [EventController::class, 'userInterest'])->name('registrants-interest');
    Route::post('/message/{id}', [MessageController::class, 'message'])->name('message');
    Route::post('/matches/{id}', [EventController::class, 'matches'])->name('matches');
    Route::post('/profile-matches/{id}', [EventController::class, 'profileMatches'])->name('profileMatches');
    Route::get('/getUserWithinRang', [EventController::class, 'get_user_within_rang'])->name('getUserWithinRang');

    Route::get('email-tracking/{id}', [EventController::class, 'emailTracking'])->name('email-tracking');
});


Route::post('event/approve', [EventController::class, 'setStatus'])->name('event.approve');

Route::group([
    'prefix'     => 'email',
    'as'         => 'email.',
    // 'namespace'  => 'event',
    // 'middleware' => 'role:'.config('access.users.admin_role'), not role till clarify
], function () {
    Route::post('/by-age-gender', [EmailController::class, 'postByAgeGender'])->name('by-age-gender');
    Route::get('/by-age-gender', [EmailController::class, 'byAgeGender'])->name('by-age-gender');
    Route::get('/subject', [EmailController::class, 'autosubject'])->name('subject');
    Route::get('/own-subject', [EmailController::class, 'ownSubject'])->name('ownSubject');
    Route::post('/post-own-subject', [EmailController::class, 'postOwnSubject'])->name('postOwnSubject');
    Route::get('/individual-mail', [EmailController::class, 'individualMail'])->name('individualMail');
    Route::post('/post-individual-mail', [EmailController::class, 'postIndividualMail'])->name('postIndividualMail');
    Route::get('/getEventUser', [EmailController::class, 'getEventUser'])->name('getEventUser');
});

Route::group([
    'prefix'     => 'message',
    'as'         => 'message.',
    // 'namespace'  => 'event',
    // 'middleware' => 'role:'.config('access.users.admin_role'), not role till clarify
], function () {
    Route::post('/show_template', [MessageController::class, 'savetemplate'])->name('savetemplate');
    Route::get('/save/show-template', [MessageController::class, 'showTemplate'])->name('showtemplate');
    Route::post('/email-templates', [MessageController::class, 'saveEmailTemplate'])->name('saveEmailTemplate');
    Route::get('/save/show-email-template', [MessageController::class, 'showEmailTemplate'])->name('showEmailTemplate');
    Route::get('/email-template-detail/{id}', [MessageController::class, 'emailTemplateDetail'])->name('emailTemplateDetail');
});


// Ajax
Route::delete('event/delete', [EventController::class, 'delete'])->name('event.delete');
Route::post('event/add/registrants', [EventController::class, 'addToRegistrants'])->name('event.add.registrants');
Route::post('event/add/users', [EventController::class, 'addUsers'])->name('event.add.users');
Route::post('event/check/user', [EventController::class, 'checkUser'])->name('event.user_checked');

///Dynamic Pages

Route::get('/dynaimc-pages', [DynamicPagesController::class, 'index'])->name('dynamic_pages');
Route::get('/add-dynaimc-page', [DynamicPagesController::class, 'create'])->name('add_dynamic_page');
Route::post('store-dynaimc-page', [DynamicPagesController::class, 'store'])->name('store_dynamic_page');
Route::get('/edit-dynaimc-page/{id}', [DynamicPagesController::class, 'edit'])->name('edit_dynamic_page');
Route::post('update-dynaimc-page', [DynamicPagesController::class, 'update'])->name('update_dynamic_page');
Route::get('/destroy-dynaimc-page/{id}', [DynamicPagesController::class, 'destroy'])->name('destroy_dynamic_page');


// Route::group(['middleware' => ['web'], 'namespace' => '\WebDevEtc\BlogEtc\Controllers'], function () {

//     /* Admin backend routes - CRUD for posts, categories, and approving/deleting submitted comments */
//     Route::group(['prefix' => config('blogetc.admin_prefix', 'blog_admin')], function () {
//         Route::get('/', 'BlogEtcAdminController@index')
//             ->name('blogetc.admin.index');

//         Route::get(
//             '/add_post',
//             'BlogEtcAdminController@create_post'
//         )
//             ->name('blogetc.admin.create_post');

//         Route::post(
//             '/add_post',
//             'BlogEtcAdminController@store_post'
//         )
//             ->name('blogetc.admin.store_post');

//         Route::get(
//             '/edit_post/{blogPostId}',
//             'BlogEtcAdminController@edit_post'
//         )
//             ->name('blogetc.admin.edit_post');

//         Route::patch(
//             '/edit_post/{blogPostId}',
//             'BlogEtcAdminController@update_post'
//         )
//             ->name('blogetc.admin.update_post');

//         Route::group(['prefix' => 'image_uploads'], function () {
//             Route::get('/', 'BlogEtcImageUploadController@index')->name('blogetc.admin.images.all');

//             Route::get('/upload', 'BlogEtcImageUploadController@create')->name('blogetc.admin.images.upload');
//             Route::post('/upload', 'BlogEtcImageUploadController@store')->name('blogetc.admin.images.store');
//         });

//         Route::delete(
//             '/delete_post/{blogPostId}',
//             'BlogEtcAdminController@destroy_post'
//         )
//             ->name('blogetc.admin.destroy_post');

//         Route::group(['prefix' => 'comments'], function () {
//             Route::get(
//                 '/',
//                 'BlogEtcCommentsAdminController@index'
//             )
//                 ->name('blogetc.admin.comments.index');

//             Route::patch(
//                 '/{commentId}',
//                 'BlogEtcCommentsAdminController@approve'
//             )
//                 ->name('blogetc.admin.comments.approve');
//             Route::delete(
//                 '/{commentId}',
//                 'BlogEtcCommentsAdminController@destroy'
//             )
//                 ->name('blogetc.admin.comments.delete');
//         });

//         Route::group(['prefix' => 'categories'], function () {
//             Route::get(
//                 '/',
//                 'BlogEtcCategoryAdminController@index'
//             )
//                 ->name('blogetc.admin.categories.index');

//             Route::get(
//                 '/add_category',
//                 'BlogEtcCategoryAdminController@create_category'
//             )
//                 ->name('blogetc.admin.categories.create_category');
//             Route::post(
//                 '/add_category',
//                 'BlogEtcCategoryAdminController@store_category'
//             )
//                 ->name('blogetc.admin.categories.store_category');

//             Route::get(
//                 '/edit_category/{categoryId}',
//                 'BlogEtcCategoryAdminController@edit_category'
//             )
//                 ->name('blogetc.admin.categories.edit_category');

//             Route::patch(
//                 '/edit_category/{categoryId}',
//                 'BlogEtcCategoryAdminController@update_category'
//             )
//                 ->name('blogetc.admin.categories.update_category');

//             Route::delete(
//                 '/delete_category/{categoryId}',
//                 'BlogEtcCategoryAdminController@destroy_category'
//             )
//                 ->name('blogetc.admin.categories.destroy_category');
//         });
//     });
// });
