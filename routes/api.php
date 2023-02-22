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

//Route::post('admin/register', 'App\Http\Controllers\API\RegisterController@register');
Route::post('register/create_user', 'App\Http\Controllers\API\RegisterController@register');
Route::post('admin/{admin}/logout', 'App\Http\Controllers\API\RegisterController@logout');
Route::post('users/{user}/activate', 'App\Http\Controllers\API\RegisterController@activateUsers');
Route::post('users/{user}/deactivate', 'App\Http\Controllers\API\RegisterController@deactivateUsers');






   
Route::middleware('auth:api')->group( function () {
    // Route::resource('product', 'API\ProductController');
});


Route::apiResource('product','App\Http\Controllers\ProductController');

Route::prefix('product')->group(function(){
    Route::apiResource('/{product}/reviews','App\Http\Controllers\ReviewsController');
});


//product category and sub category
Route::post('store/c', 'App\Http\Controllers\ProductCategoriesController@new_product_category');
Route::post('store/sc', 'App\Http\Controllers\ProductCategoriesController@new_product_sub_category');
Route::get('store/c/', 'App\Http\Controllers\ProductCategoriesController@category');
Route::get('store/c/{id}', 'App\Http\Controllers\ProductCategoriesController@Single_category');
