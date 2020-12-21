<?php

namespace App\Http\Controllers\v1\Bookmark;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookmarkController extends Controller
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
        $bookmark = Bookmark::where('user_id', $request->id)->first('id');
        $meal_id = $request->meal_id;
        $bookmark->meals()->attach($meal_id);

        return response()->json([
            'status' => (bool) $bookmark,
            'data' => $bookmark,
            'message' => '$status' ? 'Meal has been added to bookmark!' : 'Meal not added'
        ]);
    }

    public function storeShop(Request $request)
    {
        $bookmark = Bookmark::where('user_id', $request->id)->first('id');
        $shop_id = $request->shop_id;
        $bookmark->shops()->attach($shop_id);

        return response()->json([
            'status' => (bool) $bookmark,
            'data' => $bookmark,
            'message' => '$status' ? 'Meal has been added to bookmark!' : 'Meal not added'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Bookmark $bookmark)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Bookmark $bookmark)
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
    public function update(Request $request, Bookmark $bookmark)
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
        $bookmark = Bookmark::where('user_id', $credentials['id'])->first('id');
        $meal = $bookmark->meals()->detach(['meal_id' => $credentials['meal_id']]);

        return response()->json([
            'status' => (bool) $meal,
            'data' => $meal,
            'message' => '$status' ? 'Meal removed from bookmark!' : 'Meal not removed'
        ]);
    }

 public function destroyShop(Request $request)
    {
        $credentials = [
            'id' => $request->get('id'),
            'shop_id' => $request->get('shop_id'),
        ];
        $bookmark = Bookmark::where('user_id', $credentials['id'])->first('id');
        $shop = $bookmark->shops()->detach(['shop_id' => $credentials['shop_id']]);

        return response()->json([
            'status' => (bool) $shop,
            'data' => $shop,
            'message' => '$status' ? 'Shop removed from bookmark!' : 'Shop not removed'
        ]);
    }

    public function mealsInBookmark(Request $request)
    {
       $bookmark = DB::select("SELECT meals.id, meals.name, meals.price, meals.image, meals.vendor_id, shops.ShopName
                FROM `bookmarks` INNER JOIN meals INNER JOIN bookmark_meals INNER JOIN shops 
                ON bookmarks.id = bookmark_meals.bookmark_id AND bookmark_meals.meal_id =meals.id 
                AND meals.vendor_id = shops.id
               WHERE bookmarks.user_id =  $request->id");
                return response()->json([
                    'error' => 'false',
                    'message' => '$bookmark' ? 'Meal in bookmark!' : 'Error in Meal bookmark',
                    'data' => [
                        'bookmarkMeal' =>$bookmark
                    ]
                ]);       
    }

    public function shopsInBookmark(Request $request)
    {
       $bookmark = DB::select("SELECT shops.id, shops.ShopName, shops.image
                FROM `bookmarks` INNER JOIN shops INNER JOIN bookmark_shops
                ON bookmarks.id = bookmark_shops.bookmark_id AND bookmark_shops.shop_id = shops.id 
                WHERE bookmarks.user_id =  $request->id");
                return response()->json([
                    'error' => 'false',
                    'message' => '$bookmark' ? 'Shop in bookmark!' : 'Error in shop bookmark',
                    'data' => [
                        'bookmarkShop' =>$bookmark
                    ]
                ]);       
    }
}
