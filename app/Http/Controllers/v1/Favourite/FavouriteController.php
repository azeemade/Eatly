<?php

namespace App\Http\Controllers\v1\Favourite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favourite;
use Illuminate\Support\Facades\DB;

class FavouriteController extends Controller
{
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMeal(Request $request)
    {
        $favourite = Favourite::where('user_id', $request->id)->first('id');
        $meal_id = $request->meal_id;
        $favourite->meals()->attach($meal_id);

        return response()->json([
            'status' => (bool) $favourite,
            'data' => $favourite,
            'message' => '$status' ? 'Meal has been added to favourite!' : 'Meal not added'
        ]);
    }

    public function storeShop(Request $request)
    {
        $favourite = Favourite::where('user_id', $request->id)->first('id');
        $shop_id = $request->shop_id;
        $favourite->shops()->attach($shop_id);

        return response()->json([
            'status' => (bool) $favourite,
            'data' => $favourite,
            'message' => '$status' ? 'Meal has been added to favourite!' : 'Meal not added'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(favourite $favourite)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(favourite $favourite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, favourite $favourite)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroyMeal(Request $request)
    {
        $credentials = [
            'id' => $request->get('id'),
            'meal_id' => $request->get('meal_id'),
        ];
        $favourite = Favourite::where('user_id', $credentials['id'])->first('id');
        $meal = $favourite->meals()->detach(['meal_id' => $credentials['meal_id']]);

        return response()->json([
            'status' => (bool) $meal,
            'data' => $meal,
            'message' => '$status' ? 'Meal removed from favourite!' : 'Meal not removed'
        ]);
    }

 public function destroyShop(Request $request)
    {
        $credentials = [
            'id' => $request->get('id'),
            'shop_id' => $request->get('shop_id'),
        ];
        $favourite = Favourite::where('user_id', $credentials['id'])->first('id');
        $shop = $favourite->shops()->detach(['shop_id' => $credentials['shop_id']]);

        return response()->json([
            'status' => (bool) $shop,
            'data' => $shop,
            'message' => '$status' ? 'Shop removed from favourite!' : 'Shop not removed'
        ]);
    }
                    /**mealsInBookmark */
    public function mealsInfavourite(Request $request)
    {
       $favourite = DB::select("SELECT meals.id, meals.name, meals.price, meals.image, meals.vendor_id, shops.ShopName
                FROM `favourites` INNER JOIN meals INNER JOIN favourite_meals INNER JOIN shops 
                ON favourites.id = favourite_meals.favourite_id AND favourite_meals.meal_id =meals.id 
                AND meals.vendor_id = shops.id
               WHERE favourites.user_id =  $request->id");
                return response()->json([
                    'error' => 'false',
                    'message' => '$favourite' ? 'Meal in favourite!' : 'Error in Meal favourite',
                    'data' => [
                        'favouriteMeal' =>$favourite
                    ]
                ]);       
    }

                /**shopsInBookmark */
    public function shopsInFavourite(Request $request)
    {
       $favourite = DB::select("SELECT shops.id, shops.ShopName, shops.image
                FROM `favourites` INNER JOIN shops INNER JOIN favourite_shops
                ON favourites.id = favourite_shops.favourite_id AND favourite_shops.shop_id = shops.id 
                WHERE favourites.user_id =  $request->id");
                return response()->json([
                    'error' => 'false',
                    'message' => '$favourite' ? 'Shop in favourite!' : 'Error in shop favourite',
                    'data' => [
                        'favouriteShop' =>$favourite
                    ]
                ]);       
    }
}
