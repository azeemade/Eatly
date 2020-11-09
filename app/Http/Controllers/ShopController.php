<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    //
    public function index()
    {
        //return meal::all();
        return response()->json(Shop::with(['user'])->get(), 200);
    }

    public function show(Shop $shop)
    {
       // $shop = Shop::with(['user'])->get();
        //return response()->json($meal, 200);
        return response()->json($shop, 200);
        //return response()->json(Shop::where('vendor_id', $vendor_id)->get(), 200);
       // return $shop;
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

    public function showShops($vendor_id = null)
    {
       // return response()->json(Shop::with(['meal'])->get(), 200);
        return response()->json(Shop::where('vendor_id', $vendor_id)->first(), 200);
        //SELECT * FROM shops INNER JOIN Meals ON Shops.Vendor_id=meals.id WHERE id = 3
        //$shop = DB::select("SELECT * FROM shops INNER JOIN Meals ON Shops.Vendor_id=meals.id WHERE id = $shop");
      // return response()->json($shop, 200);

    }
}
