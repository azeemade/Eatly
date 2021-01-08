<?php

namespace App\Http\Controllers\v1\Shop;

use App\Models\Shop;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Shop_view;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    //
    public function index()
    {
        $shop = Shop::all();

        return response()->json([
            'error'=> false,
            'message'=> null,
            'data' => $shop->transform(function ($shop) {
                return 
                [
                'id' => $shop->id,
                'shop_name' => $shop->shop_name,
                'image' => $shop->shop_image
                ];
            })
        ]);
    }

    public function show(Request $request)
    {
        $shop = Shop::where('shop_vendor_id', $request->user_id)->first();

       // if($shop->showShop()){
        //    return response()->json([
         //       'error'=> false,
         //       'message'=> null,
         //       'data' => $shop->transform(function ($shop) {
           //         return [
            //        'id' => $shop->id,
            //        'shop_name' => $shop->shop_name,
            //        'image' => $shop->shop_image,
           //         'sales' => $shop->orders->where('is_delivered', 1)->count(),
             //       'last_seen' => $shop->user->last_seen,
           ///         //'rating' => $shop->meals->ratings->avg('points'),
           //         'created_at' => Carbon::parse($shop->created_at)->format('M Y'),
            //        'active_meals' => $shop->meals->where('meal_approval', 'active')->count(),
            //        'vendor_id' =>$shop->shop_vendor_id,
           ///         'Bio' => $shop->shop_description,
            //        'opening_time' => $shop->open_time,
            //        'close_time' => $shop->close_time,
                    //'meal' => $shop->meals
            //        'vendor_name' => $shop->user->firstname.' '.$shop->user->lastname,
            //        'vendor_image' => $shop->user->user_image
           //         ];
          //      })
          //  ]);
       // }

       // $shop->increment('shop_views');
      //  Shop_view::createViewLog($shop);
        return response()->json([
            'error'=> false,
            'message'=> null,
            'data' => //$shop->transform(function ($shop) {
                //return 
                [
                'id' => $shop->id,
                'shop_name' => $shop->shop_name,
                'image' => $shop->shop_image,
                'sales' => $shop->orders->where('is_delivered', 1)->count(),
                'last_seen' => $shop->user->last_seen,
                //'rating' => $shop->meals->ratings->avg('points'),
                'created_at' => Carbon::parse($shop->created_at)->format('M Y'),
                'active_meals' => $shop->meals->where('meal_approval', 'active')->count(),
                'vendor_id' =>$shop->shop_vendor_id,
                'Bio' => $shop->shop_description,
                'opening_time' => Carbon::parse($shop->open_time)->format('h:ia'),
                'close_time' => Carbon::parse($shop->close_time)->format('h:ia'),
                //'meal' => $shop->meals
                'vendor_name' => $shop->user->firstname.' '.$shop->user->lastname,
                'vendor_image' => $shop->user->user_image
                ]
          //  })
        ]);
    }

    public function shopName(Request $request)
    {
        $shop = Shop::where('shop_vendor_id', $request->user_id)->first('shop_name');

        return response()->json([
            'error'=> false,
            'message'=> null,
            'data' => $shop
        ]);

    }

    public function store(Request $request)
    {      
        $fileExt = $request->file->getClientOriginalExtension();
        $name = $request->shop_name.'_'. date("Y-m-d").'_'.time().'.'.$fileExt;
        $shop_image = config('app.url').'/images/shop/'.$name;

        $shop = Shop::updateOrCreate([
            'id' => $request->id,
        ],[
            'shop_name' => $request->shop_name,    
            'shop_address' => $request->shop_address,
            'shop_description' => $request->shop_bio,
            'shop_vendor_id' => $request->user_id,
            'shop_image' => $shop_image,
            'open_time' => $request->open_time,
            'close_time' => $request->close_time,
        ]);

        if (!$shop) {
            return response()->json([
                'error'=> true,
                'message'=> 'Shop was not saved, error occured',
                'data' => null
            ]);
        }

        return response()->json([
            'error'=> false,
            'message'=> 'Shop saved successfully',
            'data' => $shop
        ]);
    }

    public function update(Request $request, Shop $shop)
    {
        $shop->update($request->all());

        return response()->json($shop, 200);
    }

    public function delete(Shop $shop)
    {
        $shop->delete();

        return response()->json(null, 204);
    }

    public function checkExistence(Request $request)
    {
        $shop = Shop::where('shop_name', '=', $request->shop_name)->first();

        $message = $shop ? 'shop already exist' : 'shop name is available';
        return response()->json([
            'error'=> false,
            'message'=> $message,
            'data' => $shop ? null : $request->shop_name
            
        ]);
    }

    public function shopProps(Request $request){
        $thisMonth = Carbon::today()->format('Y-m');
        $month = Carbon::parse($request->month)->format('m');
        $year = Carbon::parse($request->month)->format('Y');

        $shop = Shop::where('shop_vendor_id', $request->user_id)->pluck('id');


        $undeliveredOrder = Order::where('shop_id', $shop)->where('is_delivered', 0)
        ->whereYear('created_at', $year)->whereMonth('created_at', $month)->count(); 

        $Orders = Order::where('shop_id', $shop)->whereYear('created_at', $year)
        ->whereMonth('created_at', $month)->count();    


        $comment =Comment::join('meals', 'comments.meal_id', 'meals.id')
        ->join('shops', 'shops.id', 'meals.shop_id')
        ->where('shop_vendor_id', $request->user_id)
        ->whereYear('comments.created_at', $year)->whereMonth('comments.created_at', $month)
        ->count();
        
        $data = [
            'month' => $thisMonth,
            'undelivered' => $undeliveredOrder,
            'orders' => $Orders,
            'reviews' => $comment,
        ];

            
        return response()->json([
            'error' => false,
            'message' => 'Order sent successfully ',
            'data' => $data
        ]);
    }

    public function bestSeller(Request $request){
        $shop = Shop::where('shop_name', $request->shop_name)->pluck('id');
        $orders = Order::select('meal_id')->with('meal')
                    ->selectRaw('COUNT(meal_id) AS count')
                    ->where('is_delivered', 1)
                    ->where('shop_id', $shop)
                    ->groupby('meal_id')
                    ->orderBy('count', 'desc')
                    ->take(4)
                    ->get();
      //  $meal = meal::find($orders->meal_id);
       // 

        return response()->json([
            'data' => $orders->transform(function ($orders) {
             return 
                [
                    'id' => $orders->meal_id,
                    'meal_name' => $orders->meal->meal_name,
                    'meal_price' => $orders->meal->meal_sizes->first()->meal_price,
                    'meal_slug' =>  $orders->meal->meal_slug,
                    'image' => $orders->meal->images->where('master', 1)->first()->url
                ];
            }),
            'message' => 'Best sellers',

        ]);
    }





    
    public function shopDetails(Request $request)
    {
        $shop = Shop::where('shop_name', '=', $request->shop_name)->first();
        return response()->json([
            'data' => $shop->transform(function ($shop) {
                return 
                [
                    'id' => $shop->id,
                    'shop_name' => $shop->shop_name,
                    'shop_image' => $shop->shop_image,
                ];
            })
        ]);
    }

    public function showShops($id = null)
    {
        $shop = Shop::where('id', $id)->first();

        return response()->json([
            'error'=> false,
            'message'=> null,
            'data' => [
                'id' => $shop->id,
                'ShopName' => $shop->ShopName,
                'image' => $shop->image,
                'created_at' => Carbon::parse($shop->created_at)->format('M Y'),
                'vendor_id' =>$shop->vendor_id,
                'description' => $shop->description
            ]
        ]);
    }

    public function shopOwner($shopId)
    {
        $shop = Shop::with('user')->where('id', $shopId)->first();
        return response()->json([
            'error'=> false,
            'message'=> null,
            'data' => [
                'shop' => $shop
            ]
        ]);
    }
}
