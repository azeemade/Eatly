<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(Order::with(['meal'])->get(), 200);
    }

    public function deliverOrder(Order $order)
    {
        $order->is_delivered = true;
        $status = $order->save();

        return response()->json([
            'status' => $status,
            'data' => $order,
            'message' => '$status' ? 'Order Delivered!' : 'Error Delivering Order'
        ]);
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
        //
        $order = Order::create([
            'meal_id' => $request->meal_id,
            'user_id' => Auth::id(),
            'quantity' => $request->quantity,
            'vendor' => $request->vendor_id,
        ]);

        return response()->json([
            'status' => (bool) $order,
            'data' => $order,
            'message' => '$status' ? 'Order Created!' : 'Error Creating Order'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
        return response()->json($order, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
        $status = $order->update(
            $request->only(['quantity'])
        );
        
        return response()->json([
            'status' => $status,
            'message' => '$status' ? 'Order Updated!' : 'Error Updating Order'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
        $status = $order->delete();

        return response()->json([
            'status' => $status,
            'message' => '$status' ? 'Order Deleted!' : 'Error Deleting Order'
        ]);
    }
    public function showOrders($user_id = null){
        $order = DB::select("SELECT meals.name, meals.price, orders.quantity, meals.image FROM orders INNER JOIN meals ON orders.meal_id=meals.id WHERE orders.user_id = $user_id");
       return response()->json($order, 200);
    }

    public function orderTable($vendor_id= null){
        $orderTable = DB::select("SELECT Orders.id, meals.name, orders.created_at, orders.is_delivered, meals.price, users.username FROM Orders INNER JOIN meals ON Orders.meal_id=meals.id INNER JOIN users ON Orders.user_id=users.id WHERE meals.vendor_id = $vendor_id");
        return response()->json($orderTable, 200);
    }

    public function getOrder($meal_id = null){
        $myO = DB::select("SELECT users.id FROM Orders INNER JOIN meals ON Orders.meal_id=meals.id INNER JOIN users ON Orders.user_id=users.id WHERE meals.id = $meal_id");
        return response()->json($myO, 200);
    }
}
