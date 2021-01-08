<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart_meal extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'meal_id',
        'cart_id',
        'meal_size_id' ,     
        'quantity' 
    ];
}
