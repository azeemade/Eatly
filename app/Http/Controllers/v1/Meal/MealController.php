<?php

namespace App\Http\Controllers\v1\Meal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\meal;
use App\Models\Order;
use App\Models\Rating;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class MealController extends Controller
{
    //
    public function index()
    {
        //return meal::all();
        return response()->json(meal::with(['user', 'shop'])->get(), 200);
    }

    public function show($id)
    {

        $meal_ = Meal::with('shop','user')->find($id);

        if (!$meal_) {
            return response()->json([
                'error'=> true,
                'message'=> 'Meal not found',
                'data' => null
            ]);
        }

        return response()->json([
            'error'=> false,
            'message'=> null,
            'data' => $meal_
        ]);
    }

    public function store(Request $request, $id)
    {
        $shop = Shop::where('vendor_id', '=' ,$id)->first();
        $user = User::findorFail($id);
        

       // $request->file('image')->store('images');
       if ($request->hasFile('image')){
          // $image = $request->file('image');
           $imageName = $request->file('image')->getClientOriginalName();
           $request->file('image')->move(public_path('images'), $imageName);
           //Storage::disk('public')->put('images/'.$imageName, file_get_contents($image));
           $str = strtolower($request->name);
       
        $meal = Meal::create([
            'name' => $request->name,
            'price' => $request->price,
            'slug' => preg_replace('/\s+/', '_', $str),
            'image' => $imageName,
            'vendor_id' => $shop->id,
            'user_id' => $user->id,
        ]);
    }


        return response()->json([
            'status' => (bool) $meal,
            'data' => $meal,
            'message' => $meal ? 'Meal Created!' : ' Error creating meal',
        ]);
    }

    public function uploadFile(Request $request)
    {
        if($request->hasFile('image')){
            $name = time(). "_".$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $name);
          
        }
        return response()->json(asset("images/$name"), 201);
    }

    public function update(Request $request, Meal $meal)
    {
       // if ($request->hasFile('image')){
        //     $imageName = $request->file('image')->getClientOriginalName();
        //     $request->file('image')->move(public_path('images'), $imageName);
       // }
        $status = $meal->update(
            $request->only(['name', 'price', 'image'])
        );

        return response()->json([
            'status' => $status, 
            'message' => $status ? 'Meal updated!' : 'Error updating meal'
            ]);
    }

    public function delete(Meal $meal)
    {
        $meal->delete();

        return response()->json(null, 204);
    }

    public function showMeals($user_id = null)
    {
        $meal = Meal::where('user_id', $user_id)->latest()->get();

        return response()->json([
            'data' => $meal,
            'message' => $meal ? 'Meal updated!' : 'Error updating meal'
        ], 200);
    }

    public function mealDetails($vendor_id = null){
       $shop = DB::select(
            "SELECT meals.id, meals.name, meals.price, meals.image, users.username
            FROM meals INNER JOIN shops ON meals.Vendor_id=shops.id 
            INNER JOIN users ON users.id=shops.vendor_id 
            WHERE meals.vendor_id = $vendor_id"
        );
       return response()->json($shop, 200);

    }

    public function moreMeals($meal_id = null){
        $vendor = Meal::where('id', $meal_id)->first();
        $shop = DB::select(
            "SELECT meals.id, meals.name, meals.price, meals.image, shops.ShopName, meals.vendor_id
            FROM meals INNER JOIN shops ON meals.Vendor_id=shops.id 
            WHERE meals.vendor_id = $vendor->vendor_id"
        );
       return response()->json($shop, 200);

    }

    public function mealSales(Request $request){
        $meal = meal::where('id', $request->id)->pluck('id');
        $order = Order::where('meal_id', $meal)->where('is_delivered', '=', '1')->count();
        
        return response()->json($order, 200);
    }

    public function mealRating(Request $request){
        $meal = meal::where('id', $request->id)->pluck('id');
        $rating = Rating::where('meal_id', $meal)->avg('points');

        return response()->json(round($rating), 200);
    }

    public function homepageMeals(){
        $order = Order::select('orders.meal_id', 'meals.name', 'meals.price', 
                'meals.vendor_id', 'meals.image','shops.ShopName')
                ->selectRaw('COUNT(*) AS count')
                ->join('shops', 'shops.id', 'orders.vendor_id')
                ->join('meals', 'meals.id', 'orders.meal_id')
                ->where('orders.is_delivered', 1)
                ->groupby('orders.meal_id', 'meals.name', 'meals.price', 
                'meals.vendor_id', 'meals.image','shops.ShopName')
                ->orderByDesc('count')
                ->limit(2)
                ->get();
    
        return response()->json($order, 200);
    }
}
