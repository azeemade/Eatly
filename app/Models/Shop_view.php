<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop_view extends Model
{
    use HasFactory;
    protected $fillable = [
        'shop_id',
        'url',
        'shop_name',
        'session_id',
        'user_id',
        'ip',
        'agent',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public static function createViewLog($shop){
        $shop_views = new Shop_view();

        $shop_views->shop_id = $shop->id;
        $shop_views->shop_name = $shop->shop_name;
        $shop_views->url = request()->url();
        $shop_views->session_id = request()->getSession()->getId();
        $shop_views->user_id = (auth()->check())?auth()->id:null;
        $shop_views->ip = request()->ip();
        $shop_views->agent = request()->header('User-Agent');
        $shop_views->save();
    }
}
