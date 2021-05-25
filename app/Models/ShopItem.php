<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopItem extends Model
{
    use HasFactory;
    protected $fillable=['item_name','item_size','item_brand','item_startPromo','item_endPromo','item_price','offer_price','item_discount','item_stock','item_image','item_description','item_size','item_status','category_id','shop_id'];

}
