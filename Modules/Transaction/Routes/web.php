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

Route::prefix('transaction')->group(function() {
    Route::get('/', 'TransactionController@index');
    Route::get('/shipping', 'TransactionController@shipping');
    Route::post('/checkout', 'TransactionController@checkout');
    Route::post('/order', 'TransactionController@order');
    Route::get('/payment', function () {
        return view('transaction::payment', []);
    });
});
