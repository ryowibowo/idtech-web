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

Route::prefix('product')->group(function() {
    Route::get('/', 'ProductController@index');
    Route::get('/{id}', 'ProductController@getProductById');
    Route::get('/searchByTag/{id}', 'ProductController@searchByCategory')->name('searchByTag');
    Route::post('/searching', 'ProductController@productSearch')->name('searching');
    Route::post('/dataProductSearch', 'ProductController@dataProductSearch');
    Route::post('/searchBySortTag', 'ProductController@dataProductSearchSortTag');
});
