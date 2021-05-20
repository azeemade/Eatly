<?php

namespace App\Http\Controllers\v1\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Category_meal;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Category = Category::all(['id', 'title']);

        if (!$Category) {
            return response()->json([
                'error'=> true,
                'message'=> 'Category not found',
                'data' => null
            ]);
        }

        return response()->json([
            'error'=> false,
            'message'=> null,
            'data' => $Category
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $Category
     * @return \Illuminate\Http\Response
     */
    public function show($title)
    {
        $category = Category::where('title', $title)->first();
        $meals = $category->meals;
        
        return response()->json([
            'error' => false,
            'message' => null,
            'data' =>$meals->transform(function ($meals) {
                return [
                    'meal_name' => $meals->meal_name,
                    'meal_price' => $meals->meal_sizes->first()->meal_price,
                    'shop_name' => $meals->shop->shop_name,
                    'image' => $meals->images->where('master', 1)->first()->url,
                    'meal_slug' => $meals->meal_slug,
                    'created_at' => $meals->created_at,
                    'rating' => $meals->ratings->avg('points'),
                ];
            })
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $Category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $Category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $Category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $Category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $Category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $Category)
    {
        //
    }

    public function sortBy(Request $request){
        $category = Category::where('title', $request->title)->first();
        $sortedMeals = $category->meals;

        //if ($request->sort_by->has('relevancy')){
        //    $sortedMeals->random(16); 
        //}
        
        //if ($request->sort_by->has('top customer ratings')){
          //  $sortedMeals->avg('points'); 
        //}

      //  if ($request->has('sort_by')){
       //     $sortedMeals->orderBy('price', 'ASC'); 
       // }

       // if ($request->sort_by->has('highest price')){
     //       $sortedMeals->orderBy('price', 'ASC');
     //   }

     //   if ($request->sort_by->has('most recent')){
     //       $sortedMeals->orderBy('created_at', 'DESC');
      //  }

      //  return 
      //  $sortedMeals->get();



        return response()->json([
            'error' => false,
            'message' => null,
            'data' => $sortedMeals
        ]);
    }

    public function attachMeal(Request $request, $meal)
    {
        foreach($request->selectedcategories as $title){
            $category = Category::where('title', $title)->first();
            $meal_id = $meal->id;
            $category->meals()->attach($meal_id);
        }

        return response()->json([
            'status' => (bool) $category,
            'message' => '$status' ? 'Meal has been added to category!' : 'Meal not added'
        ]);
    }

    public function detachMeal(Request $request)
    {
        $category = Category::where('title', $request->title)->first();
        $meal_id = $request->meal_id;
        $category->meals()->detach($meal_id);

        return response()->json([
            'status' => (bool) $category,
           // 'data' => $cart,
            'message' => '$status' ? 'Meal has been removed to category!' : 'Meal not removed'
        ]);
    }
    /** Category with most meals*/
    public function topCategory(){
        $category = Category::select('title')
        ->join('category_meals', 'categories.id', 'category_meals.category_id')
        ->selectRaw('COUNT(category_id) AS count')
        ->groupby('title')
        ->orderBy('count', 'desc')
        ->take(5)
        ->get();
        return response()->json([
            'data' => $category,
        ]);
    }
}
