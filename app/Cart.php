<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
     protected $fillable = ['user_id','user_ip','product_id','qty','bought','order_id'];
}
