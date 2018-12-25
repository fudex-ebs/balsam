<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addresse extends Model
{
     protected $fillable = ['user_id','country','city','postal','street'];
}
