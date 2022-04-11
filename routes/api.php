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

Route::get('v1/', 'Api\UserController@index')->middleware('api.auth');
Route::get('v1/popular', 'Api\UserController@popular')->middleware('api.auth');
Route::get('v1/{slug}/dishes', 'Api\DishController@index')->middleware('api.auth');
Route::get('v1/categories', 'Api\CategoryController@index')->middleware('api.auth');
Route::get('v1/search', 'Api\UserController@search')->middleware('api.auth');
Route::get('v1/{slug}', 'Api\UserController@show')->middleware('api.auth');
Route::post('v1/orders/checkout/validation', 'Api\OrderController@sendValidation');
Route::post('v1/orders/checkout', 'Api\OrderController@sendOrder');



