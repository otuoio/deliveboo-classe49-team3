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
Route::get('v1/categories', 'Api\CategoryController@index')->middleware('api.auth');
Route::get('v1/search', 'Api\UserController@search')->middleware('api.auth');
Route::get('v1/searchName', 'Api\UserController@searchName')->middleware('api.auth');
Route::get('v1/{id}', 'Api\UserController@show')->middleware('api.auth');

