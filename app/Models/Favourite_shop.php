<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favourite_shop extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'shop_id',
        'favourite_id',       
    ];
}
