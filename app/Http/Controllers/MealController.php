<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\meal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;

class MealController extends Controller
{
    //
    public function index()
    {
        //return meal::all();
        return response()->json(meal::with(['user', 'shop'])->get(), 200);
    }

    public function show(Meal $meal)
    {
        return response()->json($meal, 200);
    }

    public function store(Request $request)
    {
        //$meal = Meal::create($request->all());
        $meal = Meal::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $request->image,
            'vendor_id' => $request->vendor_id,
            'user_id' => $request->user_id,
        ]);

        return response()->json([
            'status' => (bool) $meal,
            'data' => $meal,
            'message' => $meal ? 'Meal Created!' : ' Error creating meal',
        ]);

        //return response()->json($meal, 201);
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
        $meal->update($request->all());

        return response()->json($meal, 200);
    }

    public function delete(Meal $meal)
    {

        $meal->delete();

        return response()->json(null, 204);
    }

    public function showMeals($user_id = null)
    {
       // return response()->json(meal::with(['shop'])->get(), 200);
      $meal = DB::select("SELECT meals.name, meals.price, meals.image, meals.user_id, meals.id FROM meals INNER JOIN users ON users.id=meals.user_id WHERE meals.vendor_id = $user_id");
       //return response()->json(['meal' => $meal], 200);
     // $shop = Meal::with(['shop'])->get("'meals.name', 'meals.price', 'shops.id', 'shops.name'");
      //  $meal = Meal::where('vendor_id', $vendor_id)->get();
        return response()->json($meal, 200);
    }

    public function mealDetails($vendor_id = null){
        //return response()->json(meal::with(['shop'])->where('id', $shop_id)->get(), 200);
        //$shop = DB::select("SELECT meals.name, meals.price FROM meals INNER JOIN shops ON meals.Vendor_id=shops.vendor_id WHERE shops.vendor_id = 3");
       // return response()->json($shop, 200);
       $shop = DB::select("SELECT meals.name, meals.price, meals.image FROM meals INNER JOIN shops ON meals.Vendor_id=shops.id WHERE meals.vendor_id = $vendor_id");
       return response()->json($shop, 200);

    }
}
