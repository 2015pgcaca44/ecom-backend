<?php

use Illuminate\Http\Request;
use app\Http\Controllers;

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


Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::get('users', 'UserController@users');
Route::get('deleteUser', 'UserController@delete');

Route::get('products', 'ProductController@products');
Route::get('getProducts/{id}', 'ProductController@getProducts');
Route::post('createProducts', 'ProductController@createProducts');
Route::post('deleteProduct', 'ProductController@delete');
Route::post('updateProduct', 'ProductController@update');
