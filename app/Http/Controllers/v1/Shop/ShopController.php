<?php

namespace App\Http\Controllers\v1\Shop;

use App\Models\Shop;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    //
    public function index()
    {
        return Shop::all();
        //return response()->json(Shop::with(['user'])->get(), 200);
    }

    public function show(Shop $shop)
    {
        return response()->json($shop, 200);
    }

    public function store(Request $request)
    {
        $shop = Shop::create($request->all());

        return response()->json($shop, 201);
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
