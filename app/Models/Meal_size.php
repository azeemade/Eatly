<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal_size extends Model
{
    use HasFactory;
    protected $fillable = [    
        'meal_id',
        'meal_size'
    ];

    public function meal()
    {
        return $this->belongsTo(meal::class, 'meal_id');
    }
}
