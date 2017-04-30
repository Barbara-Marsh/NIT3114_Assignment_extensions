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

    Route::get('/edit_plan', 'UserController@edit_plan')
        ->name('user.edit_plan')->middleware('auth');

    Route::get('/edit_subscription', 'UserController@edit_subscription')
        ->name('user.edit_subscription')->middleware('auth');

    Route::get('/edit_billing', 'UserController@edit_billing')
        ->name('user.edit_billing')->middleware('auth');

    //Route::put();
});
