<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ['title','sort','active','sub_category'];
//    public function products() {
//        return $this->hasMany(product::class);
//    }
    public function product() {
        return $this->hasMany(product::class,'category');
    }
     
}
