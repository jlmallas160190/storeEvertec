<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'auth', 'as' => 'auth::'], function () {
    Route::post('login', 'Api\AuthController@login')->name('login');
});
Route::group(['as' => 'api::'], function () {
    Route::group(['prefix' => 'customers', 'as' => 'customers::'], function () {
        Route::get('', 'Api\CustomerController@findAll')->name('findAll');
        Route::get('{id}', 'Api\CustomerController@findById')->name('findById');
        Route::post('', 'Api\CustomerController@create')->name('create');
        Route::put('', 'Api\CustomerController@update')->name('update');
    });
    Route::group(['prefix' => 'users', 'as' => 'users::'], function () {
        Route::get('', 'Api\UserController@findAll')->name('findAll');
        Route::get('{id}', 'Api\UserController@findById')->name('findById');
        Route::post('', 'Api\UserController@create')->name('create');
        Route::put('', 'Api\UserController@update')->name('update');
    });
    Route::group(['prefix' => 'orders', 'as' => 'orders::'], function () {
        Route::get('', 'Api\OrderController@findAll')->name('findAll');
        Route::get('{id}', 'Api\OrderController@findById')->name('findById');
        Route::post('', 'Api\OrderController@create')->name('create');
        Route::put('{id}/pay', 'Api\OrderController@pay')->name('pay');
    });
});
