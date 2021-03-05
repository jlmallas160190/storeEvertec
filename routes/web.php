<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', 'Web\HomeController@index')->name('home');
Route::get('home', 'Web\HomeController@index');

Route::group(['prefix' => 'customers', 'as' => 'customers:'], function () {
    Route::get('index', 'Web\CustomerController@index')->name('index');

});

Route::group(['prefix' => 'orders', 'as' => 'orders:'], function () {
    Route::get('index', 'Web\OrderController@index')->name('index');
    Route::get('pay/{id}', 'Web\OrderController@pay')->name('pay');
    Route::get('completed/{reference}', 'Web\OrderController@completed')->name('completed');
    Route::get('cancel/{id}', 'Web\OrderController@cancel')->name('cancel');
    Route::post('complete-pay/{id}', 'Web\OrderController@completePay')->name('completePay');

});
Auth::routes();
