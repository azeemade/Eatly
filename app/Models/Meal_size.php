<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal_size extends Model
{
    use HasFactory;
    protected $fillable = [    
        'meal_id',
        'meal_size',
        'meal_price',
    ];

    public function getMealPriceAttribute($meal_price){
        return number_format($meal_price, 2);
    }

    public function meal()
    {
        return $this->belongsTo(meal::class, 'meal_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function meal_sizes()
    {
        return $this->hasMany(Meal_size::class);
    }
}
