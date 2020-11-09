<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'recipe_id',
        'image'
    ];

    public function recipe()
    {
        return $this->belongsToMany(Recipe::class, 'recipe_id');
    }
}
