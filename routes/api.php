<?php

use Illuminate\Http\Request;

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

Route::post('signup', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::get('category', 'CategoryApiController@index');


Route::middleware('jwt.refresh')->get('/token/refresh', 'AuthController@refresh');
Route::group(['middleware' => 'jwt.verify'], function () {
    Route::get('user', 'AuthController@user');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('category/{id}', 'CategoryApiController@show');
    Route::post('category', 'CategoryApiController@store');
    Route::put('category', 'CategoryApiController@store');
    Route::delete('category/{id}', 'CategoryApiController@destroy');
    Route::post('category/search', 'CategoryApiController@search');
});
