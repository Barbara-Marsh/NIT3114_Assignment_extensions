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
    Route::get('/', 'User\UserController@index')
        ->name('user.index')->middleware('auth');

    Route::get("/subscription/{subscription_id}", 'User\SubscriptionController@edit')
        ->name('user.edit_subscription')->middleware('auth');

    Route::put("/subscription/{subscription_id}", 'User\SubscriptionController@update')
        ->name('user.update_subscription')->middleware('auth');

    Route::get("/newsletter/{user_settings_id}", 'User\UserSettingsController@edit')
        ->name('user.edit_newsletter')->middleware('auth');

    Route::put("/newsletter/{user_settings_id}", 'User\UserSettingsController@update')
        ->name('user.update_newsletter')->middleware('auth');

    Route::get("/billing/{billing_details_id}", 'User\BillingDetailsController@edit')
        ->name('user.edit_billing')->middleware('auth');

    Route::put("/billing/{billing_details_id}", 'User\BillingDetailsController@update')
        ->name('user.update_billing')->middleware('auth');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'Admin\AdminController@index')
        ->name('admin.index')->middleware('auth');
});
