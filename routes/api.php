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

Route::group(['prefix' => 'v1'], function ($router) {
    Route::post('/login', 'UserController@login');
    Route::get('/users/{user}', 'UserController@show');
    Route::put('/users/{user}', 'UserController@update');

    Route::group(['prefix' => 'shop'], function ($router) {
    Route::get('/shops', 'v1/Shop/ShopController@index');
    Route::get('shops/{shop}', 'v1/Shop/ShopController@showShops');
    Route::get('shop/{shop}', 'v1/Shop/ShopController@show');
    Route::get('shop/user/{shop}', 'v1/Shop/ShopController@shopOwner');
    });


    Route::group(['prefix' => 'meal'], function ($router) {
        Route::get('/meals', 'v1/Meal/MealController@index');
        Route::get('meals/{meal}', 'v1/Meal/MealController@show');
        Route::post('meal/{id}', 'v1/Meal/MealController@store');
        Route::put('meals/{meal}', 'v1/Meal/MealController@update');
        Route::delete('meals/{meal}', 'v1/Meal/MealController@delete');
        Route::get('/mealid/{shop}', 'v1/Meal/MealController@Shop');
        Route::get('store/{meal}', 'v1/Meal/MealController@showMeals');
        Route::get('mealDetails/{meal}', 'v1/Meal/MealController@mealDetails');
        Route::get('related-meals/{meal}', 'v1/Meal/MealController@moreMeals');
        Route::get('/meal/sales', 'v1/Meal/MealController@mealSales');
        Route::post('upload-file', 'v1/Meal/MealController@uploadFile');
        Route::get('/meal/rating', 'v1/Meal/MealController@mealRating');
        Route::get('/top/meals', 'v1/Meal/MealController@homepageMeals');
    });

    Route::group(['prefix' => 'cart'], function ($router) {
        Route::get('/orders', 'v1/Order/OrderController@index');
        Route::get('/vCloseOrders/{user}', 'v1/Order/OrderController@closedVendorOrder');
        Route::get('/vOpenOrders/{user}', 'v1/Order/OrderController@openedVendorOrder');
        Route::post('order/{user}', 'v1/Order/OrderController@store');
        Route::get('/openOrders/{id}', 'v1/Order/OrderController@openOrders');
        Route::get('/closeOrders/{id}', 'v1/Order/OrderController@closeOrders');
        Route::put('orders/{order}/delivery', 'v1/Order/OrderController@deliverOrder');
        Route::get('/shop/{id}/sells', 'v1/Order/OrderController@shopSells');
    });

    Route::group(['prefix' => 'cart'], function ($router) {
        Route::get('/cart', 'v1/Cart/CartController@mealsInCart');
        Route::delete('/cart/{meal}', 'v1/Cart/CartController@destroy');
        Route::post('/cart/{meal}', 'v1/Cart/CartController@store');
        Route::put('/cart/{meal}', 'v1/Cart/CartController@update');
    });

    Route::group(['prefix' => 'comment'], function ($router) {
        Route::post('/comment/store', 'v1/Comment/CommentController@store');
        Route::get('/comments', 'v1/Comment/CommentController@mealComment');
    });

    Route::group(['prefix' => 'rating'], function ($router) {
        Route::post('/rateMeal', 'v1/Rating/RatingController@create');
        Route::get('/ratings', 'v1/Rating/RatingController@mealRating');
    });

    Route::group(['prefix' => 'favourite'], function ($router) {
        Route::get('/favourite/meals', 'v1/Favourite/FavouriteController@mealsInFavourite');
        Route::get('/favourite/shops', 'v1/Favourite/FavouriteController@shopsInFavourite');
        Route::delete('/favourite/shop/{shop}', 'v1/Favourite/FavouriteController@destroyShop');
        Route::delete('/favourite/meal/{meal}', 'v1/Favourite/FavouriteController@destroyMeal');
        Route::post('/favourite/meal/{meal}', 'v1/Favourite/FavouriteController@storeMeal');
        Route::post('/favourite/shop/{shop}', 'v1/Favourite/FavouriteController@storeShop');
    });
});

Route::fallback(function () {
    return response()->json([
        'error' => true,
        'message' => 'Route don\'t exist',
        'data' => null
    ], 404);
});