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
Route::post('meal', 'MealController@store');
Route::put('meals/{meal}', 'MealController@update');
Route::delete('meals/{meal}', 'MealController@delete');
Route::post('/login', 'UserController@login');
Route::get('/users/{user}', 'UserController@show');
Route::get('/myOrders/{order}', 'OrderController@showOrders');

Route::get('shops/{shop}', 'ShopController@showShops');
Route::get('shop/{shop}', 'ShopController@show');

Route::get('/mealid/{shop}', 'MealController@Shop');

Route::get('store/{meal}', 'MealController@showMeals');

Route::get('mealDetails/{meal}', 'MealController@mealDetails');
Route::get('/orders', 'OrderController@index');

Route::get('/ordersTable/{user}', 'OrderController@orderTable');

Route::get('/getOrder/{meal}', 'OrderController@getOrder');
Route::get('/recipes', 'RecipeController@index');



