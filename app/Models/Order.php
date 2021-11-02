<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'meal_id',
        'meal_size_id',
        'user_id',
        'quantity',
        'shop_id',
        'order_status',
        'meal_size',
        'shipping_address',
        'billing_address',
        'payment_type',
        'card_type',
        'name_on_card',
        'card_number',
        'card_expiration',
        'ccv',
        'promo_code'
    ];

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->diffForHumans();
    }
    public function getUpdatedAtAttribute($date)
    {
        return Carbon::parse($date)->diffForHumans();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function meal()
    {
        return $this->belongsTo(Meal::class, 'meal_id');
    }

    public function meal_size()
    {
        return $this->belongsTo(Meal_size::class, 'meal_size_id');
    }
    public function comment()
    {
        return $this->hasOne(Comment::class);
    }
    public function rating()
    {
        return $this->hasOne(Rating::class);
    }
}
