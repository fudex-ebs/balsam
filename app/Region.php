<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected  $fillable = ['country_id','title_ar','active'];
}
