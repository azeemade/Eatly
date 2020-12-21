<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_meal extends Model
{
    use HasFactory;
    protected $fillable = [
        'meal_id',
        'category_id',      
    ];
}
