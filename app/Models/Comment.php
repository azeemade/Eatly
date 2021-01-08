<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [    
        'user_id',
        'meal_id',
        'review',
        'created_at'
    ];

    public function getCreatedAtAttribute($date){
        return Carbon::parse($date)->diffForHumans();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function meal()
    {
        return $this->belongsTo(meal::class, 'meal_id');
    }
}
