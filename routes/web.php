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
});

Route::post('/order/store', 'OrderController@store');
Route::get('/order/index/{brand_id}','OrderController@index');
Route::get('/order/show/{order}','OrderController@show');
Route::get('/order/operator/{order}','OrderController@operator')->name('order.operator');