<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promo extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'promo_code',
        'promo_status',
        'promo_amount',
        'vendor_id',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }
}
