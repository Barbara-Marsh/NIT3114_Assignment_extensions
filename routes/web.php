<?php

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/about', function () {
    return view('layouts/about');
})->name('about');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'notBanned']], function () {
    // Display layouts/profile.blade when user logs in or completes registration
    Route::get('/', 'User\UserController@index')
        ->name('user.index');

    Route::get('/subscription/new', 'User\SubscriptionController@show')
        ->name('user.show_subscription');

    Route::post('/subscription/save', 'User\SubscriptionController@store')
        ->name('user.create_subscription');

    Route::get("/subscription/edit", 'User\SubscriptionController@edit')
        ->name('user.edit_subscription');

    Route::put("/subscription/update", 'User\SubscriptionController@update')
        ->name('user.update_subscription');

    Route::post('/subscription/cancel', 'User\SubscriptionController@cancel')
        ->name('user.cancel_subscription');

    Route::post('/subscription/resume', 'User\SubscriptionController@resume')
        ->name('user.resume_subscription');

    Route::get('/subscription/edit_card', 'User\SubscriptionController@edit_card')
        -> name('user.edit_card');

    Route::put('/subscription/update_card', 'User\SubscriptionController@update_card')
        ->name('user.update_card');

    Route::get("/newsletter/edit", 'User\UserController@edit_newsletter_settings')
        ->name('user.edit_newsletter');

    Route::put("/newsletter/update", 'User\UserController@update_newsletter_settings')
        ->name('user.update_newsletter');

    Route::get('/newsletter', 'User\UserController@show_newsletter_settings')
        ->name('user.show_newsletter');

    Route::post('/newsletter', 'User\UserController@store_newsletter_settings')
        ->name('user.store_newsletter');

    Route::get('/invoices', 'User\SubscriptionController@listInvoices')
        ->name('user.invoices');

    Route::get('/invoices/download', 'User\SubscriptionController@downloadInvoice')
        ->name('user.download_invoice');
});

Route::group(['prefix' => 'weather', 'middleware' => ['auth', 'notBanned']], function () {
    Route::get('/', 'WeatherController@index')
        ->name('weather.index');

    Route::get('/forecast', 'WeatherController@forecast')
        ->name('weather.forecast');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'Admin\AdminController@index')
        ->name('admin.index');

    Route::get('/view-users', 'Admin\AdminController@viewUsers')
        ->name('admin.view-users');

    Route::put('/ban-user', 'Admin\AdminController@banUser')
        ->name('admin.ban-user');

    Route::get('/invoices', 'Admin\ReportsController@getInvoices')
        ->name('admin.invoices');

    Route::get('/subscriptions', 'Admin\ReportsController@getSubscriptions')
        ->name('admin.subscriptions');

    Route::get('/charges', 'Admin\ReportsController@getCharges')
        ->name('admin.charges');
});
