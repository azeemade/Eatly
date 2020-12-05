<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class meal extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',      
        'vendor_id',
        'user_id',
        'price',
        'image',
        'status'
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'vendor_id');
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
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');       
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
