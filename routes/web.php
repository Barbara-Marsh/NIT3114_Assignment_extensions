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

Route::group(['prefix' => 'user'], function () {
    // Display layouts/profile.blade when user logs in or completes registration
    Route::get('/', 'User\UserController@index')
        ->name('user.index')->middleware('auth');

    // Routes relating to Subscription class
    Route::get('/subscription', 'User\SubscriptionController@show')
        ->name('user.show_subscription');

    Route::post('/subscription', 'User\SubscriptionController@store')
        ->name('user.store_subscription')->middleware('auth');

    Route::get("/subscription/{subscription_id}", 'User\SubscriptionController@edit')
        ->name('user.edit_subscription')->middleware('auth');

    Route::put("/subscription/{subscription_id}", 'User\SubscriptionController@update')
        ->name('user.update_subscription')->middleware('auth');

    // Routes relating to UserSettings class
    Route::get("/newsletter/{user_settings_id}", 'User\UserSettingsController@edit')
        ->name('user.edit_newsletter')->middleware('auth');

    Route::put("/newsletter/{user_settings_id}", 'User\UserSettingsController@update')
        ->name('user.update_newsletter')->middleware('auth');

    Route::get('/newsletter', 'User\UserSettingsController@show')
        ->name('user.show_newsletter')->middleware('auth');

    Route::post('/newsletter', 'User\UserSettingsController@store')
        ->name('user.store_newsletter')->middleware('auth');

    // Routes relating to BillingDetails class
    Route::get("/billing/{billing_details_id}", 'User\BillingDetailsController@edit')
        ->name('user.edit_billing')->middleware('auth');

    Route::put("/billing/{billing_details_id}", 'User\BillingDetailsController@update')
        ->name('user.update_billing')->middleware('auth');

    Route::get('/billing', 'User\BillingDetailsController@show')
        ->name('user.show_billing')->middleware('auth');

    Route::post('/billing', 'User\BillingDetailsController@store')
        ->name('user.store_billing')->middleware('auth');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'Admin\AdminController@index')
        ->name('admin.index')->middleware('auth');
});
