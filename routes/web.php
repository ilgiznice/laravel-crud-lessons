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

Auth::routes();

Route::get('/', 'PageController@index')->name('index');
Route::get('/contacts', 'PageController@contacts')->name('contacts');
Route::get('/product/{product}', 'PageController@showProduct')->name('show.product');
Route::get('/orders', 'PageController@showOrders')
    ->name('orders');

Route::group(['prefix' => '/admin'], function() {
    Route::get('/', 'Admin\AdminController@index')->name('admin');
    Route::resource('product', 'ProductController');
    Route::get('/order/statuses', 'OrderController@getStatuses');
    Route::resource('order', 'OrderController');
    Route::post('/order/{order}/proceed', 'OrderController@proceed');
    Route::get('/product/export/csv', 'Admin\AdminController@exportToCsv')->name('product.export.csv');

    Route::get('/product/import/csv/form', 'Admin\AdminController@importForm')->name('product.import.csv.form');
    Route::post('/product/import/csv', 'Admin\AdminController@importFromCsv')->name('product.import.csv');
});

//  /product/ID
//  /product

//  /product/1/


