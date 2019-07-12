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


Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::prefix('admin')->group(function () {
    Route::prefix('category')->group(function () {
        Route::get('index', 'CategoryController@index')->name('admin.category.index');
        Route::get('create', 'CategoryController@create')->name('admin.category.create');
        Route::post('create', 'CategoryController@store')->name('admin.category.store');
        Route::get('{id}/edit', 'CategoryController@edit')->name('admin.category.edit');
        Route::post('{id}/edit', 'CategoryController@update')->name('admin.category.update');
        Route::get('{id}/delete', 'CategoryController@destroy')->name('admin.category.destroy');
        Route::post('search', 'CategoryController@search')->name('admin.category.search');
    });
    Route::prefix('product')->group(function () {
        Route::get('index', 'ProductController@index')->name('admin.product.index');
        Route::get('create', 'ProductController@create')->name('admin.product.create');
        Route::post('create', 'ProductController@store')->name('admin.product.store');
        Route::get('{id}/edit', 'ProductController@edit')->name('admin.product.edit');
        Route::post('{id}/edit', 'ProductController@update')->name('admin.product.update');
        Route::get('{id}/delete', 'ProductController@destroy')->name('admin.product.destroy');
        Route::post('search', 'ProductController@search')->name('admin.product.search');
    });
    Route::prefix('user')->group(function () {
        Route::get('index', 'UserController@index')->name('admin.user.index');
        Route::get('create', 'UserController@create')->name('admin.user.create');
        Route::post('create', 'UserController@store')->name('admin.user.store');
        Route::get('{id}/edit', 'UserController@edit')->name('admin.user.edit');
        Route::post('{id}/edit', 'UserController@update')->name('admin.user.update');
        Route::get('{id}/delete', 'UserController@destroy')->name('admin.user.destroy');
        Route::post('search', 'UserController@search')->name('admin.user.search');
    });
});

Route::get('/', 'PageController@index')->name('page.index');
Route::get('/product-type/{type}', 'PageController@getProductType')->name('page.getProductType');
Route::get('/product-detail/{id}', 'PageController@getProductDetail')->name('page.getProductDetail');
Route::get('/contact', 'PageController@getContact')->name('page.getContact');
Route::get('/about', 'PageController@getAbout')->name('page.getAbout');
Route::get('/shopping-cart', 'PageController@getShoppingCart')->name('page.getShoppingCart');
Route::get('/ad-cart/{id}', 'ShoppingCartController@addToCart')->name('shopping-cart.getAdCart');
Route::get('/delete-cart/{id}', 'ShoppingCartController@removeProductIntoCart')->name('shopping-cart.removeProductIntoCart');
Route::post('/update-cart/{id}', 'ShoppingCartController@updateProductIntoCart')->name('shopping-cart.updateProductIntoCart');
Route::get('/check-out', 'PageController@getCheckOut')->name('page.checkOut');
Route::post('/check-out', 'PageController@postCheckOut')->name('page.postCheckOut');
Route::get('/search', 'PageController@search')->name('page.search');
