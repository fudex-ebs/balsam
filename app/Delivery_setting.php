<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery_setting extends Model
{
    protected $fillable = ['country','city','price','active'];
}
