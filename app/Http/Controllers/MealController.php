<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\meal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\User;

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
        $meal = Meal::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $request->image,
            'vendor_id' => $shop->id,
            'user_id' => $user->id,
        ]);

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
        $status = $meal->update(
            $request->only(['name', 'price', 'image'])
        );
       // $meal->update($request->all());

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
        $meal = Meal::where('user_id', $user_id)->get();
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
