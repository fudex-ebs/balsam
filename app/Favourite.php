<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
         protected $fillable = ['user_id','user_ip','product_id'];

}