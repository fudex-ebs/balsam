<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    //
    protected $fillable = ['title','sort','active','sub_category','sub_category2','code','img','category','price','description','offer'
        ,'offer_end','how_to_use','cautions','qty','special','tax'];
    public function category() {
        return $this->belongsTo(Category::class,'category','id');
    }
    
}
