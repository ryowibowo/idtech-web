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

Route::prefix('beranda')->group(function() {
    Route::get('/', 'BerandaController@index');
    Route::post('/register', 'BerandaController@register');
    Route::post('/verifyUsername', 'BerandaController@verifyUsername');
    Route::post('/login', 'BerandaController@login');
    Route::post('/verifyOtp', 'BerandaController@verifyOtp');
    Route::post('/sendOTPReset', 'BerandaController@sendOTPReset');
    Route::post('/verifyForget', 'BerandaController@verifyForget');
    Route::post('/changeForgotPassword', 'BerandaController@changeForgotPassword');


    Route::get('/detailPromo/{id}', 'BerandaController@detailPromoById');
    Route::post('/addToCart', 'BerandaController@addToCart');
    Route::post('/addUpdateCart', 'BerandaController@addUpdateCart');
    Route::post('/deleteCart', 'BerandaController@deleteCart');
    
    //shipping
    Route::get('/shipping', 'ShippingController@index');
    //checkout
    Route::get('/checkout', 'CheckoutController@index');
});
