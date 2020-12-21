<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [    
        'meal_id',
    ];

    public function meals()
    {
        return $this->belongsToMany(meal::class, 'category_meals', 'category_id', 'meal_id');
    }
}
