<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';
    protected $fillable = [
       'group_name','name','cafe_price','frozen_price','zomato_price','swiggy_price','stock'
    ];
    public $timestamps = true;
}
