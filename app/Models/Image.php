<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [    
        'meal_id',
        'url',
        'master'
    ];

    public function meal()
    {
        return $this->belongsTo(meal::class, 'meal_id');
    }
}
