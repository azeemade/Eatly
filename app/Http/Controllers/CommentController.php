<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\meal;
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
        $comment = new Comment;

        $comment->comment = $request->comment;
        //$comment->user()->associate($request->user());
        $comment->user()->associate($request->user_id);

        $meal = meal::find($request->id);
        $meal->comments()->save($comment);

        if(!$comment) {
            return response()->json([
                'error'=> true,
                'message'=> 'Comment no posted, error occured',
                'data' => null
            ]);
        }

        return response()->json([
            'error'=> false,
            'message'=> 'Comment posted successfully',
            'data' => $comment->comment
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
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

    public function mealComment(Request $request){
       $comment = Comment::with('user')->where('commentable_id', $request->id)->latest()->paginate(5);
       
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
            'data' => ['comment' => $comment]
        ]);
    }
}
