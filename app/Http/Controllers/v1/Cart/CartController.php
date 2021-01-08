<?php

namespace App\Http\Controllers\v1\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Cart_meal;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function store(Request $request)
    {
        $cart = Cart::where('user_id', $request->id)->first();
        $meal_id = $request->meal_id;
        $quantity = $request->quantity;
        $meal_size_id = $request->meal_size_id;
        $cart->meals()->attach($meal_id, ['quantity' => $quantity],['meal_size_id' => $meal_size_id]);

        return response()->json([
            'status' => (bool) $cart,
           // 'data' => $cart,
            'message' => '$status' ? 'Meal has been added to cart!' : 'Meal not added'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $cart = Cart::where('user_id', $request->user_id)->first();
        $meal_size =$cart->meal_size;
        

        return response()->json([
            'error' => 'false',
            'message' => '$meals' ? 'Meal in cart!' : 'Cart is empty',  
            'data' =>  $meal_size->transform(function ($meal_size) {
                    return[
                    'id' => $meal_size->id,
                    'meal_name' => $meal_size->meal->meal_name,
                    'meal_price' => $meal_size->meal_price,
                    'meal_size' => $meal_size->meal_size,
                    'shop_name' =>$meal_size->meal->shop->shop_name,
                    'image' => $meal_size->meal->images->where('master', 1)->first()->url,
                    'quantity' => $meal_size->pivot->quantity,
                 ];
                }),    
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
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
    public function update(Request $request)
    {
        $cart = Cart::where('user_id', $request->user_id)->first();
        $status = $cart->meals()->updateExistingPivot($request->meal_id, ['quantity' => $request->quantity],['meal_size_id' => $request->meal_size_id]);
        return response()->json([
            'status' => $status, 
            'message' => $status ? 'Meal updated!' : 'Error updating meal'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $credentials = [
            'user_id' => $request->user_id,
            'meal_id' => $request->meal_id,
            'quantity' => $request->quantity,
            'meal_size_id' => $request->meal_size_id,
        ];
        $cart = Cart::where('user_id', $credentials['user_id'])->first();
        $cart->meals()->detach($credentials['meal_id'], ['quantity' => $credentials['quantity'],'meal_size_id' => $credentials['meal_size_id']]);

        return response()->json([
            'status' => (bool) $cart,
            'data' => $cart,
            'message' => '$status' ? 'Meal removed from cart!' : 'Meal not removed'
        ]);
    }
}
