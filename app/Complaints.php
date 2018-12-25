<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complaints extends Model
{
    protected $fillable = ['name','email','mobile','subject','message'];
}
