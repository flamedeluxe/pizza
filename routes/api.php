<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\ProductController;
use App\Http\Controllers\Api\v1\OrderController;
use App\Http\Controllers\Api\v1\AuthController;

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

Route::resource('products', ProductController::class);
Route::post('order', 'App\Http\Controllers\Api\v1\OrderController@index');
Route::post('register', 'App\Http\Controllers\Api\v1\AuthController@register');
Route::post('login', 'App\Http\Controllers\Api\v1\AuthController@login')->name('login');
Route::post('init', 'App\Http\Controllers\Api\v1\AuthController@init');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/user', 'App\Http\Controllers\Api\v1\AuthController@init');
    Route::get('/logout', 'App\Http\Controllers\Api\v1\AuthController@logout');
    Route::get('/my-orders', 'App\Http\Controllers\Api\v1\OrderController@list');
});
