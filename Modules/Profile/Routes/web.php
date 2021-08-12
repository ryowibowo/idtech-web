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

Route::prefix('profile')->group(function() {
    Route::get('/', 'ProfileController@index');
    Route::get('/history', 'ProfileController@history');
    Route::get('/saldo', 'ProfileController@saldo');
    Route::get('/complaintHistory', 'ProfileController@complaintHistory');
    Route::get('/address', 'ProfileController@address');
    Route::post('/updateProfile', 'ProfileController@updateProfile');
    Route::post('/updateAddress', 'ProfileController@updateAddress');
    Route::post('/changePassword', 'ProfileController@changePassword');
    Route::get('/getKota', 'ProfileController@getKota');
    Route::get('/detailOrder/{id}/{invoice_no}', 'ProfileController@detailOrder')->name('profile-detail-order');
    Route::get('/detailComplaint/{id}/{ticketing_num}', 'ProfileController@detailComplaint')->name('profile-detail-complaint');
    Route::post('/addAddress', 'ProfileController@addAddress');
    Route::post('/confirmOrder', 'ProfileController@confirmOrder');
    Route::get('/wishlist', 'ProfileController@wishlist');
    Route::post('/updatePembayaran', 'ProfileController@updatePembayaran');
    Route::get('/invoice/{id}', 'ProfileController@invoice')->name('profile/invoice');
    Route::get('/chat', 'ProfileController@chat')->name('profile/chat');
    Route::post('/complaint', 'ProfileController@complaint');
});
