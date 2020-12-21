<?php

namespace App\Http\Controllers\v1\Order;

use App\Models\meal;
use App\Models\Order;
use App\Models\Shop;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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

    public function deliverOrder(Request $request, Order $order)
    {
      //  $order->user_id = $request->user_id;
      //  $order->meal_id = $request->meal_id;
      //  $order->vendor_id = $request->vendor_id;
        $order->is_delivered = true;
        $status = $order->save();

       // $status = $order->update(
        //    $request->only(['user_id', 'meal_id', 'vendor_id', 'is_delivered'])
       // );

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
    public function store(Request $request, $user_id)
    {
        $credentials = $request->all('id');
        $rules = ['id' => 'required'];

        $validatorName = Validator::make($credentials, $rules);
        if($validatorName->fails()) {
            return response()->json([
                'error'=> true,
                'message'=> 'Meal id is required.',
                'data' => null
            ]);
        }

        $order = Order::create([
            'meal_id' => $request->id,
            'user_id' => $user_id,
            'vendor_id' => $request->vendor_id,
            'quantity' => $request->quantity,
            'shippingAddress' => $request->shippingAddress,
            'billingAddress'=> $request->billingAddress,
            'paymentType' => $request->paymentType,
            'nameOnCard' => $request->nameOnCard,
            'cardNumber' => $request->cardNumber,
            'cardExpiration' => $request->cardExpiration,
            'ccv' => $request->ccv,

        ]);

        if (!$order) {
            return response()->json([
                'error' => true,
                'message' => 'An error occured',
                'data' => $order
            ]);
        }

        return response()->json([
            'error' => false,
            'message' => 'Order has been placed',
            'data' => null
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

    public function closedVendorOrder($id = null){
       $shop = shop::where('vendor_id', $id)->pluck('id');
       $order = Order::with(['meal', 'user'])->where('vendor_id', $shop)->where('is_delivered', 1)->latest()->get();
       
       return response()->json($order, 200);
    }

    public function openedVendorOrder($id = null, Request $request){
        $thisMonth = Carbon::today()->format('Y-m');

        $shop = shop::where('vendor_id', $id)->pluck('id');
        $month = Carbon::parse($request->month)->format('m');
        $year = Carbon::parse($request->month)->format('Y');
        $order = Order::where('vendor_id', $shop)->where('is_delivered', 0)->whereYear('created_at', $year)->whereMonth('created_at', $month)->latest()->get();    
        if (!$order) {
            return response()->json([ 
                'error' => true,
                'message' => 'Order was not sent successfully',
                'data' => null
            ]);
        }
        $data = [
            'order' => $order->transform(function ($order) {
                return [
                    'id' => $order->id,
                    'created_at' => $order->created_at->format('F d, Y'),
                    'meal' => $order->meal->name,
                    'name' => $order->user->username,
                    'is_delivered' => $order->is_delivered,
                    'amount' => $order->meal->price,
                ];
            }),
            'month' => $thisMonth
        ];

            
        return response()->json([
            'error' => false,
            'message' => 'Order sent successfully ',
            'data' => $data
        ]);
    }

    public function openOrders($id){
        $order = Order::with(['meal'])->where('is_delivered', 0)->where('user_id', $id)->latest()->get();
        return response()->json($order,200);//[
          //  'error' => false,
          //  'message' => null,
          //  'data' => $order
       // ]);
    }

    public function closeOrders($id){
        $order = Order::with(['meal'])->where('is_delivered', 1)->where('user_id', $id)->latest()->get();
        return response()->json($order,200);//[
          //  'error' => false,
          //  'message' => null,
          //  'data' => $order
       // ]);
    }

    public function shopSells($id = null){
        $shop = shop::where('id', $id)->pluck('id');
        $order = Order::with(['meal', 'user'])->where('vendor_id', $shop)->where('is_delivered', 1)->count();
        
        return response()->json($order, 200);
    }
}
