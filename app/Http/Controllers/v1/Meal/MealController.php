<?php

namespace App\Http\Controllers\v1\Meal;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\meal;
use App\Models\Meal_size;
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
        $meal = meal::all();

        return response()->json([
            'error'=> false,
            'message'=> null,
            'data' => $meal->transform(function ($meal) {
                return
                [
                    'id' => $meal->id,
                    'meal_name' => $meal->meal_name,
                    'meal_price' => $meal->meal_sizes->first()->meal_price,
                    'meal_slug' => $meal->meal_slug,
                    'shop_name' => $meal->shop->shop_name,
                    'image' => $meal->images->first()->url,
                ];
            })
        ]);
    }

    public function show($slug, Request $request)
    {
        $meal = Meal::where('meal_slug', $slug)->first();
        $images = Image::where('meal_id', $meal->id)->get();

        if (!$meal) {
            return response()->json([
                'error'=> true,
                'message'=> 'Meal not found',
                'data' => null
            ]);
        }

        return response()->json([
            'error'=> false,
            'message'=> null,
            'data' => //$meal,//->transform(function ($meal) {
                //return
                [
                    'id' => $meal->id,
                    'meal_name' => $meal->meal_name,
                    'meal_price' => $meal->meal_sizes->first()->meal_price,
                    'meal_slug' => $meal->meal_slug,
                    'shop_name' => $meal->shop->shop_name,
                    'image' => $meal->images->first()->url,
                    'rating' => round($meal->ratings->avg('points')),
                    'rating_count' => $meal->ratings->count('id'),
                    'reviews_count' => $meal->comments->count('id'),
                    'status' => $meal->meal_status,
                    'additional_text' => $meal->meal_additional_text,
                    //'size' => $meal->meal_sizes,
                    'vendor_name' => $meal->shop->user->firstname.' '.$meal->shop->user->lastname,
                    'vendor_image' => $meal->shop->user->user_image

                ],
            'images' => $images,
            'selected_size' => $meal->meal_sizes->where('meal_size', $request->meal_size)->first(),
            'meal_sizes' => $meal->meal_sizes
           // }),
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

    public function updateOrCreateMeal(Request $request)
    {
       // $shop_id = Shop::where('shop_name', $request->shop_name)->pluck('id');
        $str = strtolower($request->meal_name);
        

        $meal = meal::updateOrCreate([
            'id' => $request->id,
        ],[
            'meal_name' => $request->meal_name,
            'meal_slug' => preg_replace('/\s+/', '_', $str),           
            'meal_price' => $request->meal_price,
            'shop_id' => $request->shop_id,
            'user_id' => $request->user_id,
            'meal_additional_text' => $request->meal_additional_text,
            'meal_status' => $request->meal_status
        ]);

        if (!$meal) {
            return response()->json([
                'error'=> true,
                'message'=> 'meal was not saved, error occured',
                'data' => null
            ]);
        }

        return response()->json([
            'error'=> false,
            'message'=> 'Meal saved successfully',
            'data' => $meal
        ]);
    }

    public function updateOrCreateMealSize(Request $request)
    {
        $meal_size = Meal_size::updateOrCreate([
            'id' => $request->id,
        ],[
//            'id' => $request->id,
            'meal_id' => $request->meal_id,
            'meal_size' => $request->meal_size,
        ]);

        if (!$meal_size) {
            return response()->json([
                'error'=> true,
                'message'=> 'meal sizes was not saved, error occured',
                'data' => null
            ]);
        }
        return response()->json([
            'error'=> false,
            'message'=> 'meal sizes were saved',
            'data' => $meal_size
        ]);
    }

    public function updateCreatePrimaryMealImage(Request $request)
    {
        $meal = meal::find($request->meal_id);

       // if ($request->hasFile('image')) {
            $fileExt = $request->file->getClientOriginalExtension();
            $name = $meal->id.'_'.$meal->meal_slug.'_'. date("Y-m-d").'_'.time().'.'.$fileExt;
            $imageName = config('app.url').'/images/meal/'.$name;

        //}
            $status = Image::updateOrCreate(['id' => $request->id],[
                'meal_id' => $request->meal_id,
                'url' => $imageName,
                'master' => 1
            ]);

            if(!$status) {
                return response()->json([
                    'error'=> true,
                    'message'=> 'Primary image not saved, error occured',
                    'data' => null
                ]);
            }

            $storeFile = $request->file->move(public_path('images/meal'), $imageName);

            return response()->json([
                'error'=> false,
                'message'=> 'image saved successfully',
                'data' => $status
            ]);
        //}
    }

    public function updateCreateSecondayMealImages(Request $request)
    {
        $faker = \Faker\Factory::create();

        $meal = meal::find($request->meal_id);

       // if ($request->hasFile('image')) {
            $fileExt = $request->file->getClientOriginalExtension();
            $name = $meal->id.'_'.$meal->meal_slug.'_'. date("Y-m-d").'_'.time().'_'.$faker->randomNumber().'.'.$fileExt;
            $imageName = config('app.url').'/images/meal/'.$name;


            $status = Image::updateOrCreate(['id' => $request->id],[
                'meal_id' => $request->meal_id,
                'url' => $imageName,
                'master' => 0
            ]);

            if(!$status) {
                return response()->json([
                    'error'=> true,
                    'message'=> 'Secondary image not saved, error occured',
                    'data' => null
                ]);
            }

            $storeFile = $request->file->move(public_path('images/meal'), $imageName);

            return response()->json([
                'error'=> false,
                'message'=> 'image saved successfully',
                'data' => $status
            ]);
        //}
    }

    public function delete(Request $request)
    {
        $meal = meal::findOrFail($request->meal_id);

        $removeMeal =$meal->delete();

        if(!$removeMeal) {
            return response()->json([
                'error'=> true,
                'message'=> 'Meal not deleted',
                'data' => null
            ]);
        }

        return response()->json([
            'error'=> false,
            'message'=> 'Meal deleted successfully',
            'data' => null
        ]);
    }

    public function deleteSecondaryImage(Request $request)
    {
        $image = Image::findOrFail($request->image_id);

        $removeImage =$image->delete();

        if(!$removeImage) {
            return response()->json([
                'error'=> true,
                'message'=> 'image not deleted',
                'data' => null
            ]);
        }

        return response()->json([
            'error'=> false,
            'message'=> 'Meal deleted successfully',
            'data' => null
        ]);
    }

    

    public function vendorMeals(Request $request)
    {
        $shop = Shop::where('shop_name', $request->shop_name)->first();
        $meals = meal::where('shop_id', $shop->id)->where('meal_approval', 'active')->latest()->paginate(12);
        return response()->json([
            'data' => $meals->transform(function ($meals) {
                return [
                    'id' => $meals->id,
                    'meal_name' => $meals->meal_name,
                    'meal_price' => $meals->meal_sizes->first()->meal_price,
                    'meal_slug' =>  $meals->meal_slug,
                    'image' => $meals->images->where('master', 1)->first()->url,
                    'created_at' => $meals->created_at,
                    'rating' => $meals->ratings->avg('points'),
                ];
            }),
            'message' => 'Vendor meals',

        ]);
    }

    public function relatedMeals(Request $request)
    {
        $meal_id = meal::with('categories')->where('meal_slug', $request->meal_slug)->first();
        $meal = meal::with('categories')->findOrFail($meal_id->id);
        $category_id = $meal->categories->pluck('id')->toArray();

        $meals = meal::whereHas('categories', function($query) use ($category_id){
         return $query->whereIn('categories.id', $category_id);
        })->where('meals.id','!=', $meal->id)->take(4)->get();

        return response()->json([
            'data' => $meals->transform(function ($meals) {
                return [
                    'id' => $meals->id,
                    'meal_name' => $meals->meal_name,
                    'meal_price' => $meals->meal_sizes->first()->meal_price,
                    'meal_slug' =>  $meals->meal_slug,
                    'image' => $meals->images->where('master', 1)->first()->url,
                ];
            }),
            'message' => 'Related meals',

        ]);
    }

    public function activeMeals(Request $request)
    {
        $shop = Shop::where('shop_name', $request->shop_name)->pluck('id');
        $meal = meal::where('shop_id',$shop)->where('meal_approval', 'active');
        return response()->json([
            'data' =>[
                'meals' => $meal->latest()->paginate(4),
                'count' => $meal->count()
            ],
            'message' => $meal ? 'Active meals!' : 'Error getting meals'
        ], 200);
    }

    public function awaitingMeals(Request $request)
    {
        $shop = Shop::where('shop_name', $request->shop_name)->pluck('id');
        $meal = meal::where('shop_id',$shop)->where('meal_approval', 'awaiting');
        return response()->json([
            'data' => [
                'meals' => $meal->latest()->paginate(4),
                'count' => $meal->count()
            ],
            'message' => $meal ? 'awaiting meals!' : 'Error getting meals'
        ], 200);
    }

    public function cancelledMeals(Request $request)
    {
        $shop = Shop::where('shop_name', $request->shop_name)->pluck('id');
        $meal = meal::where('shop_id',$shop)->where('meal_approval', 'cancelled');
        return response()->json([
            'data' => [
                'meals' => $meal->latest()->paginate(4),
                'count' => $meal->count()
            ],
            'message' => $meal ? 'cancelled meals!' : 'Error getting meals'
        ], 200);
    }

    public function editingMeal(Request $request)
    {
        $meal = Meal::with('shop')->where('meal_slug', $request->meal_slug)->get();

        if (!$meal) {
            return response()->json([
                'error'=> true,
                'message'=> 'Meal not found',
                'data' => null
            ]);
        }

        return response()->json([
            'error'=> false,
            'message'=> null,
            'data' => $meal->transform(function ($meal) {
                return [
                    'id' => $meal->id,
                    'primary_image' => $meal->images->where('primary', 1),
                    'sales' => $meal->orders->where('is_delivered', 1)->count(),
                    'rating' => $meal->ratings->avg('points'),
                    'meal_name' => $meal->meal_name,
                    'meal_price' => $meal->meal_price,
                    'additional_text' => $meal->meal_additional_text,
                    'meal_size' => $meal->meal_sizes,
                    'status' => $meal->meal_status,
                    'image' => $meal->images->where('primary',0),
                ];
            }),
        ]);
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
}
