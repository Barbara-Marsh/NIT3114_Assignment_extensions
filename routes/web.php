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
    Route::get('/', 'UserController@index')
        ->name('user.index')->middleware('auth');

    Route::get('/subscription', 'SubscriptionController@edit')
        ->name('user.edit_subscription')->middleware('auth');

    Route::put('/subscription', 'SubscriptionController@update')
        ->name('user.update_subscription')->middleware('auth');

    Route::get('/newsletter', 'UserController@edit_newsletter')
        ->name('user.edit_newsletter')->middleware('auth');

    Route::put('/newsletter', 'UserController@update_newsletter')
        ->name('user.update_newsletter')->middleware('auth');

    Route::get('/billing', 'UserController@edit_billing')
        ->name('user.edit_billing')->middleware('auth');

    Route::put('/billing', 'UserController@update_billing')
        ->name('user.update_billing')->middleware('auth');
});

Route::group(['prefix' => 'admin'], function () {

});
