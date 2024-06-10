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
Route::post('users', 'App\Http\Controllers\UserController@createUser')->name('users.api');







   
Route::middleware('auth:api')->group( function () {
    
});





