<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
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
        'ccv'
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
