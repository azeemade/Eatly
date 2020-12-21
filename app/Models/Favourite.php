<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favourite extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',      
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function meals()
    {
        return $this->belongsToMany(meal::class, 'favourite_meals', 'favourite_id', 'meal_id')
    	->withTimestamps();
    }
    public function shops()
    {
        return $this->belongsToMany(Shop::class, 'favourite_shops', 'favourite_id', 'shop_id')
    	->withTimestamps();
    }
}
