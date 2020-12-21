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
        $cart = Cart::where('user_id', $request->id)->first('id');
        $meal_id = $request->meal_id;
        $quantity = $request->quantity;
        $cart->meals()->attach($meal_id, ['quantity' => $quantity]);

        return response()->json([
            'status' => (bool) $cart,
            'data' => $cart,
            'message' => '$status' ? 'Meal has been added to cart!' : 'Meal not added'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {

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
    public function update(Request $request, Cart $cart)
    {
        $cart = Cart::where('user_id', $request->id)->first('id');
        $status = $cart->meals()->updateExistingPivot($request->meal_id, ['quantity' => $request->quantiti]);
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
            'id' => $request->get('id'),
            'meal_id' => $request->get('meal_id'),
            'quantity' => $request->get('quantity'),
        ];
        $cart = Cart::where('user_id', $credentials['id'])->first('id');
       // $meal_id = $request->meal_id;
        //$quantity = $request->quantity;
        $cart->meals()->detach($credentials['meal_id'], ['quantity' => $credentials['quantity']]);

        return response()->json([
            'status' => (bool) $cart,
            'data' => $cart,
            'message' => '$status' ? 'Meal removed from cart!' : 'Meal not removed'
        ]);
    }

    public function mealsInCart(Request $request)
    {
       $cart = DB::select("SELECT meals.id, meals.name, meals.price, meals.image, cart_meals.quantity, meals.vendor_id
                FROM `carts` INNER JOIN meals INNER JOIN cart_meals 
                ON carts.id = cart_meals.cart_id AND cart_meals.meal_id =meals.id 
                WHERE carts.user_id =  $request->id");
                return response()->json([
                    'error' => 'false',
                    'message' => '$cart' ? 'Meal in cart!' : 'Error in Meal cart',
                    'data' => [
                        'cart' =>$cart
                    ]
                ]);       
    }
}
