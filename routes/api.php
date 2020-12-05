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

Route::get('/meals', 'MealController@index');
Route::get('meals/{meal}', 'MealController@show');
Route::post('meal/{id}', 'MealController@store');
Route::put('meals/{meal}', 'MealController@update');
Route::delete('meals/{meal}', 'MealController@delete');
Route::post('/login', 'UserController@login');
Route::get('/users/{user}', 'UserController@show');
Route::put('/users/{user}', 'UserController@update');

Route::get('/shops', 'ShopController@index');
Route::get('shops/{shop}', 'ShopController@showShops');
Route::get('shop/{shop}', 'ShopController@show');

Route::get('/mealid/{shop}', 'MealController@Shop');
Route::get('store/{meal}', 'MealController@showMeals');
Route::get('mealDetails/{meal}', 'MealController@mealDetails');

Route::get('/orders', 'OrderController@index');
Route::get('/vCloseOrders/{user}', 'OrderController@closedVendorOrder');
Route::get('/vOpenOrders/{user}', 'OrderController@openedVendorOrder');
Route::post('order/{user}', 'OrderController@store');
Route::get('/openOrders/{id}', 'OrderController@openOrders');
Route::get('/closeOrders/{id}', 'OrderController@closeOrders');
Route::put('orders/{order}/delivery', 'OrderController@deliverOrder');
Route::get('/getOrder/{meal}', 'OrderController@getOrder');

Route::get('/cart', 'CartController@mealsInCart');
Route::delete('/cart/{meal}', 'CartController@destroy');
Route::post('/cart/{meal}', 'CartController@store');
Route::put('/cart/{meal}', 'CartController@update');

Route::post('/comment/store', 'CommentController@store');
Route::get('/comments', 'CommentController@mealComment');

Route::post('/rateMeal', 'RatingController@create');
Route::get('/ratings', 'RatingController@mealRating');