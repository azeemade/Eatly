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
        $favourite = Favourite::where('user_id', $request->user_id)->first('id');
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
        $favourite = Favourite::where('user_id', $request->user_id)->first('id');
        $shop_id = $request->shop_id;
        $favourite->shops()->attach($shop_id);

        return response()->json([
            'status' => (bool) $favourite,
            'data' => $favourite,
            'message' => '$status' ? 'Shop has been added to favourite!' : 'Shop not added'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function showMeals(Request $request)
    {
        $favourite = Favourite::where('user_id', $request->user_id)->first();
        $meals = $favourite->meals;

        return response()->json([
            'error' => 'false',
            'message' => '$meals' ? 'Meal in Favourite!' : 'Favourite is empty',
            'data' => $meals->transform(function ($meals) {
                return [
                    'id' => $meals->id,
                    'meal_name' => $meals->meal_name,
                    'meal_slug' => $meals->meal_slug,
                    'meal_price' => $meals->meal_sizes->first()->meal_price,
                    'shop_name' => $meals->shop->shop_name,
                    'image' => $meals->images->where('master', 1)->first()->url
                ];
            }),      
        ]);       
    }

    public function showShops(Request $request)
    {
        $favourite = Favourite::where('user_id', $request->user_id)->first();
        $shops = $favourite->shops;

        return response()->json([
            'error' => 'false',
            'message' => '$shops' ? 'Shop in favourite!' : 'Favourite is empty',
            'data' => $shops        
        ]);       
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
            'user_id' => $request->user_id,
            'meal_id' => $request->meal_id,
        ];
        $favourite = Favourite::where('user_id', $credentials['user_id'])->first();
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
            'user_id' => $request->user_id,
            'shop_id' => $request->shop_id,
        ];
        $favourite = Favourite::where('user_id', $credentials['user_id'])->first();
        $shop = $favourite->shops()->detach(['shop_id' => $credentials['shop_id']]);

        return response()->json([
            'status' => (bool) $shop,
            'data' => $shop,
            'message' => '$status' ? 'Shop removed from favourite!' : 'Shop not removed'
        ]);
    }
}
