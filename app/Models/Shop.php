<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Shop extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'vendor_id',
        'description',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function meals()
    {
        return $this->hasMany(Meal::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
