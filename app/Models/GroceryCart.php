<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroceryCart extends Model
{
    use HasFactory;
    protected $fillable=['item_quantity','total_price','shop_id','customer_id','item_id','checkout','payment','order_id'];
}
