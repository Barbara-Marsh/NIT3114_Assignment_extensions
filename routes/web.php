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

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
    // Display layouts/profile.blade when user logs in or completes registration
    Route::get('/', 'User\UserController@index')
        ->name('user.index');

    Route::get('/subscription', 'User\SubscriptionController@show')
        ->name('user.show_subscription');

    Route::post('/subscription', 'User\SubscriptionController@store')
        ->name('user.store_subscription');

    Route::get("/subscription/{subscription_id}", 'User\SubscriptionController@edit')
        ->name('user.edit_subscription');

    Route::put("/subscription/{subscription_id}", 'User\SubscriptionController@update')
        ->name('user.update_subscription');

    Route::get("/newsletter/{user_id}", 'User\UserController@edit_newsletter_settings')
        ->name('user.edit_newsletter');

    Route::put("/newsletter/{user_id}", 'User\UserController@update_newsletter_settings')
        ->name('user.update_newsletter');

    Route::get('/newsletter', 'User\UserController@show_newsletter_settings')
        ->name('user.show_newsletter');

    Route::post('/newsletter', 'User\UserController@store_newsletter_settings')
        ->name('user.store_newsletter');

    Route::get("/billing/{user_id}", 'User\UserController@edit_billing')
        ->name('user.edit_billing');

    Route::put("/billing/{user_id}", 'User\UserController@update_billing')
        ->name('user.update_billing');

    Route::get('/billing', 'User\UserController@show_billing')
        ->name('user.show_billing');

    Route::post('/billing', 'User\UserController@store_billing')
        ->name('user.store_billing');

    Route::get('/invoices/unpaid', 'InvoiceController@index_unpaid')
        ->name('user.view_unpaid');

    Route::get('/invoices/all', 'InvoiceController@index_all')
        ->name('user.view_all');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'Admin\AdminController@index')
        ->name('admin.index');

    Route::get('/invoices', 'Admin\AdminController@invoicesList')
        ->name('admin.invoices_list');

    Route::get('/invoices/create', 'Admin\AdminController@createInvoice')
        ->name('admin.create_invoice');

    Route::post('/invoices/create', 'InvoiceController@store')
        ->name('admin.store_invoice');

    Route::get('/unpaid_invoices', 'Admin\AdminController@view_outstanding')
        ->name('admin.view_outstanding');
});
