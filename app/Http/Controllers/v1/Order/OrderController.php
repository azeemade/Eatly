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

    public function deliverOrder(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
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
        $credentials = $request->all('meal_id');
        $rules = ['meal_id' => 'required'];

        $validatorName = Validator::make($credentials, $rules);
        if($validatorName->fails()) {
            return response()->json([
                'error'=> true,
                'message'=> 'Meal id is required.',
                'data' => null
            ]);
        }

        $order = Order::create([
            'meal_id' => $request->meal_id,
            'user_id' => $request->user_id,
            'shop_id' => $request->shop_id,
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


    /** meals with the highest purchase */
    public function topMeals(){
        $orders = Order::select('meal_id')->with('meal')
                    ->selectRaw('COUNT(meal_id) AS count')
                    ->where('is_delivered', 1)
                    ->groupby('meal_id')
                    ->orderBy('count', 'desc')
                    ->take(5)
                    ->get();
      //  $meal = meal::find($orders->meal_id);
       // $shop = Shop::find($meal->shop_id);

        return response()->json([
            'data' => $orders->transform(function ($orders) {
             return 
                [
                    'id' => $orders->meal_id,
                    'meal_name' => $orders->meal->meal_name,
                    'meal_price' => $orders->meal->meal_sizes->first()->meal_price,
                    'meal_slug' =>  $orders->meal->meal_slug,
                    'shop_name' => $orders->meal->shop->shop_name,
                    //'shop_name' =>  Shop::select('shop_name')->where('id',$orders->meal->shop_id)->first()->shop_name,
                    'image' => $orders->meal->images->where('master', 1)->first()->url
                    //'image' =>  implode([$orders->meal->images->where('master', 1)->first('url')])
                ];
            }),
            'message' => 'Top meals',

        ]);
    }
    public function openUserOrders(Request $request){
        $order = Order::with(['meal'])->where('is_delivered', 0)
        ->where('user_id', $request->user_id)->latest()->get();
        return response()->json([
            'error' => false,
            'message' => $order ? 'User open orders' : 'No open orders yet',
            'data' => $order->transform(function ($order) {
                return [
                    'id' => $order->id,
                    'meal_name' => $order->meal->meal_name,
                    'meal_price' => $order->meal_size->meal_price,
                    'meal_size' => $order->meal_size->meal_size,
                    'meal_slug' =>  $order->meal->meal_slug,
                    'quantity' => $order->quantity,
                    'status' => $order->order_status,
                    'shop_name' => $order->meal->shop->shop_name,
                    'image' => $order->meal->images->where('master', 1)->first()->url,
                    'created_at' => $order->created_at
                ];
            }),
        ]);
    }

    public function closedUserOrders(Request $request){
        $order = Order::with(['meal'])->where('is_delivered', 1)
        ->where('user_id',  $request->user_id)->latest()->get();
        
        return response()->json([
            'error' => false,
            'message' => $order ? 'User closed orders' : 'No closed orders yet',
            'data' => $order->transform(function ($order) {
                return [
                    'id' => $order->id,
                    'meal_name' => $order->meal->meal_name,
                    'meal_price' => $order->meal_size->meal_price,
                    'meal_size' => $order->meal_size->meal_size,
                    'meal_slug' =>  $order->meal->meal_slug,
                    'quantity' => $order->quantity,
                    'status' => $order->order_status,
                    'shop_name' => $order->meal->shop->shop_name,
                    'image' => $order->meal->images->where('master', 1)->first()->url,
                    'created_at' => $order->created_at
                ];
            }),
        ]);
    }

    public function clearClosed(Request $request){
        $closed = Order::where('user_id', $request->user_id)->where('is_delivered', 1)->get();

        foreach ($closed as $history) {
            $clear = Order::destroy($history->id);
        }

        return response()->json([
            'error'=> false,
            'message'=> $clear ? 'Orders cleared' : 'Error clearing orders',
            'data' => $closed
        ]);
    }
    public function cancelOrder(Request $request){
        $cancel = Order::destroy($request->order_id);

        return response()->json([
            'error'=> false,
            'message'=> $cancel ? 'Order cancelled' : 'Error cancelling order',
            'data' => $cancel
        ]);
    }

    public function featuredMeals(Request $request)
    {
        $shop = Shop::where('shop_name', $request->shop_name)->first();
        $orders = Order::select('meal_id')
                    ->selectRaw('COUNT(meal_id) AS count')
                    ->where('shop_id', $shop->id)
                    ->groupby('meal_id')
                    ->orderBy('count', 'desc')
                    ->take(3)
                    ->get();

        return response()->json([
            'data' => $orders->transform(function ($orders) {
                return [
                    'id' => $orders->meal_id,
                    'meal_name' => $orders->meal->meal_name,
                    'meal_price' => $orders->meal->meal_sizes->first()->meal_price,
                    'meal_slug' =>  $orders->meal->meal_slug,
                    'image' => $orders->meal->images->where('master', 1)->first()->url
                ];
            }),
            'message' => 'Top meals',

        ]);
    }

    public function orderCount(Request $request){
        $thisMonth = Carbon::today()->format('Y-m');

        $shop = shop::where('shop_vendor_id', $request->user_id)->pluck('id');
        $month = Carbon::parse($request->month)->format('m');
        $year = Carbon::parse($request->month)->format('Y');
        $order = Order::where('shop_id', $shop)->whereYear('created_at', $year)->whereMonth('created_at', $month)->count();    
        if (!$order) {
            return response()->json([ 
                'error' => true,
                'message' => 'Order was not sent successfully',
                'data' => null
            ]);
        }
        $data = [
            'month' => $thisMonth,
            'orders-count' => $order
        ];

            
        return response()->json([
            'error' => false,
            'message' => 'Order sent successfully ',
            'data' => $data
        ]);
    }

    public function closedVendorOrder(Request $request){
       $shop = shop::where('shop_name', $request->shop_name)->pluck('id');
       $order = Order::where('shop_id', $shop)->where('is_delivered', 1)->latest()->get();
       
        return response()->json([ 
            'error' => true,
            'message' => 'Order was not sent successfully',
            'data' => $order->transform(function ($order) {
                return [
                    'id' => $order->id,
                    'created_at' => $order->created_at->format('F d, Y'),
                    'meal_name' => $order->meal->meal_name,
                    'meal_size' => $order->meal_size->meal_size,
                    'quantity' => $order->quantity,
                    'username' => $order->user->username,
                    'amount' => $order->meal->meal_price,
                ];
            }),
        ]);
    }

    public function openedVendorOrder(Request $request){
        $thisMonth = Carbon::today()->format('Y-m');

        $shop = shop::where('shop_name', $request->shop_name)->pluck('id');
        $month = Carbon::parse($request->month)->format('m');
        $year = Carbon::parse($request->month)->format('Y');
        $order = Order::where('shop_id', $shop)->where('is_delivered', 0)->whereYear('created_at', $year)->whereMonth('created_at', $month)->latest()->get();    
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
                    'meal_name' => $order->meal->meal_name,
                    'meal_size' => $order->meal_size->meal_size,
                    'quantity' => $order->quantity,
                    'username' => $order->user->username,
                    'amount' => $order->meal->meal_price,
                ];
            }),
            'month' => $thisMonth,
            'open-orders-count' => $order->count()
        ];

            
        return response()->json([
            'error' => false,
            'message' => 'Order sent successfully ',
            'data' => $data
        ]);
    } 
    



    public function shopSells($id = null){
        $shop = shop::where('id', $id)->pluck('id');
        $order = Order::with(['meal', 'user'])->where('vendor_id', $shop)->where('is_delivered', 1)->count();
        
        return response()->json($order, 200);
    }
}
