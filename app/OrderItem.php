<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';
    protected $fillable = [
       'order_id','item_id','price','quantity','quantity'
    ];
    public $timestamps = true;
}
