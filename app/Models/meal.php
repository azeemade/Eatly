<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class meal extends Model
{
    use HasFactory;
    use SoftDeletes;

    const MEAL_STATUS_IN_STOCK = 'in-stock';
    const MEAL_STATUS_OUT_OF_STOCK = 'out-of-stock';

    const MEAL_APPROVAL_ACTIVE = 'active';
    const MEAL_APPROVAL_AWAITING = 'awaiting';
    const MEAL_APPROVAL_CANCELLED = 'cancelled';
    
    protected $fillable = [
        'meal_name',     
        'meal_slug', 
        'shop_id',
        'user_id',
        'meal_additional_text',
        'user_id',
        //'meal_price',
        'meal_status',
        'meal_approval'
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_meals','meal_id','cart_id');       
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);      
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function meal_sizes()
    {
        return $this->hasMany(Meal_size::class);
    }

    public function favourites()
    {
        return $this->belongsToMany(Favourite::class, 'favourite_meals','meal_id','favourite_id');       
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_meals','meal_id','category_id');       
    }
}
