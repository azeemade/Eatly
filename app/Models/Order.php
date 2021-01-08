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
        'shippingAddress',
        'billingAddress',
        'paymentType',
        'cardType',
        'nameOnCard',
        'cardNumber',
        'cardExpiration',
        'ccv',
        'promo_code'
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
        return $this->belongsTo(Meal::class, 'meal_id');
    }

    public function meal_size()
    {
        return $this->belongsTo(Meal_size::class, 'meal_size_id');
    }
}
