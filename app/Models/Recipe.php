<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Recipe extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'Duration',
        'Methods',
        'ingre_id',
        'Time',
        'Region',
        'user_id',       
        'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function ingredient()
    {
        return $this->belongsToMany(Ingredient::class, 'ingre_id');
    }
}
