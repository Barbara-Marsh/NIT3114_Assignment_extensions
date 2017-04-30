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

Route::get('/contact', function () {
    return view('layouts.contact');
})->name('contact');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['prefix' => 'user'], function () {
    Route::get('/', 'UserController@index')
        ->name('user.index')->middleware('auth');

    Route::get('/edit_plan', function () {
        return view('layouts.user.edit_plan_form');
    })->name('user.edit_plan')->middleware('auth');

    Route::get('/edit_subscription', function () {
        return view('layouts.user.edit_subscription_form');
    })->name('user.edit_subscription')->middleware('auth');

    Route::get('/edit_billing', function () {
        return view('layouts.user.edit_billing_form');
    })->name('user.edit_billing')->middleware('auth');

    //Route::put();
});
