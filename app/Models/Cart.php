<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
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
        return $this->belongsToMany(meal::class, 'cart_meals', 'cart_id', 'meal_id')
        ->withPivot('quantity')
    	->withTimestamps();
    }
}
