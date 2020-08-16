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

Route::group(['prefix' => 'auth'], function () {
    Route::post('register', 'Api\AuthController@register');
    Route::post('login', 'Api\AuthController@login');
    Route::get('refresh', 'Api\AuthController@refresh');
    Route::middleware('auth:api')->group(function () {
        Route::get('user', 'Api\AuthController@user');
        Route::post('logout', 'Api\AuthController@logout');
    });
});



    Route::group(['prefix' => '/product', 'as' => 'product.'], function () {
        Route::get('products', 'Api\ProductController@getProducts');
        Route::get('{id}', 'Api\ProductController@getProduct');
        Route::put('{product}/update', 'Api\ProductController@update');
        Route::post('store', 'Api\ProductController@store');
        Route::delete('{product}/delete', 'Api\ProductController@delete');
    });


//Route::middleware('auth:api')->group(function () {
    Route::group(['prefix' => '/category', 'as' => 'category.'], function () {
        Route::get('categories', 'Api\CategoryController@getCategories');
        Route::get('all', 'Api\CategoryController@allCategories');
        Route::put('{category}/update', 'Api\CategoryController@update');
        Route::post('store', 'Api\CategoryController@store');
        Route::delete('{category}/delete', 'Api\CategoryController@delete');
    });
//});
