<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'meal_id',
        'user_id',
        'quantity',
        'vendor_id',
        'shippingAddress',
        'billingAddress',
        'paymentType',
        'nameOnCard',
        'cardNumber',
        'cardExpiration',
        'ccv',
        'promo_code'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function meal()
    {
        return $this->belongsTo(Meal::class, 'meal_id');
    }
}
