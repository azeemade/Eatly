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
    Route::group(['prefix' => 'auth'], function ($router) {
        Route::post('/login', 'v1\User\UserController@login');
        Route::post('/register', 'v1\User\UserController@consumerRegister');
    });

    Route::group(['prefix' => 'user'], function ($router) {
        Route::get('/show', 'v1\User\UserController@show');
        Route::post('/create', 'v1\User\UserController@store');
        Route::put('/update', 'v1\User\UserController@update');
        Route::get('/', 'v1\User\UserController@index');
    });
    

    Route::group(['prefix' => 'shop'], function ($router) {
        Route::get('/exist', 'v1\Shop\ShopController@checkExistence');
        Route::get('/vendor', 'v1\Shop\ShopController@show');
        Route::post('/store', 'v1\Shop\ShopController@store');
        Route::get('/shops', 'v1\Shop\ShopController@index');
        Route::get('/shop-name', 'v1\Shop\ShopController@shopName');
        Route::get('/shop-props', 'v1\Shop\ShopController@shopProps');
        Route::get('/best-seller', 'v1\Shop\ShopController@bestSeller');
       // Route::get('/id', 'v1\Shop\ShopController@getShopId');
        

        
        //Route::get('/details', 'v1\Shop\ShopController@shopDetails');

        
        Route::get('shops/{shop}', 'v1\Shop\ShopController@showShops');
        Route::get('shop/{shop}', 'v1\Shop\ShopController@show');
        Route::get('shop/user/{shop}', 'v1\Shop\ShopController@shopOwner');
    });


    Route::group(['prefix' => 'meal'], function ($router) {
        Route::get('/listing/{slug}', 'v1\Meal\MealController@show');
        Route::get('/vendor/active', 'v1\Meal\MealController@vendorActiveMeals');
        Route::get('/related-meals', 'v1\Meal\MealController@relatedMeals');
        Route::get('/active', 'v1\Meal\MealController@activeMeals');
        Route::get('/awaiting', 'v1\Meal\MealController@awaitingMeals');
        Route::get('/cancelled', 'v1\Meal\MealController@cancelledMeals');
        Route::get('/edit', 'v1\Meal\MealController@editingMeal');
        Route::post('/meal-details', 'v1\Meal\MealController@updateOrCreateMeal');
        Route::post('/mealsize', 'v1\Meal\MealController@updateOrCreateMealSize');
        Route::post('/primary-image', 'v1\Meal\MealController@updateCreatePrimaryMealImage');
        Route::post('/secondary-image', 'v1\Meal\MealController@updateCreateSecondayMealImages');
        Route::delete('delete', 'v1\Meal\MealController@delete');
        Route::delete('delete/secondary-image', 'v1\Meal\MealController@deleteSecondaryImage');
        Route::get('/meals', 'v1\Meal\MealController@index');
        Route::get('/vendor', 'v1\Meal\MealController@vendorMeals');
        Route::group(['prefix' => 'recommended'], function ($router) {
            Route::get('/fav/meal', 'v1\Meal\MealController@basedOnFav');
            Route::get('/fav/vendor/meal', 'v1\Meal\MealController@favVendorMeals');
            Route::get('/order/meals', 'v1\Meal\MealController@orderMeals');
            Route::get('/order/budget/meals', 'v1\Meal\MealController@orderBudget');
        });


        
        
        Route::post('meal/{id}', 'v1\Meal\MealController@store');
        Route::put('meals/{meal}', 'v1\Meal\MealController@update');
        Route::delete('meals/{meal}', 'v1\Meal\MealController@delete');
        Route::get('/mealid/{shop}', 'v1\Meal\MealController@Shop');
        Route::get('store/{meal}', 'v1\Meal\MealController@showMeals');
        Route::get('mealDetails/{meal}', 'v1\Meal\MealController@mealDetails');
        Route::get('related-meals/{meal}', 'v1\Meal\MealController@moreMeals');
        Route::get('/meal/sales', 'v1\Meal\MealController@mealSales');
        Route::post('upload-file', 'v1\Meal\MealController@uploadFile');
        Route::get('/meal/rating', 'v1\Meal\MealController@mealRating');
        Route::get('/top/meals', 'v1\Meal\MealController@homepageMeals');
    });

    Route::group(['prefix' => 'order'], function ($router) {
        /**homepage meals */
        Route::get('/top-meals', 'v1\Order\OrderController@topMeals');

        Route::group(['prefix' => 'user'], function ($router) {
            Route::get('/open', 'v1\Order\OrderController@openUserOrders');
            Route::get('/closed', 'v1\Order\OrderController@closedUserOrders');
            Route::delete('/clear', 'v1\Order\OrderController@clearClosed');
            Route::delete('/cancel-order', 'v1\Order\OrderController@cancelOrder');           
        });
        Route::get('/featured-meals', 'v1\Order\OrderController@featuredMeals');
        Route::post('checkout', 'v1\Order\OrderController@store');
        Route::get('/count', 'v1\Order\OrderController@orderCount');
        Route::get('/closed', 'v1\Order\OrderController@closedVendorOrder');
        Route::get('/open', 'v1\Order\OrderController@openedVendorOrder');
        Route::put('deliver', 'v1\Order\OrderController@deliverOrder');
        Route::put('start-delivery', 'v1\Order\OrderController@startDelivery');


        Route::get('/orders', 'v1\Order\OrderController@index');
        Route::get('/shop/{id}/sells', 'v1\Order\OrderController@shopSells');
    });

    Route::group(['prefix' => 'cart'], function ($router) {
        Route::get('/', 'v1\Cart\CartController@show');
        Route::put('/update', 'v1\Cart\CartController@update');
        Route::delete('/delete', 'v1\Cart\CartController@destroy');
        Route::post('/store', 'v1\Cart\CartController@store');

        
    });

    Route::group(['prefix' => 'comment'], function ($router) {
        Route::get('/', 'v1\Comment\CommentController@show');
        Route::post('/store', 'v1\Comment\CommentController@store');
        Route::get('/count', 'v1\Comment\CommentController@shopReviewsCount');
        
    });

    Route::group(['prefix' => 'rating'], function ($router) {
        Route::post('/store', 'v1\Rating\RatingController@create');
        Route::get('/shop', 'v1\Rating\RatingController@shopRating');
    });

    Route::group(['prefix' => 'favourite'], function ($router) {
        Route::get('/meals', 'v1\Favourite\FavouriteController@showMeals');
        Route::get('/shops', 'v1\Favourite\FavouriteController@showShops');
        Route::delete('/delete/shop', 'v1\Favourite\FavouriteController@destroyShop');
        Route::delete('/delete/meal', 'v1\Favourite\FavouriteController@destroyMeal');
        Route::post('/meal', 'v1\Favourite\FavouriteController@storeMeal');
        Route::post('/shop', 'v1\Favourite\FavouriteController@storeShop');
    });

    Route::group(['prefix' => 'category'], function ($router) {
        Route::get('/', 'v1\Category\CategoryController@index');
        Route::get('/{title}/show', 'v1\Category\CategoryController@show');
        Route::post('/attach-meal', 'v1\Category\CategoryController@attachMeal');
        Route::delete('/detach-meal', 'v1\Category\CategoryController@detachMeal');
        Route::get('/top-category', 'v1\Category\CategoryController@topCategory');
       // Route::get('/meals/sort', 'v1\Category\CategoryController@sortBy');
        
    });

    Route::group(['prefix' => 'search'], function ($router) {
        Route::get('/recent', 'v1\Search\SearchController@recent');
        Route::get('/popular', 'v1\Search\SearchController@popular');
        Route::post('/create', 'v1\Search\SearchController@store');
        Route::delete('/clear', 'v1\Search\SearchController@clear');
        
    });
});

Route::fallback(function () {
    return response()->json([
        'error' => true,
        'message' => 'Route don\'t exist',
        'data' => null
    ], 404);
});