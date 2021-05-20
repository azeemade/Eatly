<?php

namespace App\Http\Controllers\v1\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\meal;
use App\Models\Shop;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comment = Comment::latest()->get();

        if (!$comment) {
            return response()->json([
                'error'=> true,
                'message'=> 'Comment not found',
                'data' => null
            ]);
        }

        return response()->json([
            'error'=> false,
            'message'=> null,
            'data' => $comment
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
        $comment = Comment::create([
            'review' => $request->review,
            'meal_id' => $request->meal_id,
            'user_id' => $request->user_id,
            'order_id' => $request->order_id,
        ]);


        return response()->json([
            'status' => (bool) $comment,
            'data' => $comment,
            'message' => $comment ? 'meal review successful!' : ' Error creating review',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request){
        $meal = meal::where('meal_slug', $request->meal_slug)->first();
        //$comment = Comment::with('user')->where('meal_id', $meal->id)->latest()->paginate(5);
        $comment = Comment::with('user')->where('meal_id', $meal->id)->orderBy('created_at', 'DESC')->paginate(5);
        
         if(!$comment) {
             return response()->json([
                 'error'=> true,
                 'message'=> 'Comment no found, error occured',
                 'data' => null
             ]);
         }
 
         return response()->json([
             'error'=> false,
             'message'=> 'Comment loaded successfully',
             'data' => $comment
         ]);
    } 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
    function myfunction($meal_)
    {
        $comment = Comment::where('meal_id', $meal_)->get();
        return $comment;
    }

    public function shopReviewsCount(Request $request)
    {
        $comment =Comment::join('meals', 'comments.meal_id', 'meals.id')
        ->join('shops', 'shops.id', 'meals.shop_id')
        ->where('shop_name', $request->shop_name)
        ->get();

        return response()->json([
            'error'=> true,
            //'message'=> 'Rating not found, error occured',
            'data' => $comment->count()
        ]);
    }
}
