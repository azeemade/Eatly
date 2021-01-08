<?php

namespace App\Http\Controllers\v1\Search;

use App\Http\Controllers\Controller;
use App\Models\meal;
use App\Models\Search;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function recent(Request $request){
        $search = Search::where('user_id', $request->user_id)
        ->orderBy('created_at', 'desc')
        ->take(3)
        ->get('search_title');

        return response()->json([
            'data' => $search,
            'message' => 'recent'
        ], 200);
    }

    public function popular(){
        $search = Search::select('search_title')
        ->selectRaw('COUNT(search_title) AS count')
        ->groupby('search_title')
       ->orderBy('count', 'desc')
        ->take(3)
        ->get();

        return response()->json([
            'data' => $search,
            'message' => 'popular'
        ], 200);
    }

    public function store(Request $request){
        $search = Search::create($request->all());

        if(!$search) {
            return response()->json([
                'error'=> true,
                'message'=> 'Search not saved',
                'data' => null
            ]);
        }

        return response()->json([
            'error'=> false,
            'message'=> 'Keyword saved',
            'data' => $search
        ]);
    }

    public function clear(Request $request){
        $search = Search::where('user_id', $request->user_id)->get();

        foreach ($search as $history) {
            $clear = Search::destroy($history->id);
        }

        return response()->json([
            'error'=> false,
            'message'=> $clear ? 'Search cleared' : 'Error clearing search',
            'data' => $search
        ]);
    }
}
