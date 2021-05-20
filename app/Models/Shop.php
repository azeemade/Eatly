<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Shop extends Model
{
    use HasFactory;
    protected $fillable = [
        'shop_name',
        'shop_image',
        'shop_vendor_id',
        'shop_address',
        'shop_description',
        'open_time',
        'close_time',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'shop_vendor_id');
    }

    public function meals()
    {
        return $this->hasMany(Meal::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function promos()
    {
        return $this->hasMany(Promo::class);
    }

    public function favourites()
    {
        return $this->belongsToMany(Favourite::class, 'favourite_shops','shop_id','favourite_id');       
    }

    public function shop_view()
    {
        return $this->hasMany(Shop_view::class);
    }

    public function showShop()
    {
        if(auth()->id() == null){
            return $this->shop_view()
            ->where('ip', request()->ip())->exist();
        }

        return $this->shop_view()
        ->where(function($shop_viewsQuery){
            $shop_viewsQuery->where('session_id', request()->getSession()->getId())
            ->orWhere('user_id', (auth()->check()));
        })->exists();
    }
}
