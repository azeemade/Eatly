<?php

namespace App\Http\Controllers\v1\Rating;

use App\Models\Rating;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $rating = Rating::create([
            'meal_id' => $request->id,
            'user_id' => $request->user_id,
            'points' => $request->points,

        ]);

        if (!$rating) {
            return response()->json([
                'error' => true,
                'message' => 'An error occured',
                'data' => $rating
            ]);
        }

        return response()->json([
            'error' => false,
            'message' => 'Rating successful',
            'data' => null
        ]);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rating $rating)
    {
        //
    }

    public function mealRating(Request $request){
        $rating = Rating::where('meal_id', $request->id)->get();
        
         if(!$rating) {
             return response()->json([
                 'error'=> true,
                 'message'=> 'Rating no found, error occured',
                 'data' => null
             ]);
         }
 
         return response()->json([
             'error'=> false,
             'message'=> 'Rating loaded successfully',
             'data' => ['ratings' => $rating]
         ]);
     }
}
